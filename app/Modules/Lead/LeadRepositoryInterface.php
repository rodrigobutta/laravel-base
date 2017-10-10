<?php
namespace App\Modules\Lead;

use App\Modules\Lead\LeadModel;
use Auth;
use Cache;
use DB;
use File;
use Str;

interface LeadRepositoryInterface{

    public function getById($id);

    public function getBySlug($slug);

    public function getAll();

    public function incrementViews($lead);

    public function search($input);

    public function delete($id);

    public function put($fields,$form_id);

}
