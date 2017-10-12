<?php
namespace App\Modules\Form;

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
use App\Modules\UserField\UserFieldModel;


class FormAdminController extends Controller{

	use ResourceDispatcherTrait;


	// private $module_assets_path = 'modules/form';


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

			$content->header('Formularios');
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

			$content->header('formulario');
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
		return Admin::grid(FormModel::class, function (Grid $grid) {

			$grid->id('ID');

			$grid->column('name', 'Nombre');
			$grid->column('slug', 'Slug');

			$grid->note()->editable('textarea');

			$published_states = [
				'on'  => ['value' => 0, 'text' => 'YES', 'color' => 'primary'],
				'off' => ['value' => 1, 'text' => 'NO', 'color' => 'default'],
			];
			$grid->enabled()->switch($published_states);


			$grid->event()->display(function ($event) {

			    if($event){
			        return $event['name'];
			    }
			    return '';

			});


			$grid->userlists()->display(function ($userlists) {

				$userlists = array_map(function ($userlist) {
					return "<span class='label label-primary'>{$userlist['name']}</span>";
				}, $userlists);

				return join('&nbsp;', $userlists);
			});

			$grid->actions(function ($actions) {

			    $actions->prepend('<a href="'.route('forms.schema', ['formid' => $actions->row->id]).'"><i class="fa fa-list-alt"></i></a>');

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
		return Admin::form(FormModel::class, function (Form $form) {

			$form->display('id', 'ID');

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





	public function schemaEditor($formid){

		Admin::css(asset('modules/form/css/editor.css'));

		Admin::css('https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.css');
		Admin::js('https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js');
		Admin::js('https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/i18n/jquery.spectrum-es.min.js');

		Admin::js(asset('modules/form/js/jquery.hotkeys.js'));

		Admin::js(asset('modules/form/js/knockout-3.4.2.js'));
		Admin::js(asset('modules/form/js/knockout.mapping-latest.js'));
		Admin::js(asset('modules/form/js/knockout-sortable.js'));

		Admin::js(asset('modules/form/js/editor_custom.js'));
		Admin::js(asset('modules/form/js/builder.js'));


		$item = FormModel::findOrFail($formid);


		return Admin::content(function (Content $content) use($item){

			$content->header('formulario');
			$content->description('editando');

			$schema = $item->schema;

			// \Debugbar::info($schema);

			$userFields = UserFieldModel::all();

			$content->body(view('form::admin.schema.edit', compact('item', 'schema', 'userFields')));

		});

	}


	public function schemaUpdate($formid, Request $request){

		$form = FormModel::findOrFail($formid);

		$form->schema = $request->get('schema');

		$form->save();

		return response([
			'status'  => true,
			'message' => trans('admin.update_succeeded'),
		]);

	}


}
