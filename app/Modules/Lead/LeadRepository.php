<?php

namespace App\Modules\Lead;

use App\Modules\Lead\LeadModel;
use App\Modules\Lead\LeadRepositoryInterface;

use App\Modules\User\UserModel;

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

        // SALVAR LEAD CON TODOS LOS CAMPOS ENCODEADOS

        $item = new LeadModel();

        $item->form_id = $form_id;
        $item->data = $data;

        $item->save();


        // ***********************************
        // BASE UNICA DE USUARIOS

        $fixedMap = getFixedFieldsCollection();

        // armo array con campos key dinamicos por los que despues voy a buscar en el firstOrNew
        $key_fields = [];

        foreach ($fields as $key => $value) {

            if (strpos($key, 'userfield_') !== false) {

                $userfieldId = str_replace('userfield_','',$key);

                $fixedFieldItem = $fixedMap->get($userfieldId);

                if($fixedFieldItem->is_fixed_key==1){
                    $key_fields[$fixedFieldItem->fixed_field_name] = $value;
                }

            }
        }

        // ejecuto create or update en base a sabiduria laravel con los campos armados
        $item = UserModel::firstOrNew($key_fields);


        // armo mapa de campos a actualizar en el objeto

        foreach ($fields as $key => $value) {

            if (strpos($key, 'userfield_') !== false) {
                $userfieldId = str_replace('userfield_','',$key);

                // del mapa de campos fixed del userfield, busco los campos reales de la tabla users en base al id concatenado con _
                $fieldName = $fixedMap->get($userfieldId)->fixed_field_name;

                $item{$fieldName} = $value;
            }
        }

        // actualizo los campos del objeto en la base
        $item->save();

        // ***********************************



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
