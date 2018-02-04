<?php
namespace App\Modules\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Modules\User\UserModel;
use App\Modules\Campaign\CampaignModel;
use App\Modules\Form\FormModel;
use App\Modules\Event\EventModel;
use App\Modules\Lead\LeadModel;


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

        switch ($this->type_id) {
            case 1:
                return $this->type->name . ': ' . $this->event->name;
            case 2:
                return $this->type->name . ': ' . $this->form->name;
            case 3:
                return $this->type->name . ': ' . $this->campaign->name;
            default:
                return $this->name;
                break;
        }

    }



    public function usersCount()
    {
        return \DB::table("userlist_user")
        ->select(\DB::raw("COUNT(*) as count_row"))
        ->where('userlist_id','=',$this->id)
        ->pluck('count_row')->first();
    }


}