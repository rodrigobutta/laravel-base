<?php
namespace App\Modules\Campaign;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CampaignStatusModel extends \App\Models\Profiled
{

    protected $table = 'campaign_status';

    protected $fillable = ['name'];



}
