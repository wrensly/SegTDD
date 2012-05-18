<?php
$this->breadcrumbs=array(
	'Forms',
);

$this->menu=array(
	array('label'=>'Create Form', 'url'=>array('create')),
);


$this->content_title = "Manage Forms";


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
	'id'		  =>'form-grid',
	'type'		  =>'striped',
	'dataProvider'=>$model->search(),
	'template'	  => $template,
	'pagerCssClass' => 'pagination pull-right',
	'columns' => array(
		array('name' => 'code', 'value' => '$data->form->code'),
		array('name' => 'name', 'value' => '$data->form->name'),
		array('name' => 'description', 'value' => '$data->form->description'),
		array('name' => 'category_name', 'value' => '$data->category->category_name'),
		array('name' => 'status', 'value' => array($this,'renderStatus')),
		array(
			'header'=>'Actions',
            'class' =>'bootstrap.widgets.BootButtonColumn',
            'htmlOptions'=>array('style'=>'width: 70px'),
            'buttons'=> array(
            	'editor' => array(
				    'label'=>'Open In Editor',     // text label of the button
				    'icon' =>'edit',
				    'url'  =>'Yii::app()->createUrl("formCategory/formEditor",array("id"=>$data->id))',
				),
            ),
            'template'=>'{view} {update} {delete} {editor}',
        ),
		/*
		'layout',
		'entity_id',
		'attribute',
		*/
		)));
?>