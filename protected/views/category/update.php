<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Category', 'url'=>array('create')),
	array('label'=>'Manage Category', 'url'=>array('index')),
	
);
$this->content_title = 'Update' . ' ' . $model->category_name;
?>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>