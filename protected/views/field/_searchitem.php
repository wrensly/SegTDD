<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions' => array(
		'class' => 'search-form',
		'style' => 'display:none',
	),
	'type' => 'vertical',
)); ?>

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
	'dataProvider'=>$model,
	'template'=> $template,
	'pagerCssClass' => 'pagination pull-right',
	'columns'=>array(
		array(
            'class'=>'zii.widgets.grid.CCheckBoxColumn',
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
));

 ?>
