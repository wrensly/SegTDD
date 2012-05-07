<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" rel="icon" type="image/x-icon" />
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


<?php
	if(!Yii::app()->user->isGuest)
		echo "<body>";
	else
		echo "<body class='myBodybg'>";
?>
<!-- 'htmlOption'=>array('class'=>'myNavBarPad') -->
	<?php 
	if(!Yii::app()->user->isGuest) {
		$this->widget('bootstrap.widgets.BootNavbar', array(
			'fixed' => 'top',
			'brand' => CHtml::encode(Yii::app()->name),
			'brandUrl' => '#',
			'collapse' => true,
			'items' => array(
				array(
					'class' => 'bootstrap.widgets.BootMenu',
					'items' => array(
						array(
							'label'=>'Dashboard',
							'url'=>array('/site/index'),
						),
						array(
							'label'=>'Field', 
							'url'=>array(
								'/site/page',
								'view'=>'about',
							), 
							'items'=>array( 
								array(
									'label'=>'manage field', 
									'url'=>array('/field'), 
									'icon' => 'align-justify white',
								),
								array(
									'label'=>'create field',
									'url'=>array('/field/create'),
									'icon'=>'plus white',
								),
							),
						),
						array(
							'label'=>'Form',
							'url'=>array('/site/contact'), 
							'items'=>array(
								array(
									'label'=>'manage form',
									'url'=>array('/site/contact'), 
									'icon' => 'file white',
								),
								array(
									'label'=>'create form',
									'url'=>'#',
									'icon'=>'plus white',
								), 
							),
						),
						array(
							'label'=>'Entity', 
							'url'=>array('/site/none'), 
							'items'=>array( 
								array(
									'label'=>'manage entity',
									'url'=>array('/site/none'),
									'icon' => 'cog white',
								),
								array(
									'label'=>'create entity',
									'url'=>'#', 
									'icon'=>'plus white',
								),
							),
						),
					),
				),
				array(
					'class' => 'bootstrap.widgets.BootMenu',
					'htmlOptions' => array('class' => 'pull-right'),
					'items' => array(
						array(
							'label' => 'Users',
							'url' => '#',
							'visible'=>Yii::app()->user->isGuest,
							'items' => array(
								array(
									'label'=>'Login',
									'url'=>array('/site/login'),
									'icon' => 'user'
								),
							),
						),
						array(
							'label' => 'Welcome, '.Yii::app()->user->name.'!', 
							'url' => '#',
							'visible'=>!Yii::app()->user->isGuest,
							'items' => array(
								array(
									'label'=>'Logout',
									'url'=>array('/site/logout'),
									'icon' => 'off'
								),
							),
						),
					),

				),
			),
		));
	}
	?>

<div class="container">
	<?php
	if(!Yii::app()->user->isGuest) {
		if(count($this->breadcrumbs) !== 0) {
			$this->widget('bootstrap.widgets.BootBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
			)); // breadcrumbs
		}
	}
	?>
	
	<?php echo $content; ?>
	
	<div class="clear"></div>

	<?php if(!Yii::app()->user->isGuest): ?>
	<div class="row">
		<div class="footer">
			<div class="span6">
				Copyright &copy; <?php echo date('Y'); ?> by Segworks Technologies Corporation.
				All Rights Reserved.<br/>
				<?php echo Yii::powered(); ?>
			</div>
			<div class="span6 right">
				<?php $this->widget('bootstrap.widgets.BootMenu', array(
				    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
				    'items'=>array(
				        array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
						array('label'=>'Contact Us', 'url'=>array('/site/contact')),
				    ),
				    'htmlOptions' => array('class' => 'pull-right')
				)); ?>
			</div>
		</div><!-- footer -->
	</div>
	<?php endif ?>

</div><!-- page -->

</body>
</html>
