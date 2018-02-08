<?php
namespace App\Modules\Lead;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class LeadTypeModel extends \App\Models\Profiled
{

    protected $table = 'lead_type';

    protected $fillable = ['name'];

}
