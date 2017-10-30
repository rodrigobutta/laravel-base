<?php

use RodrigoButta\Admin\Form;
use App\Admin\Extensions\Form\CKEditor;

RodrigoButta\Admin\Form::forget(['map', 'editor']);

Form::extend('ckeditor', CKEditor::class);