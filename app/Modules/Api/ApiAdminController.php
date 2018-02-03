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

use App\Modules\Event\EventModel;
use App\Modules\UserList\UserListModel;
use App\Modules\UserList\UserListTypeModel;

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





}
