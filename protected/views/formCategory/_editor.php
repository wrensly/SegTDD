<?php
$this->breadcrumbs=array(
	'Forms',
);

$this->menu=array(
	array('label'=>'Create Form', 'url'=>array('create')),
	array('label'=>'Manage Form', 'url'=>array('index')),
);


$this->content_title = "Form Editor";

$form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'field-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>true,
));
echo $form->textArea($model->form,'layout',array(
        'rows'=>6,
        'cols'=>200,
        'class'=>'view-code-textarea well',
        ));   
?>
	<div class="form-actions">
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Save')); ?>
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Reset')); ?>
	</div>


<?php $this->endWidget(); ?>
<!-- form -->