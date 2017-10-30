<?php

namespace App\Admin\Extensions\Form;

use RodrigoButta\Admin\Form\Field;

class CKEditor extends Field
{
    public static $js = [
        '/vendor/ckeditor/ckeditor.js',
        '/vendor/ckeditor/adapters/jquery.js',
    ];

    protected $view = 'admin.ckeditor';

    public function render()
    {
        $this->script = "$('textarea.{$this->getElementClass()[0]}').ckeditor();";


        return parent::render();
    }
}