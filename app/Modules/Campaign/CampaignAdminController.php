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
            $item->slug = @str_slug($request->get("name"));

            $item->form_id = $request->get("form_id");

            $item->destination_leadlist_id = $request->get("destination_leadlist_id");

            $item->save();

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
            'status' => '200'
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


    protected function configSocialSave(Request $request)
    {
        $id = $request->get("campaign_id");

        $item = CampaignModel::findOrFail($id);

        $item->social_title = $request->get("social_title");
        $item->social_description = $request->get("social_description");

        $item->save();

        return response()->json([
            'route' => route('events.manage', ['itemId' => $item->event_id]),
            'status' => '200'
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
            'status' => '200'
        ]);

    }


    public function processMails(Request $request, $itemId){


        if($sentCnt = $this->campaignRepository->sendMails($itemId)){

            return response()->json([
                'sentcnt' => $sentCnt,
                'status' => '200'
            ]);

        }
        else{
            return response()->json([
                'sentcnt' => 0,
                'status' => '555'
            ]);
        }

    }



    public function clone(Request $request, $itemId){


        if($item = $this->campaignRepository->clone($itemId)){

            return redirect()->back()->with('flashSuccess', 'Campaña Clonada');

        }
        else{
            return redirect()->back()->with('flashError', 'No se pudo clonar');
        }

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


    public function view($itemId){

        $item = CampaignModel::findOrFail($itemId);

        return view('campaign::admin.view', compact('item'))->render();

    }





    public function template($itemId){

        $item = CampaignModel::findOrFail($itemId);

        return Admin::content(function (Content $content) use($item){

            $content->header($item->name);

            $content->row(
                view('campaign::admin.form-mail-template', compact('item'))->render()
            );

        });

    }

    protected function templateSave(Request $request)
    {
        $id = $request->get("id");
        $item = CampaignModel::findOrFail($id);

        $mail_html = $request->get("mail_html");
        $mail_code = $request->get("mail_code");
        $mail_subject = $request->get("mail_subject");

        $item->mail_html = $mail_html;
        $item->mail_code = $mail_code;
        $item->mail_subject = $mail_subject;

        $item->save();

        return response()->json([
            'route' => route('events.manage', ['itemId' => $item->event_id]),
            'message' => 'E-mail guardado!',
            'status' => '200'
        ]);

    }




    protected function templateUpload(Request $request){

        if ($request->hasFile('upload_file')) {
            $image      = $request->file('upload_file');
            $fileName   = uniqid('img_') . '.' . $image->getClientOriginalExtension();

            $img = \Image::make($image->getRealPath());
            // $img->resize(120, 120, function ($constraint) {
            //     $constraint->aspectRatio();
            // });
            $img->stream(); // <-- Key point

            $path = 'mails'.'/'.$fileName;

            if(\Storage::disk('local')->put($path, $img, 'public')){

                $url =  \Storage::url($path, 'public');

                return response()->json([
                    'name' => ['url' => $url] ,
                    'message' => 'Archivo subido!',
                    'status' => '200'
                ]);

            }
            else{
                return '';
            }


        }

    }



}
