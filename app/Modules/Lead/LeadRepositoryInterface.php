<?php
namespace App\Modules\Lead;

use App\Modules\Lead\LeadModel;
use Auth;
use Cache;
use DB;
use File;
use Str;

interface LeadRepositoryInterface{

    public function put($fields,$form_id);

}
