<?php

namespace App\Modules\Tree;

use RodrigoButta\Admin\Traits\AdminBuilder;
use RodrigoButta\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class TreeModel extends \App\Models\Profiled
{
    use ModelTree, AdminBuilder;

    protected $table = 'tree';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // $this->setParentColumn('pid');
        $this->setOrderColumn('sort');
        // $this->setTitleColumn('name');
    }


}