<?php
namespace App\Modules\Campaign;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Modules\Mailist\MailistModel;
use App\Modules\Event\EventModel;

class CampaignModel extends \App\Models\Profiled
{

    protected $table = 'campaign';

    protected $fillable = ['name', 'slug'];


    public function mailists()
    {
        return $this->belongsToMany(MailistModel::class, 'campaign_mailist', 'campaign_id', 'mailist_id');
    }

    public function event()
    {
        return $this->belongsTo(EventModel::class, 'event_id');
    }

}
