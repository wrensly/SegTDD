<?php
$this->breadcrumbs=array(
	'Form Categories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Form', 'url'=>array('index')),
	array('label'=>'Create Form', 'url'=>array('create')),
	array('label'=>'Update Form', 'url'=> Yii::app()->createUrl('formCategory/', array('update'=> $model->id))),
//	array('label'=>'Delete FormCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Form', 'url'=>array('admin')),
);
$this->content_title = $model->form->code;
?>

<?php $this->widget('bootstrap.widgets.BootDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array('name' => 'category_name', 'value' => $model->category->category_name),
		array('label'=>	'Entity Association', 'value' => $entity->entity_name),	
		array('name' => 'code', 'value' => $model->form->code),
		array('name' => 'name', 'value' => $model->form->name),
		array('name' => 'description', 'value' => $model->form->description),
		array('name' => 'status', 'value' => ($model->form->status == 1 ? 'Active' : 'Inactive')),
		array('name' => 'tags', 'value' => implode(',', $tags)),
		array('name' => 'layout', 'value' => $model->form->layout),	
		array('name' => 'attribute', 'value' => $model->form->attribute),	
	),
)); ?>