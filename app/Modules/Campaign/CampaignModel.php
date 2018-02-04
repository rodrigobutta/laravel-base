<?php
namespace App\Modules\Campaign;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Modules\User\UserListModel;
use App\Modules\Event\EventModel;
use App\Modules\Form\FormModel;
use App\Modules\Lead\LeadListModel;

class CampaignModel extends \App\Models\Profiled
{

    protected $table = 'campaign';

    protected $fillable = ['name', 'slug'];


    public function userlists()
    {
        return $this->belongsToMany(UserListModel::class, 'campaign_userlist', 'campaign_id', 'userlist_id');
    }

    public function leadlist()
    {
        return LeadListModel::where('campaign_id','=',$this->id)->where('type_id','=',3)->first();
    }


    public function event()
    {
        return $this->belongsTo(EventModel::class, 'event_id');
    }

    public function form()
    {
        return $this->belongsTo(FormModel::class, 'form_id');
    }


    public function type()
    {
        return $this->belongsTo(CampaignTypeModel::class, 'type_id');
    }


    public function getForm()
    {
        if($this->form){
            return $this->form;
        }
        else{
            $dummy = new FormModel();
            $dummy->setDummy();
            return $dummy;
        }

    }

}
