<?php

namespace neccoys\CKEditor;

use Encore\Admin\Form\Field\Textarea;

class Editor extends Textarea
{
    protected $view = 'neccoys-ckeditor::editor';

    protected static $js = [
	    'vendor/neccoys/ckeditor/ckeditor.js',
//	    'vendor/neccoys/ckeditor/translations/zh-cn.js',
    ];

    public function render()
    {
        $config = (array) CKEditor::config('config');

        $config = array_merge($config, $this->options);
	    $config['simpleUpload']['headers'] = ['X-CSRF-TOKEN' => csrf_token()];
	
	    $config = json_encode($config);
	    
        $this->script = <<<EOT
		CKEDITOR.replace( document.querySelector( '#{$this->id}' ),{$config} )
EOT;
        return parent::render();
    }
}
