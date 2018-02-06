<?php
namespace App\Modules\Campaign;

// use App\Modules\Campaign\CampaignRepositoryInterface;

// use App\Helpers\Resize;
// use App\Helpers\ResizeHelper;

// use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
// use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;



class CampaignFrontController extends Controller
{

    // public function __construct(CampaignRepositoryInterface $campaign)
    // {
    //     $this->campaign = $campaign;
    // }



    public function getPixel($sendId){

        $send = SendModel::findOrFail($sendId);
        $send->seen_at = Carbon::now();
        $send->save();

        return response(file_get_contents(public_path('./img/pixel.gif')))
            ->header('content-type', 'image/gif');

    }


}
