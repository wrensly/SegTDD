<?php
$this->breadcrumbs=array(
	'Forms'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Form', 'url'=>array('index')),
	array('label'=>'Create Form', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.advanced-search-form').toggle(250);
	return false;
});
$('.search-form').submit(function(){
	$.fn.yiiGridView.update('form-grid', {
		data: $(this).serialize()
	});
	return false;
});
$('.advanced-search-form').submit(function(){
	$.fn.yiiGridView.update('form-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
$this->content_title = "Manage Forms";
?>

<?php $this->widget('bootstrap.widgets.BootAlert'); ?>

<?php $this->renderPartial('_simpleSearch',array(
	'model'=>$model
)); ?><!-- search-form -->
</div>


<?php 

$this->widget('bootstrap.widgets.BootGridView', array(
	'id'=>'form-grid',
	'type'=>'striped bordered condensed',
    'dataProvider'=>$model->search(),
	'columns'=>array(
		array('name' => 'code', 'value' => '$data->form->code'),
		array('name' => 'name', 'value' => '$data->form->name'),
		array('name' => 'description', 'value' => '$data->form->description'),
		array('name' => 'category_name', 'value' => '$data->category->category_name'),
		array('name' => 'status', 'value' => array($this,'renderStatus')),
		
		/*
		'layout',
		'entity_id',
		'attribute',
		*/
		array(
    	'class'=>'bootstrap.widgets.BootButtonColumn',
        'htmlOptions'=>array('style'=>'width: 50px'),
	),
		))); 


?>