<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/doc.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
	<?php $this->widget('bootstrap.widgets.BootNavbar', array(
		'fixed' => 'top',
		'brand' => CHtml::encode(Yii::app()->name),
		'brandUrl' => '#',
		'collapse' => true,
		'items' => array(
			array(
				'class' => 'bootstrap.widgets.BootMenu',
				'items' => array(
					array('label'=>'Home', 'url'=>array('/site/index'), 'icon' => 'home white'),
					array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about'), 'icon' => 'book white'),
					array('label'=>'Contact', 'url'=>array('/site/contact'), 'icon' => 'envelope white'),
				),
			),
			array(
				'class' => 'bootstrap.widgets.BootMenu',
				'htmlOptions' => array('class' => 'pull-right'),
				'items' => array(
					array('label' => 'Users', 'url' => '#', 'visible'=>Yii::app()->user->isGuest, 'items' => array(
						array('label'=>'Login', 'url'=>array('/site/login'), 'icon' => 'user'),
					)),
					array('label' => 'Welcome, '.Yii::app()->user->name.'!', 'url' => '#', 'visible'=>!Yii::app()->user->isGuest, 'items' => array(
						array('label'=>'Logout', 'url'=>array('/site/logout'), 'icon' => 'user'),
					)),
				),
			),
		),
	));
	?>
<div class="container">

	<?php if(isset($this->breadcrumbs)):?>
		<!--<?php $this->widget('bootstrap.widgets.BootBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
	
	<?php echo $content; ?>
	
	<div class="clear"></div>

	<div class="row">
		<div class="span12">
			<div class="footer">
				<div class="row">
					<div class="span6">
						Copyright &copy; <?php echo date('Y'); ?> by Segworks Technologies Corporation.
						All Rights Reserved.
					</div>
					<div class="span6 right"><?php echo Yii::powered(); ?></div>
				</div>	
			</div><!-- footer -->
		</div>
	</div>

</div><!-- page -->

</body>
</html>
