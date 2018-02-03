<?php

namespace App\Modules\Campaign;

use App\Modules\Event\EventModel;

use App\Modules\Campaign\CampaignModel;
use App\Modules\Campaign\CampaignRepositoryInterface;

use App\Modules\UserList\UserListModel;
use App\Modules\UserList\UserListTypeModel;


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

        $userlist = new UserListModel();

            // $userlist->name = $item->name;
            $userlist->description = 'Lista creada para alojar las conversiones de la campaña';

            $userlistType = UserListTypeModel::find(2);
            $userlist->type()->associate($userlistType);

            $userlist->campaign()->associate($item);

            $userlist->event()->associate($event);

        $userlist->save();




        return $item;
    }


    public function delete($id){

        $item = CampaignModel::findOrFail($id);

        $item->delete();

        return true;

    }


}
