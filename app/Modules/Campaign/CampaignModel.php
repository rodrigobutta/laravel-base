<?php
namespace App\Modules\Campaign;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Modules\Mailist\MailistModel;

class CampaignModel extends \App\Models\Profiled
{

    protected $table = 'campaign';

    public function mailists()
    {
        return $this->belongsToMany(MailistModel::class, 'campaign_mailist', 'campaign_id', 'mailist_id');
    }

}
