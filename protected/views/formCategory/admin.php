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
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('form-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
$this->content_title = "Manage Forms";
?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); 



?>
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