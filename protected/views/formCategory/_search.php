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

	
 		<?php echo $form->dropDownList($model,'category_name',CHtml::listData(Category::model()->findAll(), 'category_name', 'category_name'), array('prompt' => '-Select Category-')); ?>
		<?php //echo $form->textFieldRow($tags,'tag_name',array('maxlength'=>50)); ?>
	
		<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'icon'=>'search', 'label'=>'Search')); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Clear Fields')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->