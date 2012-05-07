<?php
$this->breadcrumbs=array(
	'Forms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Form', 'url'=>array('index')),
	array('label'=>'Manage Form', 'url'=>array('admin')),
);

$this->content_title = "Create Form"; 
?>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'formCategory' => $formCategory, 'category' => $category)); ?>