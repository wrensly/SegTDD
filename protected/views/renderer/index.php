<?php
$this->breadcrumbs=array(
	'Renderer',
);?>

<?php
$this->menu=array(
	array('label'=>'Create Entity Model', 'url'=>array('create')),
);

$this->content_title = 'Form Renderer';

$this->search = array(
	'simple' => true,
	'advanced' => true,
	'model' => $model,
);
?>

<?php
	$this->widget('bootstrap.widgets.BootGridView', array(
	'id'=>'entity-grid',
	'type'=>'striped',
	'dataProvider'=>$model->search(),
	'columns'=>array(
			
		array('name'=>'code', /*'htmlOptions'=>array('style'=>'width: 200px;')*/),
			
		array('name'=>'name', 'header'=>'Form Name'),

		array('name'=>'description'),

		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
			'template'=>'{view}',
			'buttons'=>array(
				'view' => array(
						'label' => null,
						// 'imageUrl' => false,"/form/create"  $data->form_id
						'url'=>'Yii::app()->controller->createUrl("renderer", array("id"=>$data->primaryKey))', //Sample Link (next thing to do: create own Boot Button Column(extend CGridColumn))
						'icon'=>'eye-open',
						'options' => array('style'=>'margin-left: 10px;', 'title'=>'Render'),
						// 'visible'=>'($data->form_id!=null)?true:false;',
					),
				),
			// 'updateButtonUrl' => 'Yii::app()->controller->createUrl("#entityModal",array("id"=>$data->primaryKey))',
			'htmlOptions'=>array('style'=>'width: 10px; text-align:top-center;'),
		),

	),
	// 'htmlOptions'=>array('style'=>'width: 134.2%;' /*width: 1165px*/ ),
)); 

?>
