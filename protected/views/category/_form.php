<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'verticalForm',
    'type' => 'horizontal',
)); ?>

	<div class="alert alert-error">
		<p class="note">Fields with <span class="required">*</span> are required.</p>
	</div>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category_name'); ?>
		<?php echo $form->textField($model,'category_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'category_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description', array('maxlength' => 240, 'rows' => 6)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<?php $this->widget('bootstrap.widgets.BootButton', array('label' => 'Save', 'icon' => 'ok white', 'buttonType' => 'submit', 'type' => 'primary')); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array('label' => 'Cancel', 'icon' => 'remove', 'htmlOptions'=>array('data-dismiss'=>'modal'))); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Reset')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->