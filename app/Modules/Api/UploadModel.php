<?php
namespace App\Modules\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UploadModel extends \App\Models\Profiled
{

    protected $table = 'upload';

    protected $fillable = ['name','url','path'];



}
