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
        return $this->posts()->where('id', $id)->with('campaign', 'info')->firstOrFail();
    }


    public function getBySlug($slug)
    {
        return $this->posts()->where('slug', $slug)->with('campaign', 'info')->firstOrFail();
    }

    private function posts(){

        // si es admin o superadmin no limitar el universo a los aprobados
        if(auth()->check() && (auth()->campaign()->isSuper() || auth()->campaign()->isAdmin())){
            $posts = $this->campaign->published();
        }
        else{
            $posts = $this->campaign->approved()->published();
        }

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
        $extends = explode(' ', $search);

        $campaign = $this->posts()->where('title', 'LIKE', '%' . $search . '%')
            ->orWhere('tags', 'LIKE', '%' . $search . '%')
            ->whereNull('deleted_at')->whereNotNull('approved_at')->orderBy('approved_at', 'desc');

        foreach ($extends as $extend) {
            if(strlen($extend) >= 3) {
                $campaign->orWhere('tags', 'LIKE', '%' . $extend . '%')->whereNotNull('approved_at')->whereNull('deleted_at')
                    ->orWhere('title', 'LIKE', '%' . $extend . '%')->whereNotNull('approved_at')->whereNull('deleted_at')
                    ->orWhere('description', 'LIKE', '%' . $extend . '%')->whereNotNull('approved_at')->whereNull('deleted_at');
            }
        }

        return $campaign = $campaign->with('campaign')->whereNotNull('approved_at')->whereNull('deleted_at')->paginate(perPage());
    }



    public function delete($id){

        $item = CampaignModel::findOrFail($id);


        if(!$item->canHandle()){
            return false;
            // return redirect()->route('admin')->with('flashSuccess', t('Insufficient permissions for this object'));
        }


        // elimino el archivo fisico de la imagen
        if(has($item->main_image)){
            $delete = new ResizeHelper( $item->main_image, 'tasks');
            $delete->delete();
        }



        $item->info()->delete();


        // elimino recursivamente
        foreach ($item->children as $child) {
            $this->delete($child->id);
        }

        $item->delete();

        return true;

    }


}
