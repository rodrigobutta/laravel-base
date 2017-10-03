<?php
namespace App\Modules\Form;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Modules\Mailist\MailistModel;

class FormModel extends \App\Models\Profiled
{

    protected $table = 'form';

    public function mailists()
    {
        return $this->belongsToMany(MailistModel::class, 'form_mailist', 'form_id', 'mailist_id');
    }

}
