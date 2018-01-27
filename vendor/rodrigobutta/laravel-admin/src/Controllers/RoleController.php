<?php

namespace RodrigoButta\Admin\Controllers;

use RodrigoButta\Admin\Auth\Database\Permission;
use RodrigoButta\Admin\Auth\Database\Role;
use RodrigoButta\Admin\Facades\Admin;
use RodrigoButta\Admin\Form;
use RodrigoButta\Admin\Grid;
use RodrigoButta\Admin\Layout\Content;
use Illuminate\Routing\Controller;

use RodrigoButta\Admin\Traits\ResourceDispatcherTrait;

class RoleController extends Controller
{
    use ResourceDispatcherTrait;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header(trans('admin.roles'));
            $content->description(trans('admin.list'));
            $content->body($this->grid()->render());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     *
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header(trans('admin.roles'));
            $content->description(trans('admin.edit'));
            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {
            $content->header(trans('admin.roles'));
            $content->description(trans('admin.create'));
            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Role::class, function (Grid $grid) {
            // $grid->id('ID')->sortable();

            $grid->disableExport();
            $grid->disablePagination();

            $grid->filter(function($filter){
                $filter->disableIdFilter();
                // $filter->equal('column')->placeholder('Please input...');
                $filter->like('name', 'Nombre');
            });

             $grid->color('Color')->display(function ($color) {
                    return '<span class="label" style="background-color:' . $color . '">&nbsp;&nbsp;&nbsp;</span>';
            });

            $grid->name(trans('admin.name'));


            $grid->slug(trans('admin.slug'));

            // $grid->color('color');



            $grid->permissions(trans('admin.permission'))->pluck('name')->label();

            // $grid->created_at(trans('admin.created_at'));
            // $grid->updated_at(trans('admin.updated_at'));

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                if ($actions->row->slug == 'administrator') {
                    $actions->disableDelete();
                }
            });

            $grid->tools(function (Grid\Tools $tools) {
                $tools->batch(function (Grid\Tools\BatchActions $actions) {
                    $actions->disableDelete();
                });
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        return Admin::form(Role::class, function (Form $form) {
            // $form->display('id', 'ID');


            $form->disableReset();
            $form->tools(function (Form\Tools $tools) {
                // $tools->disableBackButton();
                $tools->disableListButton();
                // $tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
            });

            $form->text('name', trans('admin.name'))->rules('required');
            $form->text('slug', trans('admin.slug'))->rules('required');

            $form->listbox('permissions', trans('admin.permissions'))->options(Permission::all()->pluck('name', 'id'));
            $form->color('color', trans('admin.color'))->rules('required');

            // $form->display('created_at', trans('admin.created_at'));
            // $form->display('updated_at', trans('admin.updated_at'));
        });
    }
}
