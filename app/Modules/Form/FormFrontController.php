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
use App\Modules\Campaign\CampaignRepositoryInterface;
use App\Modules\Campaign\CampaignModel;
use App\Modules\UserField\UserFieldModel;
use App\Modules\Campaign\SendModel;

use Illuminate\Support\MessageBag;


class FormFrontController extends Controller
{

    public function __construct(
            FormRepositoryInterface $form,
            CampaignRepositoryInterface $campaign,
            LeadRepositoryInterface $lead
    )
    {
        // view()->addNamespace('form', app_path('Modules/form/views/'));
        $this->form = $form;
        $this->campaign = $campaign;
        $this->lead = $lead;
    }


    public function getView(Request $request, $eventSlug, $formSlug){

        if(!$item = $this->form->getByComb($eventSlug,$formSlug)){
            // return redirect()->route('home')->with('flashError', 'Formulario no activo');
            abort(404);
        }

        // INCREMENTAR VIEWS
        $item->views = $item->views + 1;
        $item->timestamps = false;
        $item->save(['updated_at' => false]);

        // si viene con parametro de envio (Desde un mail) lo marco como CTA
        if($request->has('s')){
            $send = SendModel::whereId($request->get('s'))->first();
            if(!is_null($send)) {
                // $send = SendModel::find($request->get('s'));
                $send->cta_at = Carbon::now();
                $send->save();
            }
        }
        else{
            $send = null;
        }


        // RECONOCIMIENTO DE CAMPAÑA PARA INCREMENTAR SUS VIEWS
        if($request->has('campaign')){

            $campaign_slug = $request->get('campaign');
            $campaign = CampaignModel::where('slug', $campaign_slug)->where('event_id', $item->event_id)->first();

            if($campaign){
                $campaign->views = $campaign->views + 1;
                $campaign->timestamps = false;
                $campaign->save(['updated_at' => false]);
            }

            if($campaign_slug!='test'){
                $title = $campaign->social_title;
                $description = $campaign->social_description;
            }
            else{
                $title = $item->event->name . ' - ' . $item->name . ' [' . $campaign->name . ']';
                $description = '';
            }

        }
        else{
            $title = $item->event->name . ' - ' . $item->name;
            $description = '';
        }


        if($item->type_id==2 && isset($item->redirect) && $item->redirect!=''){
            return redirect($item->redirect);
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




        return view('form::front.view', compact('item', 'title', 'description', 'fields', 'schema','send'));

    }



    public function pushLead(Request $request, $eventSlug, $formSlug){


        try {

            $form = $this->form->getByComb($eventSlug,$formSlug);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'ERROR' => 'No se encontró el formulario'
            ]);
        }


        $fields = $request->all();


        // RECONOCIMIENTO DE CAMPAÑA
        if($request->has('campaign')){

            $campaign_slug = $request->get('campaign');

            $campaign = CampaignModel::where('slug', $campaign_slug)->where('event_id', $form->event_id)->first();

            if($campaign){
                $lead = $this->lead->put($fields,$form->id, $campaign->id);
            }
            else{
                $lead = $this->lead->put($fields,$form->id);
            }

        }
        else{

            $lead = $this->lead->put($fields,$form->id);

        }


        // si el formulario viene de un mail de campa@a, seguro tenga el parametro s, que se imprime como hidden de send_id, si existe, aviso al send que fue eficaz
        if($request->has('send_id')){
            $send = SendModel::whereId($request->get('send_id'))->first();
            if(!is_null($send)) {
                // $send = SendModel::find($request->get('s'));
                $send->completed_at = Carbon::now();
                $send->save();
            }
        }


        $errors = '';
        // try {

            // MAIL AL USUARIO
            if($form->usermail_enabled){

                // si no recupero el mail del form, no puedo enviar confirmacion
                if($email = $lead->getEmail()){

                    $recipents = [];
                    $recipents[$email] = $lead->getFieldsArray();
                    // $recipents[$email]['pixel'] = route('campaign.pixel',["sendId" => $send->id]) ;
                    // $recipents[$email]['cta'] =  $item->link($send->id);

                    $subject = $form->mail_subject;

                    $data = [
                        'content' => $form->mail_html,
                    ];

                    \Mailgun::send('form::emails.template-blank', $data, function ($message) use($recipents,$subject) {
                        $message
                        ->subject($subject)
                        ->to($recipents);
                    });


                }

            }

            // MAIL AL ADMIN
            if($form->adminmail_enabled){

                // si no recupero el mail del form, no puedo enviar confirmacion
                if(isset($form->adminmail_to) && $form->adminmail_to!=''){

                    $subject = 'Nueva conversion para el formulario ' . $form->name;

                    $data = [
                        'title' => $subject,
                        'form' => $form,
                        'lead' => $lead
                    ];

                    \Mailgun::send('form::emails.notification', $data, function ($message) use($subject, $form) {
                        $message
                        ->subject($subject)
                        ->to($form->adminmail_to);
                    });

                }

            }

        // } catch (Exception $e) {
        //     // $mailResponse = $e->xdebug_message;
        //     $errors = $e->getMessage();
        // }


        return response()->json([
            'response' => true,
            'message' => $form->success_title,
            'content' => $form->success_content,
            'errors' => $errors,
            'status' => 'success'
        ]);

    }




// HASH ENCRYPT QUE VA EN MAIL


    // define('AES_256_CBC', 'aes-256-cbc');


    // $encryption_key = "rbutta83key";


    // $data = '{"valid":1,"campaign":1,"form":"1","user":1}';

    // // Generate an initialization vector
    // // This *MUST* be available for decryption as well
    // $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(AES_256_CBC));

    // $encrypted = openssl_encrypt($data, AES_256_CBC, $encryption_key, 0, $iv);

    // echo "Encrypted: $encrypted\n";



    // $decrypted = openssl_decrypt($encrypted, AES_256_CBC, $encryption_key, 0, $iv);
    // echo "Decrypted: $decrypted\n";

}
