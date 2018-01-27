<?php
namespace App\Modules\Campaign;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CampaignTypeModel extends \App\Models\Profiled
{

    protected $table = 'campaign_type';

    protected $fillable = ['name'];



}
