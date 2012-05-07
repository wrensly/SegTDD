<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	'Manage',
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

$this->content_title = "List of Categories";
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
		'category_name',
		array(
            'class'=>'bootstrap.widgets.BootButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
		))); 


?>
