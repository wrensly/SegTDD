<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Manage Category', 'url'=>array('admin')),
);

$this->content_title = "Create Category";
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>