<?php

namespace RodrigoButta\Admin\Facades;

use Illuminate\Support\Facades\Facade;

class Admin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \RodrigoButta\Admin\Admin::class;
    }
}
