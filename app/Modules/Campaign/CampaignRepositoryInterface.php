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

    public function getAll();

    public function incrementViews($campaign);

    public function search($input);

    public function delete($id);

}
