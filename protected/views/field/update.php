<?php
$this->breadcrumbs=array(
	'Fields'=>array('index'),
	$fieldModel->id=>array('view','id'=>$fieldModel->fieldname),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Field', 'url'=>array('create')),
	array('label'=>'View Field', 'url'=>array('view', 'id'=>$fieldModel->id)),
	array('label'=>'Manage Field', 'url'=>array('index')),
);

$this->content_title = 'Update Field '.$fieldModel->fieldname;

?>

<?php echo $this->renderPartial('_form', array(
	'fieldModel'              =>$fieldModel,
	'constraintTextModel'     =>$constraintTextModel,
	'constraintNumericModel'  =>$constraintNumericModel,
	'constraintDatetimeModel' =>$constraintDatetimeModel,
	'constraintEnumModel'     =>$constraintEnumModel,
	'constraintFileModel'     =>$constraintFileModel,
	'constraintDerivedModel'  =>$constraintDerivedModel,
	)); ?>