<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	'Create',
);

$this->menu=array(
				array(
					'label'=>'Manage Category',
				    'url'  =>array('index')),
);

$this->content_title = "Create Category";
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>