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



use App\Modules\Lead\LeadRepositoryInterface;



class LeadAdminController extends Controller{

	use ResourceDispatcherTrait;

    public function __construct(LeadRepositoryInterface $lead)
    {
        $this->leadRepository = $lead;
    }



    public function leadlistManage($itemId){

        $item = LeadListModel::findOrFail($itemId);

        return Admin::content(function (Content $content) use($item){

            $content->header($item->event->name . ' - Lista > ' . $item->fullname);

            $fields = $item->getFields();



            // $schema y $formfields lo usamos para mostar form de alta en el admin

            if($form = $item->getform()){

                $schema = json_decode($form->schema);

                $formFields = $schema->fields;

                foreach ($formFields as &$field) {

                    if($field->type == 'select' && isset($field->nature) && $field->nature == 'userfield'){

                        $userfieldId = str_replace('userfield_','',$field->id_name);

                        $userfield = UserFieldModel::findOrFail($userfieldId);

                        $field->choices = $userfield->choices;

                    }
                }

            }
            else{
                $schema = null;
                $formFields = [];
            }





            $content->row(
                view('lead::admin.leadlist.manage', compact('item','fields','formFields','schema'))->render()
            );

        });

    }

    protected function leadlistBatchRemoveitem($itemId, Request $request)
    {

        $ids = $request->get('ids');

        $arrIds = explode(',', $ids);

        if($this->leadRepository->removeFromList($itemId,$arrIds)){
            $response = sizeof($arrIds) . ' conversiones eliminadas de la lista';
            $status = 'success';
        }
        else{
            $response = 'Error al eliminar';
            $status = 'danger';
        }

        return response()->json([
            'message' => $response,
            'status' => $status
        ]);

    }




    public function leadlistExport($itemId){

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





    public function cloneList(Request $request, $itemId){

        if($item = $this->leadRepository->cloneList($itemId)){
            return redirect()->back()->with('flashSuccess', 'Lista Clonada');
        }
        else{
            return redirect()->back()->with('flashError', 'No se pudo clonar');
        }

    }



    public function editList($itemId){

        $item = LeadListModel::findOrFail($itemId);

        // return Admin::content(function (Content $content) use($item){

        //     $content->header($item->event->name . ' - Lista > ' . $item->fullname);

        //     $content->row(
                return view('lead::admin.leadlist.edit', compact('item'))->render();
        //     );

        // });

    }


    protected function saveList(Request $request)
    {
        $id = $request->get("item_id");

        $item = LeadListModel::findOrFail($id);

        $item->name = $request->get("name");
        $item->description = $request->get("description");

        $item->save();

        return response()->json([
            'route' => route('events.manage', ['itemId' => $item->event_id]),
            'status' => '200'
        ]);

    }







    public function leadlistAddManual(Request $request, $itemId){

        $item = LeadListModel::findOrFail($itemId);

        if($form = $item->getForm()){

            $fields = $request->all();

            $lead = $this->leadRepository->put($fields,$form->id,null,true,$item->id);

        }

        return back();

    }

}
