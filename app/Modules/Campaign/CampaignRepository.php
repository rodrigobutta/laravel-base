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

    public function __construct(
                                CampaignModel $campaign
                                )
    {
        $this->campaign = $campaign;
    }


    public function getById($id)
    {
        return $this->campaign->where('id', $id)->firstOrFail();
    }


    public function getBySlug($slug)
    {
        return $this->campaign->where('slug', $slug)->firstOrFail();
    }


    public function create($item,$eventId,$typeId){

        // $item->event_id = $eventId;
        // $item->type_id = $typeId;

        $event = EventModel::find($eventId);
        $item->event()->associate($event);

        $campaignType = CampaignTypeModel::find($typeId);
        $item->type()->associate($campaignType);

        // if(!$item->name){
        //     $item->name = 'Todos';
        // }

        if(!isset($item->slug)){
            $item->slug = @str_slug($item->name);
        }

        $item->save();


        // CREO LISTA ASOCIADA

        $leadlist = new LeadListModel();

            $leadlistType = LeadListTypeModel::find(3);
            $leadlist->type()->associate($leadlistType);

            $leadlist->campaign()->associate($item);

            $leadlist->event()->associate($event);

        $leadlist->save();




        return $item;
    }


    public function delete($id){

        $item = CampaignModel::findOrFail($id);

        $item->delete();

        return true;

    }


}
