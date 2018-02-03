<?php
namespace App\Modules\UserList;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Modules\User\UserModel;
use App\Modules\Campaign\CampaignModel;
use App\Modules\Form\FormModel;
use App\Modules\Event\EventModel;


class UserListModel extends \App\Models\Profiled
{

    protected $table = 'userlist';

    protected $appends = ['fullname'];


    public function campaigns()
    {
        return $this->belongsToMany(CampaignModel::class, 'campaign_userlist', 'userlist_id', 'campaign_id');
    }

    public function users()
    {
        return $this->belongsToMany(UserModel::class, 'userlist_user', 'userlist_id', 'user_id');
    }

    public function type()
    {
        return $this->belongsTo(UserListTypeModel::class, 'type_id');
    }

    public function campaign()
    {
        return $this->belongsTo(CampaignModel::class, 'campaign_id');
    }

    public function form()
    {
        return $this->belongsTo(FormModel::class, 'form_id');
    }

    public function event()
    {
        return $this->belongsTo(EventModel::class, 'event_id');
    }




    public function getFullnameAttribute()
    {

        if($this->campaign){
            return $this->type->name . ': ' . $this->campaign->name;
        }
        else if($this->form){
            return $this->type->name . ': ' . $this->form->name;
        }
        else{
            return $this->name;
        }

    }


}