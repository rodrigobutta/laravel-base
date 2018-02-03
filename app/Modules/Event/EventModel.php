<?php
namespace App\Modules\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Modules\Campaign\CampaignModel;
use App\Modules\Form\FormModel;
use App\Modules\UserList\UserListModel;


use Illuminate\Database\Eloquent\SoftDeletes;


class EventModel extends \App\Models\Profiled
{
    use SoftDeletes;

    protected $table = 'event';

    protected $fillable = ['id','name'];

    protected $dates = ['deleted_at'];

    public function campaigns()
    {
        return $this->hasMany(CampaignModel::class, 'event_id');
    }

    public function forms()
    {
        return $this->hasMany(FormModel::class, 'event_id');
    }


    public function privateUserLists()
    {
        return $this->hasMany(UserListModel::class, 'event_id');
    }


}
