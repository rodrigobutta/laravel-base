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

use App\Modules\UserField\UserFieldModel;
use App\Modules\Lead\LeadModel;
use App\Modules\Event\EventModel;
use App\Modules\User\UserListModel;
use App\Modules\User\UserListTypeModel;
use App\Modules\Lead\LeadListModel;
use App\Modules\Lead\LeadListTypeModel;

use Illuminate\Support\MessageBag;


class FormAdminController extends Controller{

	use ResourceDispatcherTrait;


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
                      $content->header('Crear formulario para evento ' . $event->name);
                  }
                  else{
                     $content->header('Tareas');
                     $content->description('creando');
                  }

                  $content->body($this->form($eventId));

          });
	}


	protected function form($eventId = 0)
	{

		return Admin::form(FormModel::class, function (Form $form) use($eventId){


            $form->disableReset();
            $form->tools(function (Form\Tools $tools) {
                // $tools->disableBackButton();
                $tools->disableListButton();
                // $tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
            });


            if($eventId!=0){
                $form->hidden('event_id')->value($eventId);
            }
            else{
                $form->hidden('event_id');
            }

            $form->hidden('schema')->value("{}");

			$form->text('name','Nombre')->rules('required|min:5');
			$form->text('slug','Slug (url)')->rules('required|min:5');

            $states = [
                'on'  => ['value' => 1, 'text' => 'SI', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => 'NO', 'color' => 'default'],
            ];
            $form->switch("enabled","Activo")->states($states)->value(1);

            $form->divide();
            $form->html('<h3><i class="fa fa-list-alt"></i>&nbsp;Estilo del formulario</h3>');

            $form->image('cover_image','Imagen de portada')->help('1920px x 400px', 'fa-image')->uniqueName();;
            $form->image('footer_image','Imagen de pié')->help('1920px x 400px', 'fa-image')->uniqueName();;

            $form->divide();
            $form->html('<h3><i class="fa fa-question"></i>&nbsp;Cuadro de confirmación</h3>');

            $form->text('confirm_title','Título')->default('¿Confirma enviar el formulario?')->rules('required');
            $form->ckeditor('confirm_content','Contenido');
            $form->text('confirm_button_ok','Boton Aceptar')->default('Aceptar')->rules('required');
            $form->text('confirm_button_cancel','Boton Cancelar')->default('Cancelar')->rules('required');//->placeholder('Texto del botón cancelaro dejar vacio para ocultar el botón');

            $form->divide();
            $form->html('<h3><i class="fa fa-check"></i>&nbsp;Cuadro posterior al envio</h3>');

            $form->text('success_title','Título')->default('Gracias')->rules('required');
            $form->ckeditor('success_content','Contenido');
            $form->text('success_button_ok','Boton Aceptar')->default('Aceptar')->rules('required');
            $form->text('success_button_ok_action','Acción del botón aceptar')->placeholder('URL para redireccionar o dejar vacio para permanecer en la pantalla');

            $form->divide();
            $form->html('<h3><i class="fa fa-envelope"></i>&nbsp;Mail de confirmación al usuario</h3>');

            $states = [
                'on'  => ['value' => 1, 'text' => 'SI', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => 'NO', 'color' => 'default'],
            ];
            $form->switch("usermail_enabled","Activo")->states($states)->value(1);
            $form->text('usermail_subject','Asunto')->default('Gracias');
            $form->ckeditor('usermail_content','Cuerpo del mail');
            $form->file('attach','Documento de descarga');


            $form->divide();
            $form->html('<h3><i class="fa fa-envelope"></i>&nbsp;Mail de notificación al administrador</h3>');

            $states = [
                'on'  => ['value' => 1, 'text' => 'SI', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => 'NO', 'color' => 'default'],
            ];
            $form->switch("adminmail_enabled","Activo")->states($states)->value(1);
            $form->email('adminmail_to','E-mail')->placeholder('Casilla de mail que recibirá la notificación');


            $form->divide();
            $form->html('<h3><i class="fa fa-users"></i>&nbsp;Base Unificada de Usuarios</h3>');

            $form->multipleSelect('userlists','Agregar a las siguientes listas')->options(UserListModel::all()->pluck('name', 'id'));



            $form->saved(function ($form){

                $event = EventModel::findOrFail($form->model()->event_id);

               // CREO LISTA ASOCIADA

               // $leadlist = new LeadListModel();

                $leadlist = LeadListModel::firstOrNew(['type_id' => 2, 'form_id' => $form->model()->id]);

                   // $leadlistType = LeadListTypeModel::find(2);
                   // $leadlist->type()->associate($leadlistType);

                   $leadlist->form()->associate($form->model());

                   $leadlist->event()->associate($event);

               $leadlist->save();

                return redirect(route('events.manage',['eventid' => $event->id]));

            });


		});
	}





	public function schemaEditor($formid){

		// Admin::css(asset('modules/form/css/editor.css'));

		// Admin::css('https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.css');
		// Admin::js('https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js');
		// Admin::js('https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/i18n/jquery.spectrum-es.min.js');

		// Admin::js(asset('modules/form/js/jquery.hotkeys.js'));

		// Admin::js(asset('modules/form/js/knockout-3.4.2.js'));
		// Admin::js(asset('modules/form/js/knockout.mapping-latest.js'));
		// Admin::js(asset('modules/form/js/knockout-sortable.js'));

		// Admin::js(asset('modules/form/js/editor_custom.js'));
		// Admin::js(asset('modules/form/js/builder.js'));


		$item = FormModel::findOrFail($formid);


		return Admin::content(function (Content $content) use($item){

			$content->header($item->fullname);
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
