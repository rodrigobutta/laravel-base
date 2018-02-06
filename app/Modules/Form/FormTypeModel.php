<?php
namespace App\Modules\Form;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class FormTypeModel extends \App\Models\Profiled
{

    protected $table = 'form_type';

    protected $fillable = ['name'];



}
