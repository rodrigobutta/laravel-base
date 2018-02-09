<?php

namespace App\Modules\Lead;

use App\Modules\Lead\LeadModel;
use App\Modules\Lead\LeadRepositoryInterface;
use App\Modules\User\UserModel;
use App\Modules\Form\FormModel;
use App\Modules\Campaign\CampaignModel;

use App\Helpers\ResizeHelper;

use Auth;
use Carbon\Carbon;
use DB;
use File;
use Illuminate\Support\Facades\Cache;

class LeadRepository implements LeadRepositoryInterface
{

    public function __construct(LeadModel $lead)
    {
        $this->lead = $lead;
    }


    public function put($fields, $formId, $campaignId = null, $manual = false, $leadlistId = null){

        $data = serialize($fields);

        $form = FormModel::find($formId);

        $lead = new LeadModel();
            $lead->event_id = $form->event_id;
            $lead->form_id = $formId;
            $lead->data = $data;

            if($manual){
                $lead->type_id = 2;
            }
            else{
                $lead->type_id = 1;
            }

            if($campaignId != null){
                $lead->campaign_id = $campaignId;
            }
        $lead->save();


        // BASE UNICA DE USUARIOS

        $fixedMap = getFixedFieldsCollection();

        $notfixed_fields = []; // campos que van a guardarse en usuario pero no en la tabla directo (no fixed)

        // BUSCAR CAMPOS KEY
        $key_fields = []; // array con campos key dinamicos por los que despues voy a buscar en el firstOrNew

        foreach ($fields as $key => $value) {
            if (strpos($key, 'userfield_') !== false) {

                $userfieldId = str_replace('userfield_','',$key);

                // me fijo si el userfield que vino es parte de un fixed, si es null es un campo de usuario pero no fixed
                if($fixedFieldItem = $fixedMap->get($userfieldId)){

                    // si es key es el que voy a usar para tomar como clave compuesta de usuario
                    if($fixedFieldItem->is_fixed_key==1){
                        $key_fields[$fixedFieldItem->fixed_field_name] = $value;
                    }

                }

            }
        }

        // ejecuto create or update en base a sabiduria laravel con los campos armados
        $user = UserModel::firstOrNew($key_fields);


        // armo mapa de campos a actualizar en el objeto
        foreach ($fields as $key => $value) {
            if (strpos($key, 'userfield_') !== false) {

                $userfieldId = intval(str_replace('userfield_','',$key));

                if($fixedFieldItem = $fixedMap->get($userfieldId)){
                    // son campos fixed (que tienen correspondiente entabla real de usuario)
                    $fieldName = $fixedFieldItem->fixed_field_name;
                    $user{$fieldName} = $value;
                }
                else{
                    // es un campo de usuario pero no fixed, asi que lo mano a la relacion many to many
                    $notfixed_fields[$userfieldId]['value'] = $value;
                }

            }
        }

        // actualizo los campos del objeto en la base
        $user->save();

        $user->fields()->sync($notfixed_fields);


        // actualizo el lead indicando en que campo de usuario termino
        $lead->user_id = $user->id;
        $lead->save();


        // AGREGAR USUARIO A TODAS LAS LISTAS DE USUARIO DEFINIDAS EN EL FORM
        foreach ($form->userlists as $l) {
            if (!$user->userlists->contains($l->id)) {
                $user->userlists()->attach($l->id);
            }
        }


        if(!$manual){

            // MAPEO TODAS LASLEAD LISTS QUE CORRESPONDAN
            // $lead->leadlists()->attach($form->event->leadlist->id);
            $lead->leadlists()->attach($form->leadlist()->id);
            if($campaignId != null){
                $campaign = CampaignModel::find($campaignId);
                $lead->leadlists()->attach($campaign->leadlist()->id);
            }

        }
        else{

            // si es agregado manual, no pongo el lead en todos lados sino solo en lalista que pide el administrador

            $lead->leadlists()->attach($leadlistId);

        }



        return $lead;
     }



     public function removeFromList($itemId,$arrIds){

        $item = LeadListModel::findOrFail($itemId);

        $item->leads()->detach($arrIds);

        return true;

     }






     public function cloneList($itemId){

         $item = LeadListModel::findOrFail($itemId);

         $new = $item->replicate();
         $new->name = 'Copia de ' . $item->fullname . ' - ' . str_random(4);
         $new->type_id = 4;
         $new->push();

         foreach($item->leads as $l){
             $new->leads()->attach($l->id);
         }

         return $new;

     }





}
