<?php

namespace RodrigoButta\Admin\Controllers;

use RodrigoButta\Admin\Auth\Database\Permission;
use RodrigoButta\Admin\Facades\Admin;
use RodrigoButta\Admin\Form;
use RodrigoButta\Admin\Grid;
use RodrigoButta\Admin\Layout\Content;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

use RodrigoButta\Admin\Traits\ResourceDispatcherTrait;

class PermissionController extends Controller
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
            $content->header(trans('admin.permissions'));
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
            $content->header(trans('admin.permissions'));
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
            $content->header(trans('admin.permissions'));
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
        return Admin::grid(Permission::class, function (Grid $grid) {
            // $grid->id('ID')->sortable();
            $grid->slug(trans('admin.slug'));
            $grid->name(trans('admin.name'));

            // $grid->disableFilter();
            $grid->disableExport();
            $grid->disablePagination();

            $grid->filter(function($filter){
                $filter->disableIdFilter();
                // $filter->equal('column')->placeholder('Please input...');
                $filter->like('name', 'Nombre');
            });



            $grid->http_path(trans('admin.route'))->display(function ($path) {
                return collect(explode("\r\n", $path))->map(function ($path) {
                    $method = $this->http_method ?: ['ANY'];

                    if (Str::contains($path, ':')) {
                        list($method, $path) = explode(':', $path);
                        $method = explode(',', $method);
                    }

                    $method = collect($method)->map(function ($name) {
                        return strtoupper($name);
                    })->map(function ($name) {
                        return "<span class='label label-primary'>{$name}</span>";
                    })->implode('&nbsp;');

                    $path = '/'.trim(config('admin.route.prefix'), '/').$path;

                    return "<div style='margin-bottom: 5px;'>$method<code>$path</code></div>";
                })->implode('');
            });

            $grid->created_at(trans('admin.created_at'));
            $grid->updated_at(trans('admin.updated_at'));

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
        return Admin::form(Permission::class, function (Form $form) {
            // $form->display('id', 'ID');

            $form->disableReset();
            $form->tools(function (Form\Tools $tools) {
                // $tools->disableBackButton();
                $tools->disableListButton();
                // $tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
            });

            $form->text('slug', trans('admin.slug'))->rules('required');
            $form->text('name', trans('admin.name'))->rules('required');

            $form->multipleSelect('http_method', trans('admin.http.method'))
                ->options($this->getHttpMethodsOptions())
                ->help('ayudita de rodri');
            $form->textarea('http_path', trans('admin.http.path'));

            // $form->display('created_at', trans('admin.created_at'));
            // $form->display('updated_at', trans('admin.updated_at'));
        });
    }

    /**
     * Get options of HTTP methods select field.
     *
     * @return array
     */
    protected function getHttpMethodsOptions()
    {
        return array_combine(Permission::$httpMethods, Permission::$httpMethods);
    }
}
