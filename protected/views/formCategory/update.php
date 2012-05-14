<?php
$this->breadcrumbs=array(
	'Form Categories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Form', 'url'=>array('index')),
	array('label'=>'Create Form', 'url'=>array('create')),
	array('label'=>'View Form', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Form', 'url'=>array('admin')),
);
$this->content_title = "Update " . $model->name; 
?>



<?php echo $this->renderPartial('_form', array('model'=>$model, 'formCategory' => $formCategory, 'category' => $category, 'tags' => $tags)); ?>