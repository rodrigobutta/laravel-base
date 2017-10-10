<?php
namespace App\Modules\Lead;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Modules\Campaign\CampaignModel;
use App\Modules\Event\EventModel;
use App\Modules\Form\FormModel;

use App\Modules\UserField\UserFieldModel;

class LeadModel extends \App\Models\Profiled
{

    protected $table = 'lead';


    public function form()
    {
        return $this->belongsTo(FormModel::class, 'form_id');
    }

    public function campaign()
    {
        return $this->belongsTo(CampaignModel::class, 'campaign_id');
    }

    public function event()
    {
        return $this->belongsTo(EventModel::class, 'event_id');
    }


    // intenta generar una estructura unificada de todos los datos cargados con su info de campo, ya sea de usuario o del formulario mismo
    public function getFields()
    {
        $res = [];

        // mapa de campos del formulario de donde se genero el lead
        $form_fields_map = [];
        if($this->form){
            $form_fields_map = $this->form->getFields();
        }

        $fields = unserialize($this->data);
        foreach ($fields as $key => $value) {

            $item = new \stdClass();
            $item->value = $value;
            $item->key = $key;

            // busco info del campo en la definicion de campos de usuario
            if (strpos($key, 'userfield_') !== false) {

                $fieldId = str_replace('userfield_','',$key);

                $userField = UserFieldModel::findOrFail($fieldId);

                $item->title = $userField->title;

                $item->nature = 'userfield';

            }
            else{

                // busco info del campo en la definicion json del formulario
                if($obj = findObjectInArray($form_fields_map,'id_name',$key)){
                    $item->title = $obj->title;
                }

            }

            array_push($res,$item);

        }


        return $res;
    }


}
