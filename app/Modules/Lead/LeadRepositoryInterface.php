<?php
namespace App\Modules\Lead;

use App\Modules\Lead\LeadModel;
use Auth;
use Cache;
use DB;
use File;
use Str;

interface LeadRepositoryInterface{

    public function put($fields,$formId,$campaignId = null);

    public function removeFromList($itemId,$listID);

    public function cloneList($itemId);

}
