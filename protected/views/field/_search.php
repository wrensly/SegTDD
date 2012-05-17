<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.advanced-search-form').toggle(250);
	return false;
});
$('.search-form').submit(function(){
	$.fn.yiiGridView.update('field-grid', {
		data: $(this).serialize()
	});
	return false;
});
$('.advanced-search-form').submit(function(){
	$.fn.yiiGridView.update('field-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
    'id'=>'inlineForm',
    'type'=>'inline',
    'htmlOptions' => array(
		'class' => 'search-form pull-right',
	),
   // 'htmlOptions'=>array('class'=>'well'),
));
?>

<div class="input-append">
<?php
if($this->search['simple']){
echo $form->textFieldRow($model,'fieldname',array('class'=>'span3'));
$this->widget('bootstrap.widgets.BootButton', array(
	'buttonType'=>'submit', 
	'type'=>'success', 
	'icon'=>'search white', 
	'label'=>'',
	'htmlOptions' => array('title'=>"Search"),
));
}
if($this->search['advanced']){
?>
<?php
	$this->widget('bootstrap.widgets.BootButton', array(
		'buttonType'=>'button',
		'type'=>'success', 
		'icon' => 'chevron-down white',
		'label' => '',
		'htmlOptions' => array('class'=>'search-button', 'title'=>"Advanced Search"),
	));
}
?>
</div>
<?php
$this->endWidget();
?>