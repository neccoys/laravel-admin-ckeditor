<?php

namespace neccoys\CKEditor;

use Encore\Admin\Admin;
use Encore\Admin\Form;
use Illuminate\Support\ServiceProvider;

class CKEditorServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(CKEditor $extension)
    {
        if (! CKEditor::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'neccoys-ckeditor');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/neccoys/ckeditor')],
                'neccoys-ckeditor'
            );
        }
        
	    Admin::booting(function () {
		    Form::extend('editor', Editor::class);
		    $config = (array) CKEditor::config('config');
		    if (empty($config['language'])) $config['language']=strtolower((string) config('app.locale'));
		    Admin::js('vendor/neccoys/ckeditor/translations/'.$config['language'].'.js');
	    });
    }
}