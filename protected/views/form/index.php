<?php
$this->breadcrumbs=array(
	'Forms',
);

$this->menu=array(
	array('label'=>'Create Form', 'url'=>array('create')),
	array('label'=>'Manage Form', 'url'=>array('admin')),
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
)); ?>
</div>

<?php 

$this->widget('bootstrap.widgets.BootGridView', array(
	'id'=>'form-grid',
	'type'=>'striped bordered condensed',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
	'columns'=>array(
		'id',
		'code',
		'name',
		'description',
		array('name' => 'status', 'value' => array($this,'renderStatus')),
		'tags',
		array(
            'class'=>'bootstrap.widgets.BootButtonColumn',
            'template' => '{view}',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
		/*
		'layout',
		'entity_id',
		'attribute',
		*/
		
		))); 


?>

