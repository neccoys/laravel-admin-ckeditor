<?php

namespace neccoys\AdminCK;

use Encore\Admin\Extension;

class AdminCK extends Extension
{
    public $name = 'ckeditor';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';
}