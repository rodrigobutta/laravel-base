<?php
namespace App\Modules\UserField;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserFieldChoiceModel extends \App\Models\Profiled
{

    protected $table = 'user_field_choice';

    protected $fillable = ['name', 'title'];


    public function userField()
    {
        return $this->belongsTo(UserFieldModel::class, 'user_field_id');
    }



}
