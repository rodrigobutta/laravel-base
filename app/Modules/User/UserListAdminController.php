<?php
namespace App\Modules\User;


// TODO revisar que use no se usan

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

use App\Modules\User\UserModel;


class UserListAdminController extends Controller{

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

            $content->header('Base de Usuarios Unificada');
            $content->description('userlistado');

            $content->body($this->grid());
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

            $content->header('Base de Usuarios Unificada');
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

            $content->header('Base de Usuarios Unificada');
            $content->description('creando');

            $content->body($this->form());
        });
    }

    /**
     * Admin init page
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(UserListModel::class, function (Grid $grid) {

            // $grid->disableFilter();
            $grid->disableExport();
            // $grid->disablePagination();

            $grid->filter(function($filter){
                $filter->disableIdFilter();


                $filter->in('type_id','Tipo')->multipleSelect('/admin/api/userlisttypes');

                // $filter->in('user_id','Usuario')->multipleSelect('/admin/api/users');

                // $filter->equal('column')->placeholder('Please input...');
                // $filter->like('date', 'Fecha');
                // $filter->like('name', 'Nombre');

                // $filter->between('date', 'Año')->date();
                // $filter->year('date', 'Año');

            });

            $grid->column('name', 'Nombre')->sortable();;

            $grid->description('Descripción')->editable('textarea');


            $grid->type('Tipo')->display(function ($item) {
                if($item){
                   return '<i class="fa ' . $item['icon'] . '"></i>&nbsp;' . $item['name'];
                }
                return '';
            });

            $grid->users('Cantidad de usuarios')->display(function ($users) {

                // $users = array_map(function ($user) {
                //     return "<span class='label label-primary'>{$user['name']}</span>";
                // }, $users);

                // return join('&nbsp;', $users);

                return sizeof($users);


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
        return Admin::form(UserListModel::class, function (Form $form) {

            // $form->display('id', 'ID');


            $form->disableReset();
            $form->tools(function (Form\Tools $tools) {
                // $tools->disableBackButton();
                $tools->disableListButton();
                // $tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
            });


            $form->text('name','Nombre');
            $form->text('description','Descripción');

            // $enable_states = [
            //     'on'  => ['value' => 1, 'text' => 'YES', 'color' => 'primary'],
            //     'off' => ['value' => 0, 'text' => 'NO', 'color' => 'default'],
            // ];
            // $form->switch("enabled")->states($enable_states);

            $form->multipleSelect('users','Usuarios')->options(UserModel::all()->pluck('name', 'id'));

        });
    }

}
