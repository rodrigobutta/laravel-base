<?php
namespace App\Modules\Event;

use Cache;

use App\Models\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\MessageBag;

use RodrigoButta\Admin\Form;
use RodrigoButta\Admin\Grid;
use RodrigoButta\Admin\Facades\Admin;
use RodrigoButta\Admin\Layout\Content;
use RodrigoButta\Admin\Layout\Column;
use RodrigoButta\Admin\Layout\Row;
use RodrigoButta\Admin\Traits\ResourceDispatcherTrait;

use App\Modules\Campaign\CampaignModel;
use App\Modules\Campaign\CampaignRepositoryInterface;
use App\Modules\Form\FormModel;
use App\Modules\Lead\LeadListModel;
use App\Modules\Lead\LeadListTypeModel;

use App\Admin\Extensions\Tools\ReleasePost;
use App\Admin\Extensions\Tools\UserGender;


class EventAdminController extends Controller{

    use ResourceDispatcherTrait;

    public function __construct(CampaignRepositoryInterface $c){
         $this->campaignRepository = $c;
     }


    public function index()
    {

        return Admin::content(function (Content $content){

            $items = EventModel::all();

            $content->header('Eventos');
            $content->description('adasad');

            $content->row(
                view('event::admin.common', compact('item'))->render()
            );

            $content->row(
                view('event::admin.navigator', compact('items'))->render()
            );

        });

    }




    // public function edit($id)
    // {

    //     // fix reb por resources que no interpretan bien el method del controller
    //     if($id=="create"){
    //         return $this->create();
    //     }

    //     return Admin::content(function (Content $content) use ($id) {

    //         $content->header('evento');
    //         $content->description('editando');

    //         $content->body($this->form()->edit($id));
    //     });
    // }


    // public function create()
    // {
    //     return Admin::content(function (Content $content) {

    //         $content->header('Evento');
    //         $content->description('creando');

    //         $content->body($this->form());
    //     });
    // }


    // protected function list()
    // {
    //     return Admin::grid(EventModel::class, function (Grid $grid) {

    //         // $grid->id('ID');

    //         $grid->disableExport();
    //         $grid->disablePagination();
    //         $grid->disableRowSelector();

    //         $grid->filter(function($filter){
    //             $filter->disableIdFilter();
    //             // $filter->equal('column')->placeholder('Please input...');
    //             $filter->like('name', 'Nombre');
    //         });


    //         $grid->column('name',' ')->display(function () {
    //             return '<a href="' . route('events.manage', ['itemId' => $this->id]) . '">' . $this->name . '</a>';
    //         });


    //     });
    // }

    // protected function form()
    // {
    //     return Admin::form(EventModel::class, function (Form $form) {


    //        $form->disableReset();
    //        $form->tools(function (Form\Tools $tools) {
    //            // $tools->disableBackButton();
    //            $tools->disableListButton();
    //            // $tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
    //        });


    //         $form->text('name');
    //         // $form->text('slug');

    //         $form->text('slug')->value('');

    //         $form->textarea('note');

    //         // $form->saving(function (Form $form) {

    //         //     $form->model()->slug = @str_slug($form->model()->name);

    //         // });


    //         $form->saved(function ($form) {

    //             $success = new MessageBag([
    //                 'title'   => 'Evento Creado',
    //                 // 'message' => 'Feriados actualizados',
    //             ]);


    //             $leadlist = new LeadListModel();

    //                 $leadlistType = LeadListTypeModel::find(1);
    //                 $leadlist->type()->associate($leadlistType);

    //                 $leadlist->event()->associate($event);

    //             $leadlist->save();


    //             $campaign = new CampaignModel();
    //                 $campaign->name = 'Test';
    //                 // $campaign->slug = 'test';
    //                 $campaign->note = 'Campaña creada automáticamente con el evento para agrupar las pruebas de los distintos formularios';
    //             $this->campaignRepository->create($campaign,$form->model()->id,1);


    //             return redirect(route('events.manage',['eventid'=>$form->model()->id]));

    //             // back()->with(compact('success'));
    //         });


    //     });
    // }





    public function manage($itemId){

        // Admin::css(asset('modules/form/css/editor.css'));
        // Admin::js(asset('modules/form/js/jquery.hotkeys.js'));

        $item = EventModel::findOrFail($itemId);

        return Admin::content(function (Content $content) use($item,$itemId){

            $content->header($item->name);
            // $content->description('editando');




            // $leadsRs =  DB::select("
            //      select compute.date,
            //             assign.role_id as role_id,
            //             admin_roles.name as role_name,
            //             sum(compute.hours) as total_hours
            //      from compute, assign
            //      inner join admin_roles on admin_roles.id = assign.role_id
            //      where compute.assign_id = assign.id
            //         and (assign.event_id in({$bindingsfamilyIds})
            //         or assign.event_id in(select dd.id from event as dd where dd.parent_id= assign.event_id))
            //         group by compute.date, role_id, role_name
            //     ", $familyIds);


            // $chronComputes = [];
            // foreach($period as $date){
            //     foreach ($roleList as $role) {
            //         $chronComputes[$date->format("Y-m-d")][$role->id] = 0;
            //     }
            // }



            $content->row(
                view('event::admin.manage', compact('item'))
            );

        });

    }







    protected function partialsCreate($parentId=0)
    {

        return view('event::admin.partials.form')->render();
    }

    protected function partialsSave(Request $request)
    {

        $item = new EventModel();

        $item->name = $request->get("name");
        $item->description = $request->get("description");
        $item->slug = @str_slug($item->name);

        $item->save();


        $leadlist = new LeadListModel();

            $leadlistType = LeadListTypeModel::find(1);
            $leadlist->type()->associate($leadlistType);

            $leadlist->event()->associate($item);

        $leadlist->save();


        $campaign = new CampaignModel();
            $campaign->name = 'Test';
            $campaign->note = 'Campaña creada automáticamente con el evento para agrupar las pruebas de los distintos formularios';
        $this->campaignRepository->create($campaign,$item->id,1);


        return response()->json([
            'route' => route('events.manage', ['itemId' => $item->id]),
            'state' => '200'
        ]);

    }




    protected function partialsEditableSave(Request $request)
    {

        $item = EventModel::find($request->get("pk"));

        $item{$request->get("name")} = $request->get("value");

        $item->save();

        return response()->json([
            'message' => 'Cambios guardados!',
            'status' => 'success',
            'element' => $item
        ]);

    }




}
