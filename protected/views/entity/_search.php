<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type' => 'horizontal',
	'htmlOptions' => array(
		'class' => 'advanced-search-form',
		'style' => 'display:none',
	),
)); ?>

<div class="row">
	<div class="span6">
		<?php echo $form->textFieldRow($model,'entity_name', array('placeHolder' => 'name of the entity')); ?>
		<?php echo $form->textAreaRow($model,'description',array('rows'=>5, 'placeHolder' => 'entity description')); ?>
	</div>
</div>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.BootButton', 
						array(
							'buttonType'=>'submit',
							'type'		=>'primary',
							'icon'		=>'ok white',
							'label'		=>'Search'
							));
	?>
	<?php $this->widget('bootstrap.widgets.BootButton', 
						array(
							'buttonType'=>'reset',
						 	'icon'		=>'remove',
						  	'label'		=>'Clear Fields'
						  	)); 
	?>
</div>

<?php $this->endWidget(); ?>
<!-- search-form -->