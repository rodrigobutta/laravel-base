<?php

namespace App\Modules\Campaign;

use App\Modules\Event\EventModel;

use App\Modules\Campaign\CampaignModel;
use App\Modules\Campaign\CampaignRepositoryInterface;

use App\Modules\User\UserListModel;
use App\Modules\User\UserListTypeModel;

use App\Modules\Lead\LeadListModel;
use App\Modules\Lead\LeadListTypeModel;


use App\Helpers\ResizeHelper;

use Auth;
use Carbon\Carbon;
use DB;
use File;
use Illuminate\Support\Facades\Cache;

class CampaignRepository implements CampaignRepositoryInterface
{

    public function __construct(CampaignModel $campaign){
        $this->campaign = $campaign;
    }


    public function getById($id){
        return $this->campaign->where('id', $id)->firstOrFail();
    }


    public function getBySlug($slug){
        return $this->campaign->where('slug', $slug)->firstOrFail();
    }


    public function create($item,$eventId,$typeId){

        $event = EventModel::find($eventId);
        $item->event()->associate($event);

        $campaignType = CampaignTypeModel::find($typeId);
        $item->type()->associate($campaignType);

        if(!isset($item->slug)){
            $item->slug = @str_slug($item->name);
        }

        $item->save();

        $this->createAssocLeadlist($item);
        // CREO LISTA ASOCIADA
        // $leadlist = new LeadListModel();

        //     $leadlistType = LeadListTypeModel::find(3);
        //     $leadlist->type()->associate($leadlistType);

        //     $leadlist->campaign()->associate($item);

        //     $leadlist->event()->associate($event);

        // $leadlist->save();

        return $item;
    }


    private function createAssocLeadlist($item){

        $leadlist = new LeadListModel();

            $leadlistType = LeadListTypeModel::find(3);
            $leadlist->type()->associate($leadlistType);

            $leadlist->campaign()->associate($item);

            $leadlist->event_id = $item->event_id;

        $leadlist->save();

        return $leadlist;
    }


    public function delete($id){

        $item = CampaignModel::findOrFail($id);

        $item->delete();

        return true;
    }


    public function sendMails($itemId){

        $item = CampaignModel::findOrFail($itemId);

        $recipents = [];

        // vamos con la lista de leads
        if($item->destinationLeadlist){

            foreach ($item->destinationLeadlist->leads as $lead) {

                // si no encuentro el email en el lead (userfield_1), no puedo agregarlo al envio
                if($email=$lead->getEmail()){

                    $send = new SendModel();
                    $send->campaign_id = $item->id;
                    $send->lead_id = $lead->id;
                    $send->email = $email;
                    $send->created_at = Carbon::now();
                    $send->save();

                    $recipents[$email] = $lead->getFieldsArray();
                    $recipents[$email]['pixel'] = route('campaign.pixel',["sendId" => $send->id]) ;
                    $recipents[$email]['cta'] =  $item->link($send->id);

                }

            }

        }
        else{
            // vamos con la lista de usuarios

            foreach ($item->userlists as $u) {

                foreach ($u->users as $user) {

                    // si no encuentro el email en el lead (userfield_1), no puedo agregarlo al envio
                    if($email=$user->getEmail()){

                        $send = new SendModel();
                        $send->campaign_id = $item->id;
                        $send->user_id = $user->id;
                        $send->email = $email;
                        $send->created_at = Carbon::now();
                        $send->save();

                        $recipents[$email] = $user->getFieldsArray();
                        $recipents[$email]['pixel'] = route('campaign.pixel',["sendId" => $send->id]) ;
                        $recipents[$email]['cta'] =  $item->link($send->id);

                    }

                }

            }

        }


        $subject = $item->mail_subject;

        $data = [
            // 'title' => $subject,
            // 'url' => $item->link(),
            'content' => $item->mail_html,
            // 'topimage' => env('APP_URL') . '/storage/admin/' . $item->form->cover_image,
            // 'bottomimage' => env('APP_URL') . '/storage/admin/' . $item->form->footer_image
        ];

        // \Mailgun::send('campaign::emails.template1', $data, function ($message) use($recipents,$subject) {
        \Mailgun::send('campaign::emails.template-blank', $data, function ($message) use($recipents,$subject) {
            $message
            ->subject($subject)
            ->to($recipents);
        });


        return sizeof($recipents);

    }




    public function clone($itemId){

        $item = CampaignModel::findOrFail($itemId);

        $new = $item->replicate();
        $new->name = $new->name . ' - Copia ' . str_random(4);
        $new->slug = @str_slug($new->name);
        $new->push();

        $this->createAssocLeadlist($new);

        foreach($item->userlists as $u){
            // $item->userlists()->attach([$u->id => ['order'=>$u->pivot->order]]);
            $new->userlists()->attach($u->id);
        }

        // foreach($source->links as $l){
        //     $link = $l->replicate();
        //     $link->product()->associate($item->id);
        //     $link->push();
        // }

        return $new;

    }


}
