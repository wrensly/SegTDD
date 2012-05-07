<?php
$this->breadcrumbs=array(
	'Forms'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Form', 'url'=>array('index')),
	array('label'=>'Create Form', 'url'=>array('create')),
	array('label'=>'Update Form', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Form', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Form', 'url'=>array('admin')),
);
$this->content_title = $model->code;
?>

<?php $this->widget('bootstrap.widgets.BootDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code',
		'name',
		'description',
		array('name' => 'status', 'value' => ('status' == 1 ? 'Active' : 'Inactive')),
		'tags',
		'layout',
		'entity.entityname',
		array('label' => 'Category Name', 'value' => $category->category_name),
		'attribute',
	),
)); ?>
