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

        if ($this->app->runningInConsole()) {
            $this->publishes(
                // [$assets => public_path('vendor/neccoys/ckeditor/ckeditor')],
                // 'neccoys-ckeditor'
                [
                    // ckfinder & ckeditor static
                    $assets => public_path('vendor/neccoys/LaravelCK'),

                    // CKFinder 
		            // __DIR__ . '/config.php' => config_path('ckfinder.php')
                ],
                'neccoys-ckeditor'
            );
        }
        
	    Admin::booting(function () {
		    Form::extend('editor', Editor::class);
		   
	    });
    }
}