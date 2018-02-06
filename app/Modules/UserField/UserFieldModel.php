<?php
namespace App\Modules\UserField;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserFieldModel extends \App\Models\Profiled
{

    protected $table = 'user_field';


    private $fieldTypes = [
                'text' => 'Texto',
                'email' => 'E-mail',
                // 'number' => 'Numérico',
                'textarea' => 'Area de Texto',
                'select' => 'Select'
            ];


    public function choices()
    {
        return $this->hasMany(UserFieldChoiceModel::class, 'user_field_id');
    }


    public function getFieldTypes($key = ""){

        if($key==""){
            return $this->fieldTypes;
        }
        else{

            if(isset($this->fieldTypes[$key])){
                return $this->fieldTypes[$key];
            }
            else{
                return '(phone)';
            }

        }

    }


    public function getSchema(){

        // return '{"title": "'.$this->title.'"}';

        // return '{
        //   "type": "'.$this->type.'",
        //   "title": "'.$this->title.'",
        //   "id_name": "userfield_'.$this->id.'",
        //   "choices" : [ {"choice": "First Choice","id": "choice-1"}, {"choice": "Second Choice","id": "choice-2"}, {"choice": "Third Choice","id": "choice-3"}]
        // }';

        $choices = [];
        foreach ($this->choices as $tmp) {
            $choices[] = array(
                'choice' => $tmp['title']
                // 'title' => $tmp['title']
            );
        };
        $choices_str = json_encode($choices);

        return '{
          "type": "'.$this->type.'",
          "title": "'.$this->title.'",
          "id_name": "userfield_'.$this->id.'",
          "choices" : ' . $choices_str . '
        }';

    }




}
