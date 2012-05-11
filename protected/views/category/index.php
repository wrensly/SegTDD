<?php
$this->breadcrumbs=array(
	'Categories',
);

$this->menu=array(
	array('label'=>'Create Category', 'url'=>'#myModal', 'linkOptions'=>array('data-toggle'=>'modal')),
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
<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$category,
)); ?>
</div>

<?php 

$this->widget('bootstrap.widgets.BootGridView', array(
	'id'=>'form-grid',
	'type'=>'striped bordered condensed',
    'dataProvider'=>$category->search(),
	'columns'=>array(
		'category_name',
		'description',
	array(
            'class'=>'bootstrap.widgets.BootButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
		))); 
?>

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Create Category</h3>
</div>
 
<div class="modal-body">
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
 
<?php $this->endWidget(); ?>



