<?php
namespace App\Modules\UserList;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserListTypeModel extends \App\Models\Profiled
{

    protected $table = 'userlist_type';

    protected $fillable = ['name'];



}
