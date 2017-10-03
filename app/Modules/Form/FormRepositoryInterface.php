<?php
namespace App\Modules\Form;

use App\Modules\Form\FormModel;
use Auth;
use Cache;
use DB;
use File;
use Str;

interface FormRepositoryInterface{

    public function getById($id);

    public function getBySlug($slug);

    public function getAll();

    public function incrementViews($form);

    public function search($input);

    public function delete($id);

}
