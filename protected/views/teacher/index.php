<?php
$this->breadcrumbs=array(
	'Teachers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Teacher', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('teacher-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Teachers</h1>

<!--<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>-->
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView', array(
	'id'=>'teacher-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'TID',
		'Firstname',
		'Midname',
		'Lastname',
		'Address',
		'Bdate',
		/*
		'Status',
		'Level',
		'SubjectArea',
		'inactiveDate',
		*/
		 array(
            'class'=>'bootstrap.widgets.BootButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
	),
)); ?>
