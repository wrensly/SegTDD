<?php
$this->breadcrumbs=array(
	'Fields'=>array('index'),
	'Manage',
);

$this->menu=array(
	array(
		'label'=>'Create Field',
		'url'=>array('create')
	),
);

$this->content_title = 'Manage Fields';

$this->search = array(
	'simple' => true,
	'advanced' => true,
	'model' => $model,
);
?>

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
            'class'=>'zii.widgets.grid.CCheckBoxColumn',
            'name' => 'id',
        	'selectableRows' => 2,
        ),
        array(
            'name'=>'entity_id',
            'value'=>'$data->entity[\'entity_name\']',
        ),

		'fieldname',
		'label',
		array(
            'name'=>'datatype',
            'value'=>array($this,'renderDataType'), 
        ),

		'description',
		array(
            'name'=>'multiple',
            'value' =>'Yii::app()->format->boolean($data->multiple)',
            //array($this,'renderMultiple'),
        ),
        array(
            'name'=>'required',
            'value' =>'Yii::app()->format->boolean($data->required)',
            //array($this,'renderRequired'),
        ),
        array(
            'name'=>'attribute',
            'value' =>'Yii::app()->format->boolean($data->attribute)',
            //array($this,'renderAttribute'),
        ),
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
));

 ?>


