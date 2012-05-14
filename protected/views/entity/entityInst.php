<style type="text/css">
	.manageEntity_title {
		margin-bottom: 20px;

	}

	.newEntityBT {
		/*background: #299a0b;
		background: -moz-linear-gradient(left,  #299a0b 0%, #299a0b 100%);
		background: -webkit-gradient(linear, left top, right top, color-stop(0%,#299a0b), color-stop(100%,#299a0b));
		background: -webkit-linear-gradient(left,  #299a0b 0%,#299a0b 100%);
		background: -o-linear-gradient(left,  #299a0b 0%,#299a0b 100%);
		background: -ms-linear-gradient(left,  #299a0b 0%,#299a0b 100%);
		background: linear-gradient(left,  #299a0b 0%,#299a0b 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#299a0b', endColorstr='#299a0b',GradientType=1 );*/
		font-weight: bold;
		color: white;
		letter-spacing:2px;
		position: relative;
		top: 8px;
	}
	
	.myBtn {

	}
	.bootBtnCol {

	}

</style>

<?php
$this->breadcrumbs=array(
	'Manage'=>array('index'),
	$model->entity_name,
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle(250);
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('entity-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

$this->content_title = 'Manage Entity';

?>

<div class="offset3">
<?php 
 	$this->widget('bootstrap.widgets.BootButton', array(
		'label'=>'New Entity',
		'type'=>'success',
		'size'=>'normal',
		'icon'=>'user white',
		'url'=>array('create'),
		'htmlOptions'=>array('class'=>'newEntityBT pull-right'),
	));
?>
</div>

<?php

	$criteria=new CDbCriteria;
	$criteria->select = array('fieldname', 'label', 'datatype');
	$criteria->condition = 'entity_id=(select id from entity where form_id=(select form_id from entity where id='.$id.'))';

	// $vars = Field::conditionItems('label', $criteria);
	$vars = Field::model()->findAll($criteria);

?>

<table class="table table-striped table-bordered table-condensed">
  <thead>
    <tr>
<?php
	foreach($vars as $vv)
    	echo '<th>'.$vv->label.'</th>';
?>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>…</td>
      <td>…</td>
    </tr>
  </tbody>
</table>

<?php

$var = array('name'=>'label');
foreach($vars as $vv)
    	echo '<th>'.$vv->label.'</th>';


	$this->widget('bootstrap.widgets.BootGridView', array(
	'id'=>'entity-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>Field::model()->search2($id),
	'template'=>'{items}',
	'columns'=>array(

		// array('name'=>'Entity Model', 'value'=>'$data->entity[\'entityname\']', 'htmlOptions'=>array('style'=>'width: 200px;')),
		// array('name'=>'$list[0]->label'),
		// array('name'=>'firstname', 'value'=>'firstname'),
		$var,

		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
			'buttons'=>array(
				'view' => array(
						'label' => null,
						// 'imageUrl' => false,"/form/create"  $data->form_id
						'url'=>'Yii::app()->controller->createUrl("/form/create")', //Sample Link (next thing to do: create own Boot Button Column(extend CGridColumn))
						'icon'=>'cog white',
						'options' => array('style'=>'margin-left: 15px;', 'class'=>'btn btn-primary', 'title'=>'Select'),
						// 'visible'=>'($data->form_id!=null)?true:false;',
					),
				'update' => array(
						'label'=>null,
						// 'imageUrl'=>false,
						'options'=>array('style'=>'margin-left: 15px;', 'class'=>'btn', 'title'=>'Edit'),
					),
				'delete' => array(
						'label'=>null,
						// 'imageUrl' => false,
						'icon'=>'trash white',
						'options' => array('style'=>'margin-left: 15px;', 'class'=>'btn btn-danger', 'title'=>'Delete'),
					),
				),
			// 'updateButtonUrl' => 'Yii::app()->controller->createUrl("#entityModal",array("id"=>$data->primaryKey))',
			'htmlOptions'=>array('style'=>'width: 180px; text-align:top-center;'),
		),

	),
	// 'htmlOptions'=>array('style'=>'width: 134.2%;' /*width: 1165px*/ ),
)); 

?>