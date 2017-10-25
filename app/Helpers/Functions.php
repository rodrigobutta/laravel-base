<?php


use Jenssegers\Agent\Agent as Agent;

// traducir texto
function t($string){
    return trans('text.' . $string, [], null, session('my.locale'));
}



function iView($view = null, $data = [], $mergeData = []){

    $Agent = new Agent();
    if ($Agent->isMobile()) {

        view()->share('is_mobile', true);
        view()->share('mobile_class', 'mobile');

        $mobile_view = 'mobile.' . $view;
        if(\View::exists($mobile_view)){
            $view = $mobile_view;
        }

    } else {
        view()->share('is_mobile', false);
        view()->share('mobile_class', '');
    }

    return view($view, $data, $mergeData);
}

function siteSettings($request){
    return Cache::rememberForever($request, function () use ($request) {
        $request = DB::table('sitesettings')->whereOption($request)->first();
        return $request->value;
    });
}


// buscar un objeto en un array de objetos especificando el array, la propiedad por la que se quiere buscar y el valor a buscar
// devuelve unnnnn.....
function findObjectInArray($arr,$property,$value){
    $res_obj = NULL;
    $res_key = -1;

    foreach($arr as $key => $obj) {
        if ($value == $obj->{$property}) {
            $res_obj = $obj;
            $res_key = $key;
            break;
        }
    }

    if(!is_null($res_obj)){
        // return [$res_key, $res_obj];
        return $res_obj;
    }
    else{
        return false;
    }

}




function getFixedFieldsCollection(){

    // return Cache::rememberForever('userfield-fixed-map', function () {

        // $res = DB::table('user_field')->whereFixed('1')->pluck('id', 'fixed_field_name');
        $res = collect(DB::table('user_field')->whereFixed('1')->get())->keyBy('id');
      

        return $res;
    // });


}




// REB: http://laravel-tricks.com/tricks/using-bootstrap-error-classes-for-flash-message

  // |  #Usage in the controller
  // |  ...->('message', Helper::notification('You have been logged in','success'));
  // |
  // |  #Usage in the view
  // |    @if(Session::has('message'))
  // |    {{Session::get('message')}}
  // |  @endif

class Helper{
    public static function notification($message,$type)
    {
         return '<div class="alert alert-'.$type.'">'.$message.'</div>';
    }
}
