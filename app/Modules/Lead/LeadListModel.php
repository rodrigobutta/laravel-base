<?php
namespace App\Modules\Lead;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Modules\Campaign\CampaignModel;
use App\Modules\Form\FormModel;
use App\Modules\Event\EventModel;
use App\Modules\Lead\LeadModel;


class LeadListModel extends \App\Models\Profiled
{

    protected $table = 'leadlist';

    protected $appends = ['fullname'];


    public function campaigns()
    {
        return $this->belongsToMany(CampaignModel::class, 'campaign_leadlist', 'leadlist_id', 'campaign_id');
    }

    public function leads()
    {
        return $this->belongsToMany(LeadModel::class, 'leadlist_lead', 'leadlist_id', 'lead_id');
    }

    public function type()
    {
        return $this->belongsTo(LeadListTypeModel::class, 'type_id');
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



    public function leadsCount()
    {
        return \DB::table("leadlist_lead")
        ->select(\DB::raw("COUNT(*) as count_row"))
        ->where('leadlist_id','=',$this->id)
        ->pluck('count_row')->first();
    }


}