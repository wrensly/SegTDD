<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'teacher-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'TID'); ?>
		<?php echo $form->textField($model,'TID',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'TID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Firstname'); ?>
		<?php echo $form->textField($model,'Firstname',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Firstname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Midname'); ?>
		<?php echo $form->textField($model,'Midname',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Midname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Lastname'); ?>
		<?php echo $form->textField($model,'Lastname',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Lastname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Address'); ?>
		<?php echo $form->textField($model,'Address',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Bdate'); ?>
		<?php echo $form->textField($model,'Bdate'); ?>
		<?php echo $form->error($model,'Bdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Status'); ?>
		<?php echo $form->textField($model,'Status',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'Status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Level'); ?>
		<?php echo $form->textField($model,'Level',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'Level'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SubjectArea'); ?>
		<?php echo $form->textField($model,'SubjectArea',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'SubjectArea'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'inactiveDate'); ?>
		<?php echo $form->textField($model,'inactiveDate'); ?>
		<?php echo $form->error($model,'inactiveDate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->