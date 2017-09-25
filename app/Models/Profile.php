<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Profile extends Model
{

    protected $table = 'profiles';

    protected $dates = ['deleted_at', 'featured_at'];

    protected $softDelete = true;

}
