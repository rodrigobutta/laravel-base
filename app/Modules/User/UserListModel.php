<?php
namespace App\Modules\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Modules\User\UserModel;
use App\Modules\UserField\UserFieldModel;


class UserListModel extends \App\Models\Profiled
{

    protected $table = 'userlist';

    protected $appends = ['fullname'];


    public function users()
    {
        return $this->belongsToMany(UserModel::class, 'userlist_user', 'userlist_id', 'user_id');
    }

    public function type()
    {
        return $this->belongsTo(UserListTypeModel::class, 'type_id');
    }

    public function getFullnameAttribute()
    {
        return $this->name;
    }

    public function usersCount()
    {
        return \DB::table("userlist_user")
        ->select(\DB::raw("COUNT(*) as count_row"))
        ->where('userlist_id','=',$this->id)
        ->pluck('count_row')->first();
    }

    public function getFields()
    {
        $res = UserFieldModel::all();

        return $res;
    }


}