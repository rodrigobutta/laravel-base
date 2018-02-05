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


    public function destinationLeadlist()
    {
        return $this->belongsTo(LeadListModel::class, 'destination_leadlist_id');
    }

    public function getDestinaionLeadlist()
    {
        if($this->destinationLeadlist){
            return $this->destinationLeadlist;
        }
        else{
            $dummy = new LeadListModel();
            $dummy->setDummy();
            return $dummy;
        }

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


    public function leadsCount()
    {
        return \DB::table("lead")
        ->select(\DB::raw("COUNT(*) as count_row"))
        ->where('campaign_id','=',$this->id)
        ->pluck('count_row')->first();
    }


    public function link()
    {

        if($this->form){
            return route('forms.view', ['eventSlug' => $this->event->slug, 'formSlug' => $this->form->slug, 'campaign' => $this->slug]);
        }
        else{
            return '';
        }

    }


    public function fullname()
    {

        return urlencode($this->event->name . ' - ' . $this->form->name);

    }

    public function encodedFullname()
    {

        return urlencode($this->event->name . ' - ' . $this->form->name);

    }

}
