<?php
namespace App\Modules\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Modules\Campaign\CampaignModel;

class EventModel extends \App\Models\Profiled
{

    protected $table = 'event';

    public function campaigns()
    {
        return $this->hasMany(CampaignModel::class, 'event_id');
    }

}
