<div class="row">
	<div class="span6">
<?php
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
    'id'=>'inlineForm',
    'type'=>'search',
    'htmlOptions' => array(
		'class' => 'search-form',
	),
   // 'htmlOptions'=>array('class'=>'well'),
));
echo $form->textFieldRow($model,'fieldname',array('class'=>'pull-left'));
$this->widget('bootstrap.widgets.BootButtonGroup', array(
		'buttons' => array(
			array(
				'buttonType'=>'submit', 
				'type'=>'success', 
				'icon'=>'search white', 
				'label'=>''),
			array(
				'buttonType'=>'button',
				'type'=>'success', 
				'icon' => 'cog white',
				'label' => '',
				'htmlOptions' => array('class'=>'search-button'),
				),
		),
		'htmlOptions' => array('class'=>'pull-left'),
	));
$this->endWidget();
?>
</div>
</div>
<?php $this->renderPartial('_search',array(
	'model'=>$model
)); ?><!-- search-form -->