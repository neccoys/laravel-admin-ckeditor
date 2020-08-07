<?php

namespace neccoys\CKEditor;

use Encore\Admin\Extension;

class CKEditor extends Extension
{
    public $name = 'ckeditor';

    public $views = __DIR__.'/../resources/views';

    public $assets_ckeditor = __DIR__.'/../resources/assets/ckeditor/ckeditor';

    public $assets_ckfinder = __DIR__.'/../resources/assets/ckeditor/ckfinder';
}