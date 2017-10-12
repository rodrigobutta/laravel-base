<?php
namespace App\Modules\Campaign;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Modules\UserList\UserListModel;
use App\Modules\Event\EventModel;

class CampaignModel extends \App\Models\Profiled
{

    protected $table = 'campaign';

    protected $fillable = ['name', 'slug'];


    public function userlists()
    {
        return $this->belongsToMany(UserListModel::class, 'campaign_userlist', 'campaign_id', 'userlist_id');
    }

    public function event()
    {
        return $this->belongsTo(EventModel::class, 'event_id');
    }

}
