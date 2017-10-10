<?php
namespace App\Modules\Lead;

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

use App\Modules\UserField\UserFieldModel;


class LeadAdminController extends Controller{

	use ResourceDispatcherTrait;

	// private $module_assets_path = 'modules/lead';


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

			$content->header('Conversiones');
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

			$content->header('Conversion');
			$content->description('Resumen');

            $item = LeadModel::findOrFail($id);

            $fields = $item->getFields();


            $content->row(
                view('lead::admin.resume', compact('fields'))
            );


			// $content->body($this->form()->edit($id));
		});
	}

	/**
	 * Create interface.
	 *
	 * @return Content
	 */
	public function create()
	{

        // TODO no deberia pasar nunca por este circuito porque el lead llega de un form

		return Admin::content(function (Content $content) {

			$content->header('Conversion');
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
		return Admin::grid(LeadModel::class, function (Grid $grid) {

			$grid->id('ID');

            $grid->form()->display(function ($form) {
                if($form){
                    return $form['name'];
                }
                return '';
            });

            $grid->campaign()->display(function ($campaign) {
                if($campaign){
                    return $campaign['name'];
                }
                return '';
            });

			$grid->event()->display(function ($event) {
			    if($event){
			        return $event['name'];
			    }
			    return '';
			});


			// $grid->actions(function ($actions) {

			//     $actions->prepend('<a href="'.route('leads.schema', ['leadid' => $actions->row->id]).'"><i class="fa fa-list-alt"></i></a>');

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

        return Admin::form(LeadModel::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('data');

            var_dump($form->model()->data);

            // $form->multipleSelect('mailists')->options(MailistModel::all()->pluck('name', 'id'));

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

        });

	}




}
