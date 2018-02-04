<?php
namespace App\Modules\Lead;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class LeadListTypeModel extends \App\Models\Profiled
{

    protected $table = 'leadlist_type';

    protected $fillable = ['name'];



}
