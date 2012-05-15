<?php
$this->breadcrumbs=array(
	'Manage'=>array('index'),
	$model->entity_name,
);

$this->menu=array(
	array('label'=>'Create Entity', 'url'=>array('create')),
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

$this->content_title = 'Manage '.$model->entity_name.' Entity';
?>

<?php
$field = new Field;
$var = array();
$i=0;

$dataP = $field->model()->search2($id);
foreach($dataP->getData() as $vv) {
    	 $var[$i] = array('value'=>'', 'header'=>$vv->label);
    	 $i++;
}

	$this->widget('bootstrap.widgets.BootGridView', array(
	'id'=>'entity-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$dataP,
	'template'=>'{items}',
	'columns'=>array(
			// array('header'=>$dataP->model->label, 'value'=>''),
			$var[0],
			$var[1],
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
			'buttons'=>array(
				'view' => array(
						'label' => null,
						// 'imageUrl' => false,"/form/create"  $data->form_id
						'url'=>'Yii::app()->controller->createUrl("/entity/create")', //Sample Link (next thing to do: create own Boot Button Column(extend CGridColumn))
						'icon'=>'eye-open',
						'options' => array('style'=>'margin-left: 10px;', 'title'=>'Select'),
						// 'visible'=>'($data->form_id!=null)?true:false;',
					),
				'update' => array(
						'label'=>null,
						// 'imageUrl'=>false,
						'options'=>array('style'=>'margin-left: 15px;', 'title'=>'Edit'),
					),
				'delete' => array(
						'label'=>null,
						// 'imageUrl' => false,
						'icon'=>'trash',
						'options' => array('style'=>'margin-left: 15px;', 'title'=>'Delete'),
					),
				),
			// 'updateButtonUrl' => 'Yii::app()->controller->createUrl("#entityModal",array("id"=>$data->primaryKey))',
			'htmlOptions'=>array('style'=>'width: 100px; text-align:top-center;'),
		),

	),
	// 'htmlOptions'=>array('style'=>'width: 134.2%;' /*width: 1165px*/ ),
)); 

?>