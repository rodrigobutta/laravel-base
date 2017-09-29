<?php
namespace App\Modules\Tree;

use App\Modules\Tree\TreeRepositoryInterface;


use App\Helpers\Resize;
use App\Helpers\ResizeHelper;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Exception;
use MP;

class TreeFrontController extends Controller
{

    public function __construct(TreeRepositoryInterface $tree)
    {

        // view()->addNamespace('tree', app_path('Modules/tree/views/'));


        $this->tree = $tree;

    }


    // public function getList(Request $request){

    //     $breadcrumb = [];


    //     $items = TreeModel::where('parent_id', '=', 0)->wherePublished(1)->orderBy('lft', 'asc')->get();

    //     $page = $this->page->getBySlug('tree');
    //     $title = $page->title;

    //     // filtrar solo los treeos publicados
    //     // $tree = $tree->filter(function ($item) {
    //     //     return $item->isPublished();
    //     // })->values();



    //     return iView('tree::front.index', compact( 'items', 'page', 'title'));

    // }



    // public function getView(Request $request, $mslug = null){


    //     if($mslug==null){
    //         return $this->getList();
    //     }

    //     $c = explode('/', $mslug);

    //     try {
    //         $item = $this->tree->getBySlug(end($c));
    //     } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    //         return redirect()->route('home')->with('flashError', 'no encontrado');
    //     }


    //     $ancestors = $item->getAncestors();

    //     if ($item){


    //         \Event::fire('App\Events', $item);



    //         $breadcrumb = [];

    //         foreach ($ancestors as $i => $cat){

    //             $bc = new \stdClass();
    //                 $bc->link = $cat->getLink();
    //                 $bc->target = $cat->getLinkTarget();
    //                 $bc->title = $cat->title;
    //             array_push($breadcrumb, $bc);

    //         }
    //         array_pop($breadcrumb);

    //         $childs = TreeModel::where('parent_id', '=', $item->id)->wherePublished(1)->orderBy('lft', 'asc')->get();

    //         $brothers = TreeModel::where('parent_id', '=', $item->parent_id)->wherePublished(1)->orderBy('lft', 'asc')->get();


    //         $title = $item->title;


    //         return iView('tree::front.view', compact('item', 'title', 'breadcrumb', 'childs', 'brothers'));
    //     }
    // }

}
