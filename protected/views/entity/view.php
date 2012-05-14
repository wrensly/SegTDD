<?php
$this->breadcrumbs=array(
	'Manage'=>array('index'),
	$model->id,
);

$this->content_title = "View Entity - ".$model->entity_name;

$this->menu=array(
	array('label'=>'Create Entity', 'url'=>array('create')),
	array('label'=>'Update Entity', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Entity', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Entity', 'url'=>array('index')),
);
?>

<?php 
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'id',
			'entity_name',
			'description',
			'form.code',
		),
	)); 
?>
