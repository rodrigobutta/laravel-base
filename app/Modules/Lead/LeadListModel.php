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


    protected $fillable = ['type_id', 'event_id', 'form_id', 'campaign_id'];



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

    // es de test si fue creada desde el evento y no tuiene map ni campana asociados
    public function isTest()
    {

        if(!$this->form && !$this->campaign){
            return true;
        }
        else if( $this->campaign && $this->campaign->type_id==1){
            return true;
        }
        else{
            return false;
        }

    }


    public function getFullnameAttribute()
    {

        switch ($this->type_id) {
            case 1:
                return $this->type->name . ' - ' . $this->event->name;
            case 2:
                return $this->type->name . ' - ' . $this->form->name;
            case 3:
                return $this->type->name . ' - ' . $this->campaign->name;
            default:
                return $this->name;
                break;
        }

    }


    public function getName()
    {

        switch ($this->type_id) {
            case 1:
                return $this->event->name;
            case 2:
                return $this->form->name;
            case 3:
                return $this->campaign->name;
            default:
                return $this->name;
        }

    }


    // obtengo algun formulario ya sea el propio o el de su campaña
    public function getForm()
    {

        if($this->form){
            return $this->form;
        }
        else{
            return $this->campaign->form;
        }

    }

    // devuelve array con campos que se manejaron en la leadlist en base a su propio form o el de su campaña
    public function getFields()
    {
        return $this->getForm()->getFields();
    }


    public function setDummy()
    {
        $this->id = -1;
        $this->name = "";

        return $this;
    }

    public function leadsCount()
    {
        return \DB::table("leadlist_lead")
        ->select(\DB::raw("COUNT(*) as count_row"))
        ->where('leadlist_id','=',$this->id)
        ->pluck('count_row')->first();
    }


}