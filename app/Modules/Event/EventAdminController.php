<?php
namespace App\Modules\Event;

use Cache;

use App\Models\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\MessageBag;

use RodrigoButta\Admin\Form;
use RodrigoButta\Admin\Grid;
use RodrigoButta\Admin\Facades\Admin;
use RodrigoButta\Admin\Layout\Content;
use RodrigoButta\Admin\Layout\Column;
use RodrigoButta\Admin\Layout\Row;
use RodrigoButta\Admin\Traits\ResourceDispatcherTrait;

use App\Modules\Campaign\CampaignModel;
use App\Modules\Campaign\CampaignRepositoryInterface;
use App\Modules\Form\FormModel;
use App\Modules\Lead\LeadListModel;
use App\Modules\Lead\LeadListTypeModel;

use App\Admin\Extensions\Tools\ReleasePost;
use App\Admin\Extensions\Tools\UserGender;


class EventAdminController extends Controller{

    use ResourceDispatcherTrait;

    public function __construct(CampaignRepositoryInterface $c){
         $this->campaignRepository = $c;
     }


    public function index()
    {

        return Admin::content(function (Content $content){

            $items = EventModel::all();

            $content->header('Eventos');
            $content->description('adasad');

            $content->row(
                view('event::admin.common', compact('item'))->render()
            );

            $content->row(
                view('event::admin.navigator', compact('items'))->render()
            );

        });

    }




    public function manage($itemId){

        // Admin::css(asset('modules/form/css/editor.css'));
        // Admin::js(asset('modules/form/js/jquery.hotkeys.js'));

        $item = EventModel::findOrFail($itemId);

        return Admin::content(function (Content $content) use($item,$itemId){

            $content->header($item->name);
            // $content->description('editando');

            $content->row(
                view('event::admin.common', compact('item'))->render()
            );

            $content->row(
                view('event::admin.manage', compact('item'))->render()
            );

        });

    }







    protected function partialsCreate($parentId=0)
    {

        return view('event::admin.partials.form')->render();
    }

    protected function partialsSave(Request $request)
    {

        $item = new EventModel();

        $item->name = $request->get("name");
        $item->description = $request->get("description");
        $item->slug = @str_slug($item->name);

        $item->save();


        $leadlist = new LeadListModel();

            $leadlistType = LeadListTypeModel::find(1);
            $leadlist->type()->associate($leadlistType);

            $leadlist->event()->associate($item);

        $leadlist->save();


        $campaign = new CampaignModel();
        $campaign->name = 'Pruebas de formulario';
        $this->campaignRepository->create($campaign,$item->id,1);


        return response()->json([
            'route' => route('events.manage', ['itemId' => $item->id]),
            'state' => '200'
        ]);

    }




    protected function partialsEditableSave(Request $request)
    {

        $item = EventModel::find($request->get("pk"));

        $item{$request->get("name")} = $request->get("value");

        $item->save();

        return response()->json([
            'message' => 'Cambios guardados!',
            'status' => 'success',
            'element' => $item
        ]);

    }




}
