<?php
namespace App\Modules\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Modules\User\UserListModel;
use App\Modules\UserField\UserFieldModel;
use App\Modules\UserField\UserFieldChoiceModel;


class UserModel extends \App\Models\Profiled
{

    protected $table = 'user';

    protected $fillable = ['email','name','surname','dni'];

    public function userlists()
    {
        return $this->belongsToMany(UserListModel::class, 'userlist_user', 'user_id', 'userlist_id');
    }

    public function fields()
    {
        return $this->belongsToMany(UserFieldModel::class, 'user_field_value', 'user_id', 'field_id')->withPivot('value');
    }

    // intenta generar una estructura unificada de todos los datos cargados con su info de campo, ya sea de usuario o del formulario mismo
    public function getFields()
    {
        $res = [];

        $fields = $this->fields;

        foreach ($fields as $key => $field) {

            $item = new \stdClass();
            $item->key = $field->id;
            $item->title = $field->name;

            if($field->type=='select'){
                $choice = UserFieldChoiceModel::find($field->pivot->value);
                $item->value = $choice->title;
            }
            else{
                $item->value = $field->pivot->value;
            }

            array_push($res,$item);
        }

        return $res;
    }


    public function setDummy()
    {
        $this->id = -1;
        $this->name = "";

        return $this;
    }




}
