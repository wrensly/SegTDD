<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
);
$this->content_title = 'Update' . ' ' . $model->category_name;
?>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>