<?php
namespace App\Modules\Form;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Modules\User\UserListModel;
use App\Modules\Event\EventModel;
use App\Modules\Lead\LeadListModel;

use \App\Traits\MetaTrait;

class FormModel extends \App\Models\Profiled
{
    use MetaTrait;

    protected $table = 'form';

    public function userlists()
    {
        return $this->belongsToMany(UserListModel::class, 'form_userlist', 'form_id', 'userlist_id');
    }

    public function event()
    {
        return $this->belongsTo(EventModel::class, 'event_id');
    }

    public function leadlist()
    {
        return $this->hasMany(LeadListModel::class, 'form_id')->where('type_id','=',2)->first();;
    }

    public function leadsCount()
    {
        return \DB::table("lead")
        ->select(\DB::raw("COUNT(*) as count_row"))
        ->where('form_id','=',$this->id)
        ->pluck('count_row')->first();
    }


    public function fullUserListsArray()
    {

        $res = [];


        foreach ($this->userlists as $v) {
            array_push($res, $v->id);
        }

        // $this->event->


        return $res;
    }


    // devuelve un array con la info de todos los campos del formulario
    // array (size=4)
    //   0 =>
    //     object(stdClass)[577]
    //       public 'type' => string 'email' (length=5)
    //       public 'schema' => string '' (length=0)
    //       public 'nature' => string 'userfield' (length=9)
    //       public 'title' => string 'E-mail' (length=6)
    //       public 'is_required' => boolean false
    //       public 'inline' => boolean false
    //       public 'id_name' => string 'userfield_1' (length=11)
    //       public 'append' => string 'No' (length=2)
    //       public 'prepend' => string 'No' (length=2)
    //       public 'prepend_text' => string '' (length=0)
    //       public 'prepend_icon' => string '' (length=0)
    //       public 'append_text' => string '' (length=0)
    //       public 'append_icon' => string '' (length=0)
    //       public 'placeholder' => string '' (length=0)
    //       public 'instructions' => string '' (length=0)
    //       public 'id' => int 6
    //   1 =>
    //     object(stdClass)[723]
    //       public 'type' => string 'text' (length=4)
    //       public 'schema' => string '' (length=0)
    //       public 'nature' => string 'userfield' (length=9)
    //       public 'title' => string 'Nombre' (length=6)
    //       public 'is_required' => boolean false
    //       public 'inline' => boolean false
    //       public 'id_name' => string 'userfield_3' (length=11)
    //       public 'append' => string 'No' (length=2)
    //       public 'prepend' => string 'No' (length=2)
    //       public 'prepend_text' => string '' (length=0)
    //       public 'prepend_icon' => string '' (length=0)
    //       public 'append_text' => string '' (length=0)
    //       public 'append_icon' => string '' (length=0)
    //       public 'placeholder' => string '' (length=0)
    //       public 'instructions' => string '' (length=0)
    //       public 'id' => int 7
    public function getFields()
    {
        $res = [];

        $schema = json_decode($this->schema);
        $res = $schema->fields;

        return $res;
    }



    // public function getFieldByName($fieldName)
    // {
    //     $fields = $this->getFields();



    //     return findObjectInArray($fields,'id');
    // }


    public static function scopePublic(){
        return static::where('enabled',1);
    }


    public function setDummy()
    {
        $this->id = -1;
        $this->name = "";

        return $this;
    }


}
