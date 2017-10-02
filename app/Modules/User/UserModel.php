<?php
namespace App\Modules\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Modules\Mailist\MailistModel;


class UserModel extends \App\Models\Profiled
{

    protected $table = 'user';

    public function mailists()
    {
        return $this->belongsToMany(MailistModel::class, 'mailist_user', 'user_id', 'mailist_id');
    }

}
