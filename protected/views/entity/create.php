<?php
$this->breadcrumbs=array(
	'Manage'=>array('index'),
	'Create',
);

$this->content_title = 'Create Entity';

$this->menu=array(
	array('label'=>'Manage Entity', 'url'=>array('index')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>