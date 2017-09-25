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
