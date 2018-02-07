<?php
namespace App\Modules\Campaign;

use App\Modules\Campaign\CampaignModel;
use Auth;
use Cache;
use DB;
use File;
use Str;

interface CampaignRepositoryInterface{

    public function getById($id);

    public function getBySlug($slug);

    public function delete($id);

    public function create($item,$eventId,$typeId);

    public function sendMails($itemId);

    public function clone($itemId);

}
