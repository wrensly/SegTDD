<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.advanced-search-form').toggle(250);
	return false;
});
$('.search-form').submit(function(){
	$.fn.yiiGridView.update('form-grid', {
		data: $(this).serialize()
	});
	return false;
});
$('.advanced-search-form').submit(function(){
	$.fn.yiiGridView.update('form-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'action'	 =>Yii::app()->createUrl($this->route),
	'method'	 =>'post',
    'id'	     =>'inlineForm',
    'type'	     =>'inline',
    'htmlOptions'=> array(
		'class'  => 'search-form pull-right',
	),
   // 'htmlOptions'=>array('class'=>'well'),
));
?>

<div class="input-append">
<?php
	if($this->search['simple']){
		echo $form->textFieldRow($model,'category_name',array('class'=>'span2','maxlength'=>45));
		$this->widget('bootstrap.widgets.BootButton',
				array(
				'buttonType'=>'submit', 
				'type'		=>'success', 
				'icon'		=>'search white', 
				'label'		=>'',
				));
}
	if($this->search['advanced']){
		$this->widget('bootstrap.widgets.BootButton', 
				array(
				'buttonType' =>'button',
				'type'		 =>'success', 
				'icon' 	 	 => 'chevron-down white',
				'label'		 => '',
				'htmlOptions'=> array('class'=>'search-button'),
				));
}
?>
</div>

<?php $this->endWidget(); ?>