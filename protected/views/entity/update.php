<?php
$this->breadcrumbs=array(
	'Manage'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->content_title = "Update Entity - ".$model->entity_name;

$this->menu=array(
	array('label'=>'Create Entity', 'url'=>array('create')),
	array('label'=>'View Entity',   'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Entity', 'url'=>array('index')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>