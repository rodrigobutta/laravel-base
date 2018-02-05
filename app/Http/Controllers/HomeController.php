<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

use Symfony\Component\HttpFoundation\Response;

use RodrigoButta\Admin\Facades\Admin;

use RodrigoButta\Admin\Auth\Database\Administrator;
use RodrigoButta\Admin\Auth\Database\Role;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller{


    public function __construct(){

    }



    // root publico. Si está logueado, voy al admin de una
    public function index(){

        // if(Auth::guard('admin')->check()){
            return redirect(route('admin.home'));
        // }
        // else{
            // return view('welcome');
        // }

    }





}
