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


use RodrigoButta\Admin\Form;
use RodrigoButta\Admin\Grid;
use RodrigoButta\Admin\Facades\Admin;
use RodrigoButta\Admin\Layout\Content;
use RodrigoButta\Admin\Layout\Column;
use RodrigoButta\Admin\Layout\Row;
use RodrigoButta\Admin\Traits\ResourceDispatcherTrait;

use App\Modules\Campaign\CampaignModel;


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

            $grid->id('ID');

            $grid->column('name', 'Nombre');

            $grid->note()->editable('textarea');

            $grid->campaigns()->display(function ($campaigns) {

                $campaigns = array_map(function ($campaign) {
                    return "<span class='label label-primary'>{$campaign['name']}</span>";
                }, $campaigns);

                return join('&nbsp;', $campaigns);
            });

            $grid->actions(function ($actions) {

                $actions->prepend('<a href="'.route('events.manage', ['eventid' => $actions->row->id]).'"><i class="fa fa-cog"></i></a>');

            });

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

            $form->display('id', 'ID');

            $form->text('name');
            $form->text('slug');

            $form->textarea('note');

            // $form->hasMany('campaigns', function (Form\NestedForm $form) {
            //     $form->text('name');
            //     $form->text('slug');
            // });

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

        });
    }





    public function manage($eventid){

        // Admin::css(asset('modules/form/css/editor.css'));
        // Admin::js(asset('modules/form/js/jquery.hotkeys.js'));


        $item = EventModel::findOrFail($eventid);


        return Admin::content(function (Content $content) use($item,$eventid){

            $content->header('evento');
            $content->description('editando');

            $campaigns = $item->campaigns;

            // \Debugbar::info($campaigns);


            $content->row(
                view('event::admin.manage.startup', compact('item'))
            );

            $content->row(function (Row $row) use($item) {

                $row->column(8, function (Column $column) use($item) {
                    $column->append(


                        Admin::grid(CampaignModel::class, function (Grid $grid) use($item) {

                            $grid->id('ID');

                            $grid->column('name', 'Nombre');

                            $grid->note()->editable('textarea');

                            $grid->model()->where('event_id', '=', $item->id);

                            $grid->disablePagination();
                            $grid->disableFilter();
                            $grid->disableExport();
                            $grid->disableCreation();

                            $grid->tools(function ($tools) {
                                $tools->append(new UserGender());
                            });

                            $grid->tools(function ($tools) {
                                $tools->batch(function ($batch) {
                                    $batch->add('Release post', new ReleasePost(1));
                                    $batch->add('Unrelease post', new ReleasePost(0));
                                });
                            });


                        })


                    );
                });

                $row->column(4, function (Column $column) {
                    $column->append("222");
                });

            });


            // $content->body(view('event::admin.manage.campaigns', compact('campaigns')));

        });

    }



}
