<?php

namespace App\Modules\Tree;

use App\Modules\Tree\TreeModel;
use App\Modules\Tree\TreeRepositoryInterface;

use Auth;
use Carbon\Carbon;
use DB;
use File;
use Illuminate\Support\Facades\Cache;

class TreeRepository implements TreeRepositoryInterface
{

    public function __construct(
                                TreeModel $tree
                                )
    {
        $this->tree = $tree;

    }

    public function getById($id)
    {
        return $this->posts()->where('id', $id)->with('user', 'info')->firstOrFail();
    }


    public function getBySlug($slug)
    {
        return $this->posts()->where('slug', $slug)->with('user', 'info')->firstOrFail();
    }

    private function posts(){

        // si es admin o superadmin no limitar el universo a los aprobados
        if(auth()->check() && (auth()->user()->isSuper() || auth()->user()->isAdmin())){
            $posts = $this->tree->published();
        }
        else{
            $posts = $this->tree->approved()->published();
        }

        return $posts;
    }


    public function getAll(){
        $tree = $this->posts()->orderBy('sort'); //->with('user', 'comments', 'favorites');
        return $tree->paginate(perPage());
    }


    public function incrementViews($tree)
    {
        $tree->views = $tree->views + 1;
        $tree->timestamps = false;
        $tree->save(['updated_at' => false]);

        return $tree;
    }


    public function search($search)
    {
        $extends = explode(' ', $search);

        $tree = $this->posts()->where('title', 'LIKE', '%' . $search . '%')
            ->orWhere('tags', 'LIKE', '%' . $search . '%')
            ->whereNull('deleted_at')->whereNotNull('approved_at')->orderBy('approved_at', 'desc');

        foreach ($extends as $extend) {
            if(strlen($extend) >= 3) {
                $tree->orWhere('tags', 'LIKE', '%' . $extend . '%')->whereNotNull('approved_at')->whereNull('deleted_at')
                    ->orWhere('title', 'LIKE', '%' . $extend . '%')->whereNotNull('approved_at')->whereNull('deleted_at')
                    ->orWhere('description', 'LIKE', '%' . $extend . '%')->whereNotNull('approved_at')->whereNull('deleted_at');
            }
        }

        return $tree = $tree->with('user')->whereNotNull('approved_at')->whereNull('deleted_at')->paginate(perPage());
    }



    public function delete($id){

        $item = TreeModel::findOrFail($id);


        if(!$item->canHandle()){
            return false;
            // return redirect()->route('admin')->with('flashSuccess', t('Insufficient permissions for this object'));
        }



        // elimino recursivamente
        foreach ($item->children as $child) {
            $this->delete($child->id);
        }

        $item->delete();

        return true;

    }


}
