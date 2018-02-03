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
use App\Modules\UserList\UserListTypeModel;
use App\Modules\UserField\UserFieldModel;
use App\Modules\Lead\LeadModel;
use App\Modules\Event\EventModel;

use Illuminate\Support\MessageBag;


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


            // $item = FormModel::findOrFail($id);

			// $content->header($item->name);
            $content->header('Formulario');
			$content->description('editando');

            $content->body($this->form()->edit($id));
			// $content->body($this->form($item->event_id)->edit($id));
		});
	}

	/**
	 * Create interface.
	 *
	 * @return Content
	 */
	public function create(Request $request)
    {

        if($request->has('event_id')){
            $eventId = $request->get('event_id');
        }
        else{
            $eventId = 0;
        }



        return Admin::content(function (Content $content) use($eventId) {

        		if($eventId!=0){
                      $event = EventModel::find($eventId);
                      $content->header('Crear tarea para evente: ' . $event->name);
                  }
                  else{
                     $content->header('Tareas');
                     $content->description('creando');
                  }

                  $content->body($this->form($eventId));

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
	protected function form($eventId = 0)
	{

		return Admin::form(FormModel::class, function (Form $form) use($eventId){


            $form->disableReset();
            $form->tools(function (Form\Tools $tools) {
                // $tools->disableBackButton();
                $tools->disableListButton();
                // $tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
            });

            // dd($eventId);

            if($eventId==0){

                $form->select('event_id','Evento')->options(function ($id) {
                    $event = EventModel::find($id);
                    if ($event) {
                        return [$event->id => $event->name];
                    }
                })->ajax('/admin/api/events');

            }
            else{

                $event = EventModel::findOrFail($eventId);

                $form->hidden('event_id')->value($event->id);

                $form->display('Evento')->value($event->name);


            }

            $form->hidden('schema')->value("{}");

			$form->text('name');
			$form->text('slug');

			$form->textarea('note');

            $form->divide();

            $form->ckeditor('description','Descripción');
            $form->image('cover_image','Imagen de portada')->help('1920px x 400px', 'fa-image')->uniqueName();;
            $form->image('footer_image','Imagen de pié')->help('1920px x 400px', 'fa-image')->uniqueName();;

            $form->textarea('confirm_title','Confirmación: Título');
            $form->ckeditor('confirm_content','Confirmación: Contenido');
            $form->text('confirm_button_ok','Confirmación: Boton Aceptar');
            $form->text('confirm_button_cancel','Confirmación: Boton Cancelar');

            $form->textarea('success_title','Formulario Enviado: Título');
            $form->ckeditor('success_content','Formulario Enviado: Contenido');
            $form->text('success_button_ok','Formulario Enviado: Boton Aceptar');
            $form->text('success_button_ok_action','Formulario Enviado: Acción del botón aceptar');

            $form->file('attach','Documento de descarga');


            $form->divide();

			// $enabled_states = [
			// 	'on'  => ['value' => 0, 'text' => 'YES', 'color' => 'primary'],
			// 	'off' => ['value' => 1, 'text' => 'NO', 'color' => 'default'],
			// ];
			// $form->switch("enabled")->states($enabled_states);

			$form->multipleSelect('userlists','Listas de destino')->options(UserListModel::all()->pluck('name', 'id'));

			// $form->display('created_at', 'Created At');
			// $form->display('updated_at', 'Updated At');


            $form->saved(function ($form){

                $success = new MessageBag([
                    'title'   => 'Formulario Creado',
                    // 'message' => 'Feriados actualizados',
                ]);


                $event = EventModel::findOrFail($form->model()->event_id);

               // CREO LISTA ASOCIADA

               $userlist = new UserListModel();

                   // $userlist->name = $item->name;
                   $userlist->description = 'Lista creada para alojar las conversiones del formulario';

                   $userlistType = UserListTypeModel::find(1);
                   $userlist->type()->associate($userlistType);

                   $userlist->form()->associate($form->model());

                   $userlist->event()->associate($event);

               $userlist->save();




                return redirect(route('events.manage',['eventid' => $event->id]));

            });


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

			$content->header($item->name);
			// $content->description('editando');

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




    public function previewEmail($formid, $email){

        $form = FormModel::findOrFail($formid);

        $lead = LeadModel::findOrFail(40);

        // return view('form::emails.notification')->with([
        //             'lead' => $lead,
        //             'form' => $form
        //           ]);

        return view('form::emails.confirm')->with([
                    'name' => 'Test',
                    'form' => $form
                  ]);

    }


}
