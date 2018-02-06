<?php
namespace App\Modules\Campaign;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Modules\Lead\LeadListModel;
use App\Modules\Campaign\CampaignModel;

class SendModel extends Model
{

    protected $table = 'send';

    // public $timestamps = [ "created_at" ];
    public $timestamps = false;

    protected $fillable = ['campaign_id', 'lead_id', 'user_id'];

    // boot
    // static::creating( function ($model) {
    //     $model->setCreatedAt($model->freshTimestamp());
    // });


    public function campaign()
    {
        return $this->belongsTo(CampaignModel::class, 'campaign_id');
    }


}
