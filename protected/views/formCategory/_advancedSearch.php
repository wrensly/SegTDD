<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'  => 'horizontal',
	'htmlOptions' => array(
		'class' => 'advanced-search-form',
		'style' => 'display:none',
	),
)); ?>

<div class="row">
	<div class="span6">
		<?php echo $form->textFieldRow($model,'tags',array('maxlength'=>50)); ?>
		<?php echo $form->textFieldRow($model,'code',array('maxlength'=>50)); ?>
		<?php echo $form->textFieldRow($model,'name',array('maxlength'=>50)); ?>
	</div>
	<div class="span6">
		<?php echo $form->textFieldRow($model,'description',array('maxlength'=>50)); ?>
		<?php echo $form->dropDownListRow($model,'status', array('1' => 'Active', '0' => 'Inactive'), array('prompt' => '-Select Status-')); ?>
		<?php echo $form->dropDownListRow($model,'entity_id', CHtml::listData(Entity::model()->findAll(), 'id', 'entity_name'), array('prompt' => '-Select Entity-')); ?>
	</div>
</div>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.BootButton', 
							array(
								'buttonType'=>'submit',
								 'type'		=>'primary',
								 'icon'		=>'ok white',
								 'label'	=>'Search'
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