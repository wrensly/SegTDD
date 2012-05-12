<?php
$this->breadcrumbs=array(
	'Teachers'=>array('index'),
	$model->TID,
);

$this->menu=array(
	array('label'=>'Create Teacher', 'url'=>array('create')),
	array('label'=>'Update Teacher', 'url'=>array('update', 'id'=>$model->TID)),
	array('label'=>'Delete Teacher', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->TID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Teacher', 'url'=>array('admin')),
);
?>

<h1>View Teacher ID Number: <?php echo $model->TID; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'TID',
		'Firstname',
		'Midname',
		'Lastname',
		'Address',
		'Bdate',
		'Status',
		'Level',
		'SubjectArea',
		'inactiveDate',
	),
)); ?>
