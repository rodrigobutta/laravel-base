<?php
namespace App\Modules\Tree;

use App\Modules\Tree\TreeModel;
use Auth;
use Cache;
use DB;
use File;
use Str;

interface TreeRepositoryInterface{

    public function getById($id);

    public function getBySlug($slug);

    public function getAll();

    public function incrementViews($tree);

    public function search($input);

    public function delete($id);

}
