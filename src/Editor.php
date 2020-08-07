<?php

namespace neccoys\CKEditor;

use Encore\Admin\Form\Field\Textarea;

class Editor extends Textarea
{
    protected $view = 'neccoys-ckeditor::editor';

    protected static $js = [
	    'vendor/neccoys/ckeditor/ckeditor/ckeditor.js',
	    'js/ckfinder/ckfinder.js',
    ];

    public function render()
    {
        $config = (array) CKEditor::config('config');

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
