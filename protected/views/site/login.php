<style type="text/css">
	.myWell {
		border: 0px solid;
		box-shadow: 2px 0px 7px #888888, -2px 0px 7px #888888, 0px -2px 7px #888888, 0px 2px 7px #888888;
		background-image: -webkit-linear-gradient(top, #333, #222);
        background-image: -webkit-gradient(linear, 0 0, 0% 100%, from(#444), to(#222));
        background-image: -moz-linear-gradient(top, #333, #222);
        background-image: -moz-gradient(linear, 0 0, 0% 100%, from(#444), to(#222));
		border-radius:13px;
							/*right side*/		 /*left side*/			/*top side*/		/*bottom side*/
		-webkit-box-shadow: 2px 0px 7px #888888, -2px 0px 7px #888888, 0px -2px 7px #888888, 0px 2px 7px #888888; /* Firefox 3.6 and earlier */;
		-webkit-border-radius:13px;
		-moz-box-shadow: 2px 0px 7px #888888, -2px 0px 7px #888888, 0px -2px 7px #888888, 0px 2px 7px #888888; /* Firefox 3.6 and earlier */;
		-moz-border-radius:13px;
		width: 500px;
		margin: auto;
		overflow: visible;
	}

	.myLoginTitle {
		margin-bottom: 20px;
		text-align: center;
	}

	.myRememberMelb {
		color: white;
	}

	.myUPTextField {
		height:40px;
		width:500px;
		font-weight: bold;
		font-size: 1.2em;
		text-align: center;
	}

	.myLoginPosbt {
		margin-top: 10px;
		position: relative;
		left:263px;
	}
	.myRememberMePos {

	}
	.loginMargin {
		padding-top: 10px;
		padding-bottom: 10px;
	}
	.upMargin {
		padding-top:0px;
	}
	.loginNotification {
		text-align: center;
	}
	
</style>
<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
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

<!-- echo "
		<p class='loginMargin loginNotification alert alert-info'>
				Please fill out the following form with your login credentials:
		</p>
		"; -->
	<?php
		Yii::app()->user->setFlash('info', '<center>Please fill out the following form with your login credentials:</center>');
		$this->widget('bootstrap.widgets.BootAlert');
	?>

	<div class="form">
	<!--$form-->

		<div class="row loginMargin">
			<?php echo $form->textField($model,'username', array('class'=>'myUPTextField', 'placeHolder'=>'Username')); ?>
			<?php echo $form->error($model,'username');?>
		</div>

		<div class="row loginMargin upMargin">
			<?php echo $form->passwordField($model,'password', array('class'=>'myUPTextField', 'placeHolder'=>'Password')); ?>
			<?php echo $form->error($model,'password'); ?>
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
