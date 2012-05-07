<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
	array('label'=>'Update Category', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Category', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Category', 'url'=>array('admin')),
);

$this->content_title = $model->category_name;
?>

<?php $this->widget('bootstrap.widgets.BootDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category_name',
	),
)); ?>
