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



    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Campañas');
            $content->description('listado');

            $content->body($this->list());
        });
    }


    // public function edit($id)
    // {

    //     // fix reb por resources que no interpretan bien el method del controller
    //     if($id=="create"){
    //         return $this->create();
    //     }

    //     return Admin::content(function (Content $content) use ($id) {

    //         $content->header('campaña');
    //         $content->description('editando');

    //         $content->body($this->form()->edit($id));
    //     });
    // }

    // public function create(Request $request)
    // {

    //     $eventid = $request->get('eventid') || 0;

    //     return Admin::content(function (Content $content) use($eventid) {

    //         $content->header('Campaña');
    //         $content->description('creando');

    //         $content->body($this->form($eventid));
    //     });
    // }

    // protected function list()
    // {
    //     return Admin::grid(CampaignModel::class, function (Grid $grid) {

    //         $grid->id('ID');

    //         $grid->column('name', 'Nombre');
    //         $grid->column('slug', 'Slug');

    //         $grid->event()->display(function ($event) {

    //             if($event){
    //                 return $event['name'];
    //             }
    //             return '';

    //         });

    //         $grid->note()->editable('textarea');

    //         $published_states = [
    //             'on'  => ['value' => 0, 'text' => 'YES', 'color' => 'primary'],
    //             'off' => ['value' => 1, 'text' => 'NO', 'color' => 'default'],
    //         ];
    //         $grid->enabled()->switch($published_states);

    //         $grid->userlists()->display(function ($userlists) {

    //             $userlists = array_map(function ($userlist) {
    //                 return "<span class='label label-primary'>{$userlist['name']}</span>";
    //             }, $userlists);

    //             return join('&nbsp;', $userlists);
    //         });

    //     });
    // }

    // protected function form($eventid = 0)
    // {
    //     return Admin::form(CampaignModel::class, function (Form $form) use($eventid) {


    //         $form->disableReset();
    //         $form->tools(function (Form\Tools $tools) {
    //             // $tools->disableBackButton();
    //             $tools->disableListButton();
    //             // $tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
    //         });

    //         // $form->display('id', 'ID');

    //         if($eventid!=0){

    //             $event = EventModel::findOrFail($eventid);


    //             $form->hidden('event_id')->value($eventid);

    //             $form->display('Evento')->value($event->name);
    //         }



    //         $form->text('name');
    //         $form->text('slug');



    //         $form->textarea('note');

    //         $enabled_states = [
    //             'on'  => ['value' => 0, 'text' => 'YES', 'color' => 'primary'],
    //             'off' => ['value' => 1, 'text' => 'NO', 'color' => 'default'],
    //         ];
    //         $form->switch("enabled")->states($enabled_states);

    //         $form->multipleSelect('userlists')->options(UserListModel::all()->pluck('name', 'id'));

    //         $form->display('created_at', 'Created At');
    //         $form->display('updated_at', 'Updated At');

    //     });
    // }





    public function testMail(Request $request){

        $data = [
            'campaign' => 'Campaña de prueba 2',
            'url' => 'http://muypunch.com'
        ];

        \Mailgun::send('campaign::emails.test', $data, function ($message) {

            $message->to([
                    'rbutta@gmail.com' => [
                        'name' => 'Rodrigo Butta',
                        'city' => 'New York'
                    ],
                    'info@muypunch.com' => [
                        'name' => 'Empresa Muypunch',
                        'city' => 'London'
                    ]
                ]);

        });


        return json_encode("mail enviado");
    }





    // /**
    //  * Create interface.
    //  *
    //  * @return Content
    //  */
    // public function createForevent($eventid)
    // {
    //     return Admin::content(function (Content $content) use($eventid){

    //         $content->header('Campaña');
    //         $content->description('creando');

    //         $content->body($this->form($eventid));
    //     });
    // }









    protected function create($eventId=0,$typeId=1)
    {

        $item = new CampaignModel;
        $item->id = 0;

        $type = CampaignTypeModel::find($typeId);
        $item->type()->associate($type);

        $event = EventModel::find($eventId);

        $item->event()->associate($event);

        $forms = FormModel::where('event_id','=',$event->id);

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
            $this->campaignRepository->create($item,$request->get("event_id"),$request->get("type_id"));

        }
        else{

            $item = CampaignModel::findOrFail($id);
            $item->form_id = $request->get("form_id");
            $item->name = $request->get("name");
            $item->slug = @str_slug($request->get("slug"));

            $item->save();

        }

        return response()->json([
            'route' => route('events.manage', ['itemId' => $item->event_id]),
            'state' => '200'
        ]);

    }




    protected function config($itemId)
    {
        $item = CampaignModel::firstOrCreate(['id' => $itemId]);

        return view('campaign::admin.form-social-config', compact('item'))->render();
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


    protected function process($itemId)
    {
        $item = CampaignModel::findOrFail($itemId);


        if($item->type_id==2){

            // chequear que si no hay form definido, no se pueda generar link **********************************



            return view('campaign::admin.form-social-process', compact('item'))->render();

        }


    }






}
