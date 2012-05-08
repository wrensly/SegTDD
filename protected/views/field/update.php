<?php
$this->breadcrumbs=array(
	'Fields'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Field', 'url'=>array('create')),
	array('label'=>'View Field', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Field', 'url'=>array('index')),
);

$this->content_title = 'Update Field '.$model->id;

?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>