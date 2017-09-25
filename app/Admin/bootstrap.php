<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * RodrigoButta\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * RodrigoButta\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

RodrigoButta\Admin\Form::forget(['map', 'editor']);



// use RodrigoButta\Admin\Grid\Column;
// use RodrigoButta\Admin\Grid\Displayers\Orderable;
// Column::extend('orderable', Orderable::class);