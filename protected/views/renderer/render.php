<?php
$this->breadcrumbs=array(
	'Renderer'=>array('index'),
	$model->code,
);

$this->content_title = $model->code;

$xml = simplexml_load_string($model->layout);

$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>$xml['type'],
    'enableAjaxValidation'=>true,
));

$tabs_f = $this->renderXML($xml, $form, $id);

$this->widget('bootstrap.widgets.BootTabbable', array(
    'type'=>'tabs',
    'placement'=>'left', // 'above', 'right', 'below' or 'left'
    'tabs'=>$tabs_f,
));

?>
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Submit')); ?>
    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Reset')); ?>
</div>
<?php $this->endWidget(); ?>
