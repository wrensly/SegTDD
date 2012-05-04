<?php
$this->breadcrumbs=array(
	'Fields'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Field', 'url'=>array('index')),
	array('label'=>'Manage Field', 'url'=>array('admin')),
);
?>

<h1>Create Field</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>