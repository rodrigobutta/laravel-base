<?php
namespace App\Modules\UserList;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Modules\User\UserModel;
use App\Modules\Campaign\CampaignModel;


class UserListModel extends \App\Models\Profiled
{

    protected $table = 'userlist';


    public function campaigns()
    {
        return $this->belongsToMany(CampaignModel::class, 'campaign_userlist', 'userlist_id', 'campaign_id');
    }

    public function users()
    {
        return $this->belongsToMany(UserModel::class, 'userlist_user', 'userlist_id', 'user_id');
    }
}