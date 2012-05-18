<?php
$this->breadcrumbs=array(
	'Forms',
);

$this->menu=array(
	array('label'=>'Create Form', 'url'=>array('create')),
	array('label'=>'Manage Form', 'url'=>array('index')),
);


$this->content_title = "Manage Forms";


$this->search = array(
	'simple' => true,
	'advanced' => true,
	'model' => $model,
);
?>

<?php
$this->widget('bootstrap.widgets.BootGridView', array(
	'id'=>'form-grid',
	'type'=>'striped',
    'dataProvider'=>$model->search(),
	'columns'=>array(
		array('name' => 'code', 'value' => '$data->form->code'),
		array('name' => 'name', 'value' => '$data->form->name'),
		array('name' => 'description', 'value' => '$data->form->description'),
		array('name' => 'category_name', 'value' => '$data->category->category_name'),
		array('name' => 'status', 'value' => array($this,'renderStatus')),
		array(
        	'type' => 'raw',
        	'value' => 'CHtml::link(\'Open in Editor\',array(\'formCategory/editor\',\'id\'=>$data->id))',
        ),
        array(
            'class'=>'bootstrap.widgets.BootButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
		/*
		'layout',
		'entity_id',
		'attribute',
		*/
		
		))); 
?>