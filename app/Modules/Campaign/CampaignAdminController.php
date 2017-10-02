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

use App\Modules\Mailist\MailistModel;


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
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('Campaña');
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
        return Admin::grid(CampaignModel::class, function (Grid $grid) {

            $grid->id('ID');

            $grid->column('name', 'Nombre');
            $grid->column('slug', 'Slug');

            $grid->note()->editable('textarea');

            $published_states = [
                'on'  => ['value' => 0, 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => 1, 'text' => 'NO', 'color' => 'default'],
            ];
            $grid->enabled()->switch($published_states);

            $grid->mailists()->display(function ($mailists) {

                $mailists = array_map(function ($mailist) {
                    return "<span class='label label-primary'>{$mailist['name']}</span>";
                }, $mailists);

                return join('&nbsp;', $mailists);
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
        return Admin::form(CampaignModel::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('name');
            $form->text('slug');

            $form->textarea('note');

            $enabled_states = [
                'on'  => ['value' => 0, 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => 1, 'text' => 'NO', 'color' => 'default'],
            ];
            $form->switch("enabled")->states($enabled_states);

            $form->multipleSelect('mailists')->options(MailistModel::all()->pluck('name', 'id'));

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


}
