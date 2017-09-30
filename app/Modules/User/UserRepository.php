<?php

namespace App\Modules\User;

use App\Modules\User\UserModel;
use App\Modules\User\UserRepositoryInterface;

use App\Helpers\ResizeHelper;

use Auth;
use Carbon\Carbon;
use DB;
use File;
use Illuminate\Support\Facades\Cache;

class UserRepository implements UserRepositoryInterface
{

    public function __construct(
                                UserModel $user
                                )
    {
        $this->user = $user;

    }

    public function getById($id)
    {
        // return $this->posts()->where('id', $id)->with('user', 'comments', 'comments.replies', 'favorites', 'info')->firstOrFail();
        return $this->posts()->where('id', $id)->with('user', 'info')->firstOrFail();
    }


    public function getBySlug($slug)
    {
        return $this->posts()->where('slug', $slug)->with('user', 'info')->firstOrFail();
    }

    private function posts(){

        // si es admin o superadmin no limitar el universo a los aprobados
        if(auth()->check() && (auth()->user()->isSuper() || auth()->user()->isAdmin())){
            $posts = $this->user->published();
        }
        else{
            $posts = $this->user->approved()->published();
        }

        return $posts;
    }


    public function getAll(){
        $user = $this->posts()->orderBy('sort'); //->with('user', 'comments', 'favorites');
        return $user->paginate(perPage());
    }


    public function incrementViews($user)
    {
        $user->views = $user->views + 1;
        $user->timestamps = false;
        $user->save(['updated_at' => false]);

        return $user;
    }


    public function search($search)
    {
        $extends = explode(' ', $search);

        $user = $this->posts()->where('title', 'LIKE', '%' . $search . '%')
            ->orWhere('tags', 'LIKE', '%' . $search . '%')
            ->whereNull('deleted_at')->whereNotNull('approved_at')->orderBy('approved_at', 'desc');

        foreach ($extends as $extend) {
            if(strlen($extend) >= 3) {
                $user->orWhere('tags', 'LIKE', '%' . $extend . '%')->whereNotNull('approved_at')->whereNull('deleted_at')
                    ->orWhere('title', 'LIKE', '%' . $extend . '%')->whereNotNull('approved_at')->whereNull('deleted_at')
                    ->orWhere('description', 'LIKE', '%' . $extend . '%')->whereNotNull('approved_at')->whereNull('deleted_at');
            }
        }

        return $user = $user->with('user')->whereNotNull('approved_at')->whereNull('deleted_at')->paginate(perPage());
    }



    public function delete($id){

        $item = UserModel::findOrFail($id);


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
