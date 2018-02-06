<?php
namespace App\Modules\Campaign;

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


use App\Modules\User\UserListModel;
use App\Modules\Event\EventModel;
use App\Modules\Form\FormModel;
use App\Modules\Campaign\CampaignRepositoryInterface;


class CampaignAdminController extends Controller{

    use ResourceDispatcherTrait;

    public function __construct(CampaignRepositoryInterface $c){
         $this->campaignRepository = $c;
     }


    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Campañas');
            $content->description('listado');

            $content->body($this->list());
        });
    }




    protected function create($eventId=0,$typeId=1)
    {

        $item = new CampaignModel;
        $item->id = 0;

        $type = CampaignTypeModel::find($typeId);
        $item->type()->associate($type);

        $event = EventModel::find($eventId);

        $item->event()->associate($event);

        $forms = FormModel::where('event_id','=',$item->event->id)->get();

        return view('campaign::admin.form', compact('item', 'forms'))->render();
    }


    protected function edit($itemId)
    {
        $item = CampaignModel::firstOrCreate(['id' => $itemId]);

        $forms = FormModel::where('event_id','=',$item->event->id)->get();

        return view('campaign::admin.form', compact('item','forms'))->render();
    }


    protected function save(Request $request)
    {
        $id = $request->get("campaign_id");

        if($id==0){

            $item = new CampaignModel();
            $item->name = $request->get("name");;
            $item->form_id = $request->get("form_id");

            $item->destination_leadlist_id = $request->get("destination_leadlist_id");

            $item->userlists()->sync($request->get("userlists"));

            $this->campaignRepository->create($item,$request->get("event_id"),$request->get("type_id"));

        }
        else{

            $item = CampaignModel::findOrFail($id);
            $item->form_id = $request->get("form_id");

            $item->destination_leadlist_id = $request->get("destination_leadlist_id");

            $item->userlists()->sync($request->get("userlists"));

            $item->name = $request->get("name");
            $item->slug = @str_slug($request->get("slug"));

            $item->save();

        }

        return response()->json([
            'route' => route('events.manage', ['itemId' => $item->event_id]),
            'state' => '200'
        ]);

    }



    protected function partialsDelete($itemId)
    {
        $item = CampaignModel::findOrFail($itemId);

        if($this->campaignRepository->delete($itemId)){
        // if($item->delete()){
            $response = 'Eliminado';
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







    protected function config($itemId)
    {
        $item = CampaignModel::firstOrCreate(['id' => $itemId]);

        if($item->type_id==2){
            return view('campaign::admin.form-social-config', compact('item'))->render();
        }
        else if($item->type_id==3){ // mail
            return view('campaign::admin.form-mail-config', compact('item'))->render();
        }

    }


    protected function configSave(Request $request)
    {
        $id = $request->get("campaign_id");

        $item = CampaignModel::findOrFail($id);

        $item->social_title = $request->get("social_title");
        $item->social_description = $request->get("social_description");

        $item->save();

        return response()->json([
            'route' => route('events.manage', ['itemId' => $item->event_id]),
            'state' => '200'
        ]);

    }


    protected function process($itemId){

        $item = CampaignModel::findOrFail($itemId);


        if($item->type_id==2){
            return view('campaign::admin.form-social-process', compact('item'))->render();
        }
        else if($item->type_id==3){ // mail
            return view('campaign::admin.form-mail-process', compact('item'))->render();
        }

    }





    public function processTestMail(Request $request, $itemId){

        $item = CampaignModel::findOrFail($itemId);

        $subject = 'TEST - ' . $item->social_title . ' - TEST';

        $data = [
            'title' => $subject,
            'url' => $item->link(),
            'content' => $item->social_description,
            'topimage' => env('APP_URL') . '/storage/admin/' . $item->form->cover_image, //****** convertir esto a imagenes del mail
            'bottomimage' => env('APP_URL') . '/storage/admin/' . $item->form->footer_image
        ];

        $recipents = [];
        $recipents[$request->get('email')] = [];

        \Mailgun::send('campaign::emails.template1', $data, function ($message) use($recipents,$subject) {
            $message
            ->subject($subject)
            ->to($recipents);
        });

        return response()->json([
            'sentcnt' => 1,
            'state' => '200'
        ]);

    }


    public function processMails(Request $request, $itemId){

        $item = CampaignModel::findOrFail($itemId);

        $subject = $item->social_title;

        $data = [
            'title' => $subject,
            'url' => $item->link(),
            'content' => $item->social_description,
            // 'topimage' => env('APP_URL') . '/storage/admin/' . $item->form->cover_image,
            // 'bottomimage' => env('APP_URL') . '/storage/admin/' . $item->form->footer_image
            'topimage' => '',
            'bottomimage' => ''
        ];


        $recipents = [];

        // vamos con la lista de leads
        if($item->destinationLeadlist){

            foreach ($item->destinationLeadlist->leads as $lead) {

                // si no encuentro el email en el lead (userfield_1), no puedo agregarlo al envio
                if($email=$lead->getEmail()){

                    $send = new SendModel();
                    $send->campaign_id = $item->id;
                    $send->lead_id = $lead->id;
                    $send->email = $email;
                    $send->created_at = Carbon::now();
                    $send->save();

                    $recipents[$email] = $lead->getFieldsArray();
                    $recipents[$email]['pixel'] = route('campaign.pixel',["sendId" => $send->id]) ;
                    $recipents[$email]['cta'] =  $item->link($send->id);

                }

            }

        }
        else{
            // vamos con la lista de usuarios

            foreach ($item->userlists as $u) {

                foreach ($u->users as $user) {

                    // si no encuentro el email en el lead (userfield_1), no puedo agregarlo al envio
                    if($email=$user->getEmail()){

                        $send = new SendModel();
                        $send->campaign_id = $item->id;
                        $send->user_id = $user->id;
                        $send->email = $email;
                        $send->created_at = Carbon::now();
                        $send->save();

                        $recipents[$email] = $user->getFieldsArray();
                        $recipents[$email]['pixel'] = route('campaign.pixel',["sendId" => $send->id]) ;
                        $recipents[$email]['cta'] =  $item->link($send->id);

                    }

                }

            }

        }


        $sentCnt = sizeof($recipents);

        // var_dump($recipents);
        // exit();

        \Mailgun::send('campaign::emails.template1', $data, function ($message) use($recipents,$subject) {
            $message
            ->subject($subject)
            ->to($recipents);
        });

        return response()->json([
            'sentcnt' => $sentCnt,
            'state' => '200'
        ]);

    }




    public function details($itemId){

        $item = CampaignModel::findOrFail($itemId);

        return Admin::content(function (Content $content) use($item){

            $content->header($item->name);

            $content->row(
                view('campaign::admin.details', compact('item'))->render()
            );

        });

    }

}
