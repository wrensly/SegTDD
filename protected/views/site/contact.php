<?php
$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
$this->content_title = 'Contact Us';
?>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
</p>

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'type' => 'horizontal',
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
<div class="row">
	<div class="span6">
		<?php echo $form->textFieldRow($model,'name'); ?>
		<?php echo $form->textFieldRow($model,'email'); ?>
		<?php echo $form->textFieldRow($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->textAreaRow($model,'body',array('rows'=>6, 'cols'=>50)); ?>
	</div>
	<div class="span6">
		<?php if(CCaptcha::checkRequirements()): ?>
		<div class="control-group">
			<?php echo $form->labelEx($model,'verifyCode',array('class'=>'control-label')); ?>
			<div class="controls">
				<div>
				<?php $this->widget('CCaptcha'); ?>
				</div>
				<?php echo $form->textField($model,'verifyCode'); ?>
				<?php echo $form->error($model,'verifyCode'); ?>
				<div class="hint">Please enter the letters as they are shown in the image above.
				<br/>Letters are not case-sensitive.</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>
	<div class="form-actions">
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Submit')); ?>
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Reset')); ?>
	</div>

<?php $this->endWidget(); ?>

<!-- form -->

<?php endif; ?>