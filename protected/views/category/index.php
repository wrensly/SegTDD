<?php
$this->breadcrumbs=array(
	'Categories',
);

$this->menu=array(
	array(
		'label'=>'Create Category',
		'url'=>'#myModal',
		'linkOptions'=>array('data-toggle'=>'modal'),
	),
);

$this->content_title = "List of Categories";

$this->search = array(
	'simple' => true,
	'advanced' => false,
	'model' => $model,
);
?>

<?php 
$this->widget('bootstrap.widgets.BootGridView', array(
	'id'=>'form-grid',
	'type'=>'striped',
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

<?php $this->beginWidget('bootstrap.widgets.BootModal', array(
	'id'=>'myModal',
	'htmlOptions' => array('style'=>'display:none'))); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Create Category</h3>
</div>
 
<div class="modal-body">
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>

<?php $this->endWidget(); ?>