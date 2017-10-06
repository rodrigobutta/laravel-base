<?php
namespace App\Modules\UserField;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserFieldModel extends \App\Models\Profiled
{

    protected $table = 'user_field';


    private $fieldTypes = [
                'text' => 'Texto',
                'number' => 'Numérico',
                'textarea' => 'Area de Texto'
            ];


    public function getFieldTypes($key = ""){

        if($key==""){
            return $this->fieldTypes;
        }
        else{
            return $this->fieldTypes[$key];
        }

    }


    public function getSchema(){

        // return '{"title": "'.$this->title.'"}';

        return '{
          "type": "'.$this->type.'",
          "title": "'.$this->title.'",
          "id_name": "userfield_'.$this->id.'"
        }';

    }

}
