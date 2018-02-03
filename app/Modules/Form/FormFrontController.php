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


        // $c = explode('/', $formSlug);


        try {

            $item = $this->form->getByComb($eventSlug,$formSlug);

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



    public function pushLead(Request $request, $eventSlug, $formSlug){

        try {

            $form = $this->form->getByComb($eventSlug,$formSlug);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'ERROR' => 'form not found'
            ]);
        }


        $fields = $request->all();


        if($request->has('campaign')){

            $campaign_slug = $request->get('campaign');


            $campaign = CampaignModel::where('slug', $campaign_slug)->where('event_id', $form->event_id)->first();

            // var_dump($campaign->id);
            // exit();

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



        $email_tmp = $request->get('userfield_1');
        $name_tmp = $request->get('userfield_3');


        $to_mail = $email_tmp;


        try {


            \Mail::to($to_mail)->queue(new ConfirmMail($form,$name_tmp,$email_tmp));
            // ->bcc($adminEmails)

            \Mail::to(env('MAIL_NOTIFY_ADDRESS'))->queue(new NotificationMail($form,$lead));

            $mailResponse = 'SENT ' . $to_mail;

        } catch (Exception $e) {

            $mailResponse = $e->xdebug_message;

            // if (count(\Mail::failures()) > 0) {
            //     $response = 1;
            // }
        }





        // \Event::fire('App\Events', $item);

        return response()->json([
            'response' => true,
            'message' => $form->success_title,
            'content' => $form->success_content,
            'status' => 'success',
            'mail' => $mailResponse
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
