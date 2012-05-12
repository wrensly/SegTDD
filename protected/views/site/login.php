<?php
$this->pageTitle=Yii::app()->name . ' - Login';
?>

<h1 class='myLoginTitle'>TRACER Data Dictionary</h1>

<div class="well myWell">

<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>

	<?php
		$errorOne = $form->error($model,'password');
		$errorTwo = $form->error($model, 'username');

		if(strip_tags($errorOne) != '' && strip_tags($errorTwo) == '' )
		{
			yii::app()->user->setFlash('error' , $errorOne).'a';
			$this->widget('bootstrap.widgets.BootAlert');
		}
		if(strip_tags($errorOne) == '' && strip_tags($errorTwo) == '' )
		{	
			Yii::app()->user->setFlash('info', '<center>Please fill out the following form with your login credentials:</center>');
			$this->widget('bootstrap.widgets.BootAlert');
		}
		 
	?>
	<div class="form">
	<!--$form-->

		<div class="row loginMargin">
			<?php echo $form->textField($model,'username', array('class'=>'myUPTextField', 'placeHolder'=>'Username')); ?>

		</div>

		<div class="row loginMargin upMargin">
			<?php echo $form->passwordField($model,'password', array('class'=>'myUPTextField', 'placeHolder'=>'Password')); ?>

			<p class="hint">
				Hint: You may login with <tt>demo/demo</tt> or <tt>admin/admin</tt>.
			</p>
		</div>

		<span>
			<span class="rememberMe myRememberMePos">
				<?php echo $form->checkBox($model,'rememberMe'); ?>
				<?php echo $form->label($model,'rememberMe', array('class'=>'myRememberMelb')); ?>
				<?php echo $form->error($model,'rememberMe'); ?>
			</span>

			<span class="buttons myLoginPosbt">
				<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'icon'=>'off', 'label'=>'Log in')); ?>
			</span>
		</span>
	</div>

	<?php $this->endWidget(); ?>
	</div><!-- form -->
</div>
