<?php
$this->breadcrumbs=array(
	'Forms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Form', 'url'=>array('index')),
);

$this->content_title = "Create Form"; 
?>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'formCategory' => $formCategory, 'category' => $category)); ?>