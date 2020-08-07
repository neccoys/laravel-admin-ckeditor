<?php

namespace neccoys\AdminCK;

use Encore\Admin\Admin;
use Encore\Admin\Form;
use Illuminate\Support\ServiceProvider;

class AdminCKServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(AdminCK $extension)
    {
        if (! AdminCK::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'neccoys-adminck');
        }

        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    // ckfinder & ckeditor static
                    $extension->assets() => public_path('vendor/neccoys/AdminCK'),

                    // CKFinder 
		            // __DIR__ . '/config.php' => config_path('ckfinder.php')
                ],
                'neccoys-adminck'
            );
        }
        
	    Admin::booting(function () {
		    Form::extend('editor', Editor::class);
		   
	    });
    }
}