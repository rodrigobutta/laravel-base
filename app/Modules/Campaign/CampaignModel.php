<?php
namespace App\Modules\Campaign;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Modules\User\UserListModel;
use App\Modules\Event\EventModel;
use App\Modules\Form\FormModel;
use App\Modules\Lead\LeadListModel;
use App\Modules\Campaign\SendModel;

use App\Modules\Api\UploadModel;

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

    public function sends()
    {
        return $this->hasMany(SendModel::class, 'campaign_id');
    }

    public function uploads()
    {
        return $this->hasMany(UploadModel::class, 'campaign_id');
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

    public function getStatus()
    {

        if($this->type_id < 3){
            return CampaignStatusModel::find(3);
        }
        else{


            if($this->sentCount() > 0){
                return CampaignStatusModel::find(3);
            }
            else{

                switch ($this->type_id) {

                    case 2: //social

                        if($this->social_title!='' && $this->social_description!=''){
                            return CampaignStatusModel::find(2);
                        }
                        else{
                            return CampaignStatusModel::find(1);
                        }
                        break;

                    case 3: //mail

                        if(($this->leadlist() || $this->userlists) && $this->mail_subject!='' && $this->mail_html!=''){
                            return CampaignStatusModel::find(2);
                        }
                        else{
                            return CampaignStatusModel::find(1);
                        }
                        break;

                    default:
                        # code...
                        return CampaignStatusModel::find(2);

                        break;
                }



            }


        }

        // return $this->belongsTo(CampaignStatusModel::class, 'status_id');
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

    public function getDestinaionCount()
    {
        if($this->destinationLeadlist){
            return $this->destinationLeadlist->leadsCount();
        }
        else{

            $res = 0;
            foreach ($this->userlists as $u) {
                $res = $res + $u->usersCount();
            }

            return $res;
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


    public function sentCount()
    {
        return \DB::table("send")
        ->select(\DB::raw("COUNT(*) as count_row"))
        ->where('campaign_id','=',$this->id)
        ->pluck('count_row')->first();
    }

    public function seenCount()
    {
        return \DB::table("send")
        ->select(\DB::raw("COUNT(*) as count_row"))
        ->where('campaign_id','=',$this->id)
        ->whereNotNull('seen_at')
        ->pluck('count_row')->first();
    }


    public function leadsCount()
    {
        return \DB::table("lead")
        ->select(\DB::raw("COUNT(*) as count_row"))
        ->where('campaign_id','=',$this->id)
        ->pluck('count_row')->first();
    }


    public function link($sendId=0)
    {

        if($this->form){
            return route('forms.view', ['eventSlug' => $this->event->slug, 'formSlug' => $this->form->slug, 'campaign' => $this->slug, 's' => $sendId]);
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
