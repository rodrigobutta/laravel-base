<?php
namespace App\Modules\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Modules\UserList\UserListModel;


class UserModel extends \App\Models\Profiled
{

    protected $table = 'user';

    protected $fillable = ['email','name','surname','dni'];

    public function userlists()
    {
        return $this->belongsToMany(UserListModel::class, 'userlist_user', 'user_id', 'userlist_id');
    }

}
