<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'type'=>'horizontal',
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->textFieldRow($model,'entity_name', array('style'=>'width: 50%;', 'placeHolder' => 'name of the entity')); ?>
	</div>

	<div class="row">
		<?php echo $form->textAreaRow($model,'description',array('rows'=>5, 'style'=>'width: 50%;', 'placeHolder' => 'entity description')); ?>
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'icon'=>'search', 'label'=>'Search')); ?>
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->