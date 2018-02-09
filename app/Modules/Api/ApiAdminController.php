<?php
namespace App\Modules\Api;

use Cache;

use App\Models\Profile;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

use Symfony\Component\HttpFoundation\Response;

use App\Modules\Form\FormTypeModel;
use App\Modules\Event\EventModel;
use App\Modules\User\UserListModel;
use App\Modules\User\UserListTypeModel;

use RodrigoButta\Admin\Auth\Database\Administrator;
use RodrigoButta\Admin\Auth\Database\Role;

use RodrigoButta\Admin\Admin;

class ApiAdminController extends Controller{

    public function __construct(){

    }



    // public function usersByRole(Request $request)
    // {
    //     $q = $request->get('q');
    //     $roleId = $request->get('role_id');

    //     return Administrator::with('roles')
    //             ->where('name', 'like', "%$q%")
    //             ->whereHas('roles', function($query) use($roleId){
    //                     $query->where('role_id', '=', $roleId);
    //             })
    //             ->paginate(null, ['id', 'name as text']);
    // }

    public function events(Request $request)
    {
        $q = $request->get('q');

        return EventModel::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

    public function userLists(Request $request)
    {
        $q = $request->get('q');

        return UserListModel::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

    public function userListTypes(Request $request)
    {
        $q = $request->get('q');

        return UserListTypeModel::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

    public function formTypes(Request $request)
    {
        $q = $request->get('q');

        return FormTypeModel::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }




    protected function uploadFile(Request $request){

        // var_dump($request->all());
        // exit();

        if ($request->hasFile('upload_file')) {

            $file = $request->file('upload_file');

            // $fileName   = uniqid('file_') . '.' . $file->getClientOriginalExtension();
            $name   = $file->getClientOriginalName();

            if($url =  $file->store('mails', 'public')){

                return response()->json([
                    'url' => \URL::to('/') . $url,
                    'name' => $name,
                    'message' => 'Ok!!!!!',
                    'status' => '200'
                ]);

            }


        }



    }




    // protected function uploadFile(Request $request){

    //     $res = [];

    //     $folder = $request->get('folder');

    //     // var_dump($folder);
    //     // var_dump($request->all());
    //     // exit();

    //     if ($request->hasFile('upload_file')) {

    //         foreach ($request->file('upload_file') as $file) {

    //             // $fileName   = uniqid('file_') . '.' . $file->getClientOriginalExtension();
    //             $name   = $file->getClientOriginalName();

    //             if($url =  $file->store($folder, 'public')){

    //                 $upload = new UploadModel();
    //                 $upload->url = $url;
    //                 $upload->name = $name;
    //                 $upload->campaign_id = $request->get('campaign_id');
    //                 $upload->save();

    //                 array_push($res, [
    //                     'url' => $url,
    //                     'name' => $name,
    //                     'id' => $upload->id
    //                 ]);

    //             }

    //         }

    //     }

    //     return response()->json([
    //         'files' => $res ,
    //         'message' => 'Ok!!!!!',
    //         'status' => '200'
    //     ]);


    // }


}
