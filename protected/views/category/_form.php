<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'verticalForm',
    'type' => 'horizontal',
)); ?>

	<div class="alert alert-error">
		<p class="note">Fields with <span class="required">*</span> are required.</p>
	</div>

	<?php echo $form->textFieldRow($model,'category_name',array('size'=>45,'maxlength'=>45)); ?>
	<?php echo $form->textAreaRow($model,'description', array('maxlength' => 240, 'rows' => 6)); ?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array('label' => 'Save', 'icon' => 'ok white', 'buttonType' => 'submit', 'type' => 'primary')); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array('label' => 'Cancel', 'icon' => 'remove', 'htmlOptions'=>array('data-dismiss'=>'modal'))); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Reset')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->