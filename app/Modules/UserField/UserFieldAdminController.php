<?php
namespace App\Modules\UserField;


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



class UserFieldAdminController extends Controller{

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

		return Admin::grid(UserFieldModel::class, function (Grid $grid) {

			$grid->id('ID');

			$grid->column('name', 'Nombre');
            $grid->column('slug', 'Código');
			$grid->column('title', 'Etiqueta');

			$grid->column('type')->display(function () {
				return $this->getFieldTypes($this->type);
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
		return Admin::form(UserFieldModel::class, function (Form $form) {

			$form->display('id', 'ID');

			$form->text('name', 'Nombre');
            $form->text('slug', 'Código');
			$form->text('title', 'Etiqueta');

			$form->select('type', 'Tipo')->options($form->model()->getFieldTypes());

			$form->hasMany('choices', function (Form\NestedForm $form) {
			    $form->text('title');
			    $form->text('name');
			});

		});
	}





}
