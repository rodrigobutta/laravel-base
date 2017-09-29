<?php
namespace App\Modules\Tree;

use App\Http\Controllers\Controller;

use RodrigoButta\Admin\Form;
use RodrigoButta\Admin\Tree;
use RodrigoButta\Admin\Facades\Admin;
use RodrigoButta\Admin\Layout\Content;
use RodrigoButta\Admin\Traits\ResourceDispatcherTrait;



class TreeAdminController extends Controller{

    use ResourceDispatcherTrait;

    public function __construct(TreeRepositoryInterface $p){
        $this->treeRepository = $p;
    }

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {

        return Admin::content(function (Content $content) {

            $content->header('Modelo de Categorias');

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

        return TreeModel::tree();
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(TreeModel::class, function (Form $form) {

            $form->display('id', 'ID');
            // $form->hidden('user_id', '1');

            $form->text('title');
            // $form->text('description');

            // $published_states = [
            //     'on'  => ['value' => 0, 'text' => 'YES', 'color' => 'primary'],
            //     'off' => ['value' => 1, 'text' => 'NO', 'color' => 'default'],
            // ];
            // $form->switch("published")->states($published_states);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

        });
    }



}
