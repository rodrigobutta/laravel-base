<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use RodrigoButta\Admin\Controllers\Dashboard;
use RodrigoButta\Admin\Facades\Admin;
use RodrigoButta\Admin\Layout\Column;
use RodrigoButta\Admin\Layout\Content;
use RodrigoButta\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index()
    {

        return redirect(route('events.root'));

        // return Admin::content(function (Content $content) {

        //     $content->header('Bienvenido');
        //     // $content->description('Description...');

        //     // $content->row(Dashboard::title());

        //     // $content->row(function (Row $row) {

        //     //     $row->column(4, function (Column $column) {
        //     //         $column->append(Dashboard::environment());
        //     //     });

        //     //     $row->column(4, function (Column $column) {
        //     //         $column->append(Dashboard::extensions());
        //     //     });

        //     //     $row->column(4, function (Column $column) {
        //     //         $column->append(Dashboard::dependencies());
        //     //     });
        //     // });
        // });
    }
}
