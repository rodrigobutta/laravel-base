<?php
namespace App\Modules\User;

use App\Modules\User\UserModel;
use Auth;
use Cache;
use DB;
use File;
use Str;

interface UserRepositoryInterface{

    public function getById($id);

    public function getBySlug($slug);

    public function getAll();

    public function incrementViews($user);

    public function search($input);

    public function delete($id);

}
