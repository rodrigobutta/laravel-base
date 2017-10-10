<?php

namespace App\Modules\Lead;

use App\Modules\Lead\LeadModel;
use App\Modules\Lead\LeadRepositoryInterface;

use App\Helpers\ResizeHelper;

use Auth;
use Carbon\Carbon;
use DB;
use File;
use Illuminate\Support\Facades\Cache;

class LeadRepository implements LeadRepositoryInterface
{

    public function __construct(
                                LeadModel $lead
                                )
    {
        $this->lead = $lead;

    }



     public function put($fields,$form_id){


        $data = serialize($fields);


        $item = new LeadModel();

        $item->form_id = $form_id;
        $item->data = $data;

        $item->save();

        // if ($request->get('category')) {
        //     $categories = $request->get('category');
        //     $item->categories()->attach($categories);
        // }

        // $info_data = [
        //     'cover_image' => '',
        //     'cover_image_front' => '',
        //     'cover_title_image' => '',
        //     'cover_title' => $item->title
        // ];
        // $item->info()->create($info_data);

        // // prepopulo las propiedades que se heredan de las categorias seleccionadas
        // $tmp_arr = [];
        // foreach ($item->inheritedProperties() as $key => $i) {
        //     $tmp_arr[$i->id]['value'] = '';//$i->value;
        //     $tmp_arr[$i->id]['order'] = $key;
        // }
        // $item->properties()->sync($tmp_arr);

        // // Grilla interna
        // $grid = new Grid();
        // $grid->title = 'PRODUCT_' . $item->id;
        // $grid->shared = false;
        // $grid->user_id = auth()->user()->id;
        // $grid->save();

        // $item->grid_id = $grid->id;
        // $item->save();

        return true;
     }




    public function getById($id)
    {
        // return $this->posts()->where('id', $id)->with('lead', 'comments', 'comments.replies', 'favorites', 'info')->firstOrFail();
        return $this->posts()->where('id', $id)->with('event')->firstOrFail();
    }


    public function getBySlug($slug)
    {
        return $this->posts()->where('slug', $slug)->with('event')->firstOrFail();
    }



    public function getAll(){
        $lead = $this->posts()->orderBy('id'); //->with('lead', 'comments', 'favorites');
        return $lead->paginate(perPage());
    }





    // *************************************************************************



    private function posts(){

        // si es admin o superadmin no limitar el universo a los aprobados
        // if(auth()->check() && (auth()->lead()->isSuper() || auth()->lead()->isAdmin())){
            $posts = $this->lead->public();
        // }
        // else{
        //     $posts = $this->lead->approved()->published();
        // }

        return $posts;
    }


    public function incrementViews($lead)
    {
        $lead->views = $lead->views + 1;
        $lead->timestamps = false;
        $lead->save(['updated_at' => false]);

        return $lead;
    }


    public function search($search)
    {
        $extends = explode(' ', $search);

        $lead = $this->posts()->where('title', 'LIKE', '%' . $search . '%')
            ->orWhere('tags', 'LIKE', '%' . $search . '%')
            ->whereNull('deleted_at')->whereNotNull('approved_at')->orderBy('approved_at', 'desc');

        foreach ($extends as $extend) {
            if(strlen($extend) >= 3) {
                $lead->orWhere('tags', 'LIKE', '%' . $extend . '%')->whereNotNull('approved_at')->whereNull('deleted_at')
                    ->orWhere('title', 'LIKE', '%' . $extend . '%')->whereNotNull('approved_at')->whereNull('deleted_at')
                    ->orWhere('description', 'LIKE', '%' . $extend . '%')->whereNotNull('approved_at')->whereNull('deleted_at');
            }
        }

        return $lead = $lead->with('lead')->whereNotNull('approved_at')->whereNull('deleted_at')->paginate(perPage());
    }



    public function delete($id){

        $item = LeadModel::findOrFail($id);


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
