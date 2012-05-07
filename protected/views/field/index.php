<?php
$this->breadcrumbs=array(
	'Fields'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Field', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle(250);
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('field-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

$this->content_title = 'Manage Fields';

?>

<?php 
	Yii::app()->user->setFlash('info', '
	<p>You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
	</p>');
?>

<?php $this->widget('bootstrap.widgets.BootAlert'); ?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn btn-warning	')); ?>
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?><!-- search-form -->

<?php 
$template = "
	{items}
	<div class='row'>
		<div class='span6'>{summary}</div>
		<div class='span6'>{pager}</div>
	</div>";

$this->widget('bootstrap.widgets.BootGridView', array(
	'id'=>'field-grid',
	'type'=>'striped',
	'dataProvider'=>$model->search(),
	'template'=> $template,
	'pagerCssClass' => 'pagination pull-right',
	'columns'=>array(
		array(
            'class'=>'zii.widgets.grid.CCheckboxColumn',
            'name' => 'id',
        	'selectableRows' => 2,
        ),
        array(            // display 'author.username' using an expression
            'name'=>'entity_id',
            'value'=>'$data->entity[\'entityname\']',
        ),

		'fieldname',
		'label',
		array(            // display 'author.username' using an expression
            'name'=>'datatype',
            'value'=>array($this,'renderDataType'), 
        ),
		'description',
		'multiple',
		'required',
		'derived',
		/*
		'id',
		'alias',
		'default',
		'parent_id',
		'attribute',
		*/
		array(
            'class'=>'bootstrap.widgets.BootButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
	),
)); ?>
