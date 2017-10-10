<?php
namespace App\Modules\Form;


use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
// use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Exception;
use MP;

use App\Modules\Form\FormRepositoryInterface;
use App\Modules\Lead\LeadRepositoryInterface;

use App\Modules\UserField\UserFieldModel;

class FormFrontController extends Controller
{

    public function __construct(
            FormRepositoryInterface $form,
            LeadRepositoryInterface $lead
    )
    {
        // view()->addNamespace('form', app_path('Modules/form/views/'));
        $this->form = $form;
        $this->lead = $lead;
    }


    public function getView(Request $request, $formslug = null){


        $c = explode('/', $formslug);

        try {
            $item = $this->form->getBySlug(end($c));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('home')->with('flashError', 'no encontrado');
        }


        $schema = json_decode($item->schema);


        $fields = $schema->fields;


        foreach ($fields as &$field) {

            if($field->type == 'select' && isset($field->nature) && $field->nature == 'userfield'){

                $userfieldId = str_replace('userfield_','',$field->id_name);

                $userfield = UserFieldModel::findOrFail($userfieldId);


                $field->choices = $userfield->choices;


            }
        }

        // \Event::fire('App\Events', $item);

        $title = $item->title;

        return view('form::front.view', compact('item', 'title', 'fields'));

    }



    public function pushLead(Request $request, $formslug = null){

        try {
            $form = $this->form->getBySlug($formslug);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'ERROR' => 'form not found'
            ]);
        }


        $fields = $request->all();

        $this->lead->put($fields,$form->id);


        // \Event::fire('App\Events', $item);

        return response()->json([
            'response' => true,
            'state' => 'CA'
        ]);

    }



}
