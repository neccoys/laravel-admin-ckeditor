<?php

namespace neccoys\AdminCK;

use Encore\Admin\Form\Field\Textarea;

class Editor extends Textarea
{
    protected $view = 'neccoys-adminck::editor';

    protected static $js = [
	    'vendor/neccoys/AdminCK/ckeditor/ckeditor.js',
	    'vendor/neccoys/AdminCK/ckfinder/ckfinder.js',
    ];

    public function render()
    {
        $config = (array) AdminCK::config('config');

        $config = array_merge($config, $this->options);
	    $config['simpleUpload']['headers'] = ['X-CSRF-TOKEN' => csrf_token()];
	
	    $config = json_encode($config);
	    
        $this->script = <<<EOT
        var editor = CKEDITOR.replace( '{$this->id}', {
            height:250
        } );
        CKFinder.config( { connectorPath: '/ckfinder/connector' } );
        CKFinder.setupCKEditor( editor );
        
EOT;
        return parent::render();
    }
}
