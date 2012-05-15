<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type' => 'vertical',
	'htmlOptions' => array(
		'class' => 'advanced-search-form',
		'style' => 'display:none',
	),
	
)); ?>

	<div class="row">
		<?php echo $form->textFieldRow($model,'tags',array('maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->textFieldRow($model,'code',array('maxlength'=>50)); ?>
	</div>
	<div class="row">
		<?php echo $form->textFieldRow($model,'name',array('maxlength'=>50)); ?>
	</div>
	<div class="row">
		<?php echo $form->textFieldRow($model,'description',array('maxlength'=>50)); ?>

	</div>	
	<div class="row">
		<?php echo $form->dropDownList($model, 'status', array('1' => 'Active', '0' => 'Inactive'), array('prompt' => '-Select Status-')); ?>

	
		<?php echo $form->dropDownList($model,'entity_id', CHtml::listData(Entity::model()->findAll(), 'id', 'entity_name'), array('prompt' => '-Select Entity-')); ?>

		<div class = "row">
		<br><br>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search', 'label'=>'Search')); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Reset')); ?>
		</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->