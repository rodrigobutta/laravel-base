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
use App\Modules\Form\FormModel;


use App\Admin\Extensions\Tools\ReleasePost;
use App\Admin\Extensions\Tools\UserGender;


class EventAdminController extends Controller{

    use ResourceDispatcherTrait;

    public function __construct(){

    }


    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Eventos');
            $content->description('listado');

            $content->body($this->list());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {

        // fix reb por resources que no interpretan bien el method del controller
        if($id=="create"){
            return $this->create();
        }

        return Admin::content(function (Content $content) use ($id) {

            $content->header('evento');
            $content->description('editando');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('Evento');
            $content->description('creando');

            $content->body($this->form());
        });
    }

    /**
     * Admin init page
     *
     * @return Grid
     */
    protected function list()
    {
        return Admin::grid(EventModel::class, function (Grid $grid) {

            // $grid->id('ID');

            $grid->disableExport();
            $grid->disablePagination();
            $grid->disableRowSelector();

            $grid->filter(function($filter){
                $filter->disableIdFilter();
                // $filter->equal('column')->placeholder('Please input...');
                $filter->like('name', 'Nombre');
            });



            // $grid->column('name', 'Nombre');


            $grid->column('name',' ')->display(function () {
                return '<a href="' . route('events.manage', ['eventid' => $this->id]) . '">' . $this->name . '</a>';
            });

            // $grid->note()->editable('textarea');

            // $grid->campaigns()->display(function ($campaigns) {

            //     $campaigns = array_map(function ($campaign) {
            //         return "<span class='label label-primary'>{$campaign['name']}</span>";
            //     }, $campaigns);

            //     return join('&nbsp;', $campaigns);
            // });

            // $grid->forms()->display(function ($forms) {

            //     $forms = array_map(function ($form) {
            //         return "<span class='label label-primary'>{$form['name']}</span>";
            //     }, $forms);

            //     return join('&nbsp;', $forms);
            // });

            // $grid->actions(function ($actions) {

            //     $actions->prepend('<a href="'.route('events.manage', ['eventid' => $actions->row->id]).'"><i class="fa fa-cog"></i></a>');

            // });

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(EventModel::class, function (Form $form) {


           $form->disableReset();
           $form->tools(function (Form\Tools $tools) {
               // $tools->disableBackButton();
               $tools->disableListButton();
               // $tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
           });


            $form->text('name');
            $form->text('slug');

            $form->textarea('note');

            $form->saved(function ($form) {

                $success = new MessageBag([
                    'title'   => 'Evento Creado',
                    // 'message' => 'Feriados actualizados',
                ]);



                $campaign = new CampaignModel();
                $campaign->name = 'Test';
                $campaign->slug = 'test';
                $campaign->note = 'Campaña creada automáticamente con el evento para agrupar las pruebas de los distintos formularios';
                $campaign->event_id = $form->model()->id;
                $campaign->type_id = 1;
                $campaign->save();

                return redirect(route('events.manage',['eventid'=>$form->model()->id]));

                // back()->with(compact('success'));
            });


        });
    }





    public function manage($eventid){

        // Admin::css(asset('modules/form/css/editor.css'));
        // Admin::js(asset('modules/form/js/jquery.hotkeys.js'));

        $item = EventModel::findOrFail($eventid);

        return Admin::content(function (Content $content) use($item,$eventid){

            $content->header($item->name);
            // $content->description('editando');

            $content->row(
                view('event::admin.manage', compact('item'))
            );

        });

    }



}
