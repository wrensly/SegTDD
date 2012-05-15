<?php
$this->breadcrumbs=array(
	'Fields'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Field', 'url'=>array('index')),
);

$this->content_title = 'Create Field';
?>

<?php echo $this->renderPartial('_form', array(
	'fieldModel'              =>$fieldModel,
	'constraintTextModel'     =>$constraintTextModel,
	'constraintNumericModel'  =>$constraintNumericModel,
	'constraintDatetimeModel' =>$constraintDatetimeModel,
	'constraintEnumModel'     =>$constraintEnumModel,
	'constraintFileModel'     =>$constraintFileModel,
	'constraintComputedModel' =>$constraintComputedModel,
)); ?>