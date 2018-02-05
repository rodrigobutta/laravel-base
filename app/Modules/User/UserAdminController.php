<?php
namespace App\Modules\User;



// TODO revisar que use no se usan

use Cache;
use Excel;
use App\Helpers\Resize;
use App\Helpers\ResizeHelper;

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



class UserAdminController extends Controller{

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

            $content->header('header');
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

            $content->header('header');
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

            $content->header('header');
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
        return Admin::grid(UserModel::class, function (Grid $grid) {

            $grid->id('ID');

            $grid->column('name', 'Nombre');
            $grid->column('surname', 'Apellido');
            $grid->column('email', 'E-mail');

            $grid->note()->editable('textarea');

            $published_states = [
                'on'  => ['value' => 0, 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => 1, 'text' => 'NO', 'color' => 'default'],
            ];
            $grid->enabled()->switch($published_states);

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(UserModel::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('name', 'Nombre');
            $form->text('surname', 'Apellido');
            $form->text('email', 'E-mail');
            $form->text('dni', 'DNI');

            $form->textarea('note');

            $enabled_states = [
                'on'  => ['value' => 0, 'text' => 'YES', 'color' => 'primary'],
                'off' => ['value' => 1, 'text' => 'NO', 'color' => 'default'],
            ];
            $form->switch("enabled")->states($enabled_states);



            // $form->hasMany('fields', function (Form\NestedForm $form) {
            //     $form->text('title');
            //     $form->text('type');
            // });


            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

        });
    }






    public function userManage($itemId){

        $item = UserModel::findOrFail($itemId);

        return Admin::content(function (Content $content) use($item){

            $content->header($item->name);

            // $fields = $item->getFields();

            // $content->row(
            //     view('lead::admin.leadlist.manage', compact('item','fields'))->render()
            // );

        });

    }







}
