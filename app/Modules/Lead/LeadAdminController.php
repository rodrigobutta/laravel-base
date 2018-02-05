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
use App\Modules\Form\FormModel;
use App\Modules\User\UserModel;


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


            $user = UserModel::findOrFail(1);

            $userfields = $user->getFields();


            $content->row(
                view('lead::admin.resume', compact('fields','userfields'))
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

            // $form->multipleSelect('userlists')->options(UserListModel::all()->pluck('name', 'id'));

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

        });

	}






    public function leadlistManage($itemId)
    {

        $item = LeadListModel::findOrFail($itemId);


        return Admin::content(function (Content $content) use($item){

            $content->header($item->event->name . ' - Lista > ' . $item->fullname);

            $fields = $item->getFields();

            $content->row(
                view('lead::admin.leadlist.manage', compact('item','fields'))->render()
            );


        });




    }



    public function leadlistExport($itemId)
    {


        $item = LeadListModel::findOrFail($itemId);

        // $form = FormModel::findOrFail($formId);

        \Excel::create($item->event->name . '-' . $item->fullname, function($excel) use($item){

            $excel->sheet('Datos', function($sheet) use($item){

                $sheet->setOrientation('landscape');

                // $leads = LeadModel::where('form_id', '=',  $form->id)->with('campaign')->get();


				$first=true;

                foreach ($item->leads as $key => $lead) {

					$fields = $lead->getfields();

					// $row = [
                    //     'appended', 'appended', $lead->created_at,
					// ];

					if($first){
						$first=false;

						$row = array_column($fields, 'title');

                        // append de campos
                        array_push($row,'Fecha');

						$sheet->appendRow($row);
					}

					$row = array_column($fields, 'value');

                    // append de campos
                    array_push($row,$lead->created_at);

                    $sheet->appendRow($row);


                    // $sheet->appendRow([
                    //     'appended', 'appended', $lead->created_at
                    // ]);


                }

                $sheet->cells('A1:G1', function($cells) {

                    $cells->setBackground('#000000');
                    $cells->setFontColor('#ffffff');
                    $cells->setFontSize(12);
                    $cells->setFontWeight('bold');

                });


                $sheet->setColumnFormat(array(
                   'E' => '0',
                   'F' => '0'
                ));



            });

        })->export('xls');

    }





}
