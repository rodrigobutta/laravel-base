<?php
namespace App\Modules\Campaign;

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
use RodrigoButta\Admin\Traits\ResourceDispatcherTrait;

use App\Modules\UserList\UserListModel;
use App\Modules\Event\EventModel;


class CampaignAdminController extends Controller{

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

            $content->header('Campañas');
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

            $content->header('campaña');
            $content->description('editando');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create(Request $request)
    {

        $eventid = $request->get('eventid') || 0;

        return Admin::content(function (Content $content) use($eventid) {

            $content->header('Campaña');
            $content->description('creando');

            $content->body($this->form($eventid));
        });
    }

    /**
     * Admin init page
     *
     * @return Grid
     */
    protected function list()
    {
        return Admin::grid(CampaignModel::class, function (Grid $grid) {

            $grid->id('ID');

            $grid->column('name', 'Nombre');
            $grid->column('slug', 'Slug');

            $grid->event()->display(function ($event) {

                if($event){
                    return $event['name'];
                }
                return '';

            });

            $grid->note()->editable('textarea');

            $published_states = [
                'on'  => ['value' => 0, 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => 1, 'text' => 'NO', 'color' => 'default'],
            ];
            $grid->enabled()->switch($published_states);

            $grid->userlists()->display(function ($userlists) {

                $userlists = array_map(function ($userlist) {
                    return "<span class='label label-primary'>{$userlist['name']}</span>";
                }, $userlists);

                return join('&nbsp;', $userlists);
            });

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($eventid = 0)
    {
        return Admin::form(CampaignModel::class, function (Form $form) use($eventid) {


            $form->disableReset();
            $form->tools(function (Form\Tools $tools) {
                // $tools->disableBackButton();
                $tools->disableListButton();
                // $tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
            });

            // $form->display('id', 'ID');

            if($eventid!=0){

                $event = EventModel::findOrFail($eventid);


                $form->hidden('event_id')->value($eventid);

                $form->display('Evento')->value($event->name);
            }



            $form->text('name');
            $form->text('slug');



            $form->textarea('note');

            $enabled_states = [
                'on'  => ['value' => 0, 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => 1, 'text' => 'NO', 'color' => 'default'],
            ];
            $form->switch("enabled")->states($enabled_states);

            $form->multipleSelect('userlists')->options(UserListModel::all()->pluck('name', 'id'));

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

        });
    }





    public function testMail(Request $request){

        $data = [
            'campaign' => 'Campaña de prueba 2',
            'url' => 'http://muypunch.com'
        ];

        \Mailgun::send('campaign::emails.test', $data, function ($message) {

            $message->to([
                    'rbutta@gmail.com' => [
                        'name' => 'Rodrigo Butta',
                        'city' => 'New York'
                    ],
                    'info@muypunch.com' => [
                        'name' => 'Empresa Muypunch',
                        'city' => 'London'
                    ]
                ]);

        });


        return json_encode("mail enviado");
    }





    // /**
    //  * Create interface.
    //  *
    //  * @return Content
    //  */
    // public function createForevent($eventid)
    // {
    //     return Admin::content(function (Content $content) use($eventid){

    //         $content->header('Campaña');
    //         $content->description('creando');

    //         $content->body($this->form($eventid));
    //     });
    // }



}
