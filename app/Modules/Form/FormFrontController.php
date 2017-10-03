<?php
namespace App\Modules\Form;

use App\Modules\Form\FormRepositoryInterface;


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

class FormFrontController extends Controller
{

    public function __construct(FormRepositoryInterface $form)
    {

        // view()->addNamespace('form', app_path('Modules/form/views/'));


        $this->form = $form;
    }


    // public function getList(Request $request){

    //     $breadcrumb = [];


    //     $items = FormModel::where('parent_id', '=', 0)->wherePublished(1)->orderBy('lft', 'asc')->get();

    //     $page = $this->page->getBySlug('form');
    //     $title = $page->title;

    //     // filtrar solo los formos publicados
    //     // $form = $form->filter(function ($item) {
    //     //     return $item->isPublished();
    //     // })->values();



    //     return iView('form::front.index', compact( 'items', 'page', 'title'));

    // }



    // public function getView(Request $request, $mslug = null){


    //     if($mslug==null){
    //         return $this->getList();
    //     }

    //     $c = explode('/', $mslug);

    //     try {
    //         $item = $this->form->getBySlug(end($c));
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

    //         $childs = FormModel::where('parent_id', '=', $item->id)->wherePublished(1)->orderBy('lft', 'asc')->get();

    //         $brothers = FormModel::where('parent_id', '=', $item->parent_id)->wherePublished(1)->orderBy('lft', 'asc')->get();


    //         $title = $item->title;


    //         return iView('form::front.view', compact('item', 'title', 'breadcrumb', 'childs', 'brothers'));
    //     }
    // }

}
