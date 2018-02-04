<?php

namespace App\Modules\Form;

use App\Modules\Form\FormModel;
use App\Modules\Form\FormRepositoryInterface;

use App\Helpers\ResizeHelper;

use Auth;
use Carbon\Carbon;
use DB;
use File;
use Illuminate\Support\Facades\Cache;

class FormRepository implements FormRepositoryInterface
{

    public function __construct(
                                FormModel $form
                                )
    {
        $this->form = $form;

    }

    public function getById($id)
    {
        // return $this->posts()->where('id', $id)->with('form', 'comments', 'comments.replies', 'favorites', 'info')->firstOrFail();
        return $this->posts()->where('id', $id)->with('event')->firstOrFail();
    }


    public function getBySlug($slug)
    {
        return $this->posts()->where('slug', $slug)->with('event')->firstOrFail();
    }

    public function getByComb($eventSlug,$formSlug)
    {

        try {

            return $this->posts()->with('event')
                ->where('slug', $formSlug)
                ->whereHas('event', function($query) use($eventSlug){
                    $query->where('slug', '=', $eventSlug);
                })
                ->first();

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return false;
        }

    }




    public function getAll(){
        $form = $this->posts()->orderBy('id'); //->with('form', 'comments', 'favorites');
        return $form->paginate(perPage());
    }





    // *************************************************************************



    private function posts(){

        // si es admin o superadmin no limitar el universo a los aprobados
        // if(auth()->check() && (auth()->form()->isSuper() || auth()->form()->isAdmin())){
            $posts = $this->form->public();
        // }
        // else{
        //     $posts = $this->form->approved()->published();
        // }

        return $posts;
    }


    public function incrementViews($form)
    {
        $form->views = $form->views + 1;
        $form->timestamps = false;
        $form->save(['updated_at' => false]);

        return $form;
    }


    public function search($search)
    {
        $extends = explode(' ', $search);

        $form = $this->posts()->where('title', 'LIKE', '%' . $search . '%')
            ->orWhere('tags', 'LIKE', '%' . $search . '%')
            ->whereNull('deleted_at')->whereNotNull('approved_at')->orderBy('approved_at', 'desc');

        foreach ($extends as $extend) {
            if(strlen($extend) >= 3) {
                $form->orWhere('tags', 'LIKE', '%' . $extend . '%')->whereNotNull('approved_at')->whereNull('deleted_at')
                    ->orWhere('title', 'LIKE', '%' . $extend . '%')->whereNotNull('approved_at')->whereNull('deleted_at')
                    ->orWhere('description', 'LIKE', '%' . $extend . '%')->whereNotNull('approved_at')->whereNull('deleted_at');
            }
        }

        return $form = $form->with('form')->whereNotNull('approved_at')->whereNull('deleted_at')->paginate(perPage());
    }



    public function delete($id){

        $item = FormModel::findOrFail($id);


        if(!$item->canHandle()){
            return false;
            // return redirect()->route('admin')->with('flashSuccess', t('Insufficient permissions for this object'));
        }


        // elimino el archivo fisico de la imagen
        if(has($item->main_image)){
            $delete = new ResizeHelper( $item->main_image, 'tasks');
            $delete->delete();
        }



        $item->info()->delete();


        // elimino recursivamente
        foreach ($item->children as $child) {
            $this->delete($child->id);
        }

        $item->delete();

        return true;

    }


}
