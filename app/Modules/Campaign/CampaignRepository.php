<?php

namespace App\Modules\Campaign;

use App\Modules\Campaign\CampaignModel;
use App\Modules\Campaign\CampaignRepositoryInterface;

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
        // return $this->posts()->where('id', $id)->with('campaign', 'comments', 'comments.replies', 'favorites', 'info')->firstOrFail();
        return $this->posts()->where('id', $id)->firstOrFail();
    }


    public function getBySlug($slug)
    {
        return $this->posts()->where('slug', $slug)->firstOrFail();
    }

    private function posts(){

        $posts = $this->campaign;

        return $posts;
    }


    public function getAll(){
        $campaign = $this->posts()->orderBy('sort'); //->with('campaign', 'comments', 'favorites');
        return $campaign->paginate(perPage());
    }


    public function incrementViews($campaign)
    {
        $campaign->views = $campaign->views + 1;
        $campaign->timestamps = false;
        $campaign->save(['updated_at' => false]);

        return $campaign;
    }


    public function search($search)
    {
        return null;
    }



    public function delete($id){

        $item = CampaignModel::findOrFail($id);

        $item->delete();

        return true;

    }


}
