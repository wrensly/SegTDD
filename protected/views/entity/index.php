<?php
$this->breadcrumbs=array(
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Entity Model', 'url'=>array('create')),
);

$this->content_title = 'Manage Entity';

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
			
		array('name'=>'entity_name', 'header'=>'Name', 'htmlOptions'=>array('style'=>'width: 200px;')),
			
		array('name'=>'description'),

		array('value'=>array($this, 'renderEntityCount'), 'header'=>'No. of Instances', 'htmlOptions'=>array('style'=>'width: 120px; text-align: center;')),

		array('name'=>'form_id', 'value'=>'$data->form[\'code\']', 'htmlOptions'=>array('style'=>'width: 220px;')),

		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
			'buttons'=>array(
				'view' => array(
						'label' => null,
						// 'imageUrl' => false,"/form/create"  $data->form_id
						'url'=>'Yii::app()->controller->createUrl("entityInst", array("id"=>$data->primaryKey))', //Sample Link (next thing to do: create own Boot Button Column(extend CGridColumn))
						'icon'=>'cog',
						'options' => array('title'=>'Select'),
						// 'visible'=>'($data->form_id!=null)?true:false;',
					),
				'update' => array(
						'label'=>null,
						// 'imageUrl'=>false,
						'options'=>array('title'=>'Edit'),
					),
				'delete' => array(
						'label'=>null,
						// 'imageUrl' => false,
						'icon'=>'trash',
						'options' => array('title'=>'Delete'),
					),
				),
			// 'updateButtonUrl' => 'Yii::app()->controller->createUrl("#entityModal",array("id"=>$data->primaryKey))',
			//'htmlOptions'=>array('style'=>'width: 100px; text-align:top-center;'),
		),

	),
	// 'htmlOptions'=>array('style'=>'width: 134.2%;' /*width: 1165px*/ ),
)); 

?>
