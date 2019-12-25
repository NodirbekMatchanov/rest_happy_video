<?php
namespace backend\components;


use yii\base\Widget;
use yii\helpers\Html;

class BulkButtonWidget extends Widget{

	public $buttons;
	
	public function init(){
		parent::init();
		
	}
	
	public function run(){
		$content = '<div class="pull-right">'.
                   ''.
                   $this->buttons.
                   '</div>';
		return $content;
	}
}
?>
