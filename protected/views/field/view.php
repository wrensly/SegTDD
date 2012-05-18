<?php
$this->breadcrumbs=array(
	'Fields'=>array('index'),
	$fieldModel->fieldname,
);

$this->menu=array(
	array('label'=>'Create Field', 'url'=>array('create')),
	array('label'=>'Update Field', 'url'=>array('update', 'id'=>$fieldModel->id)),
	array('label'=>'Delete Field', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$fieldModel->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Field', 'url'=>array('index')),
);

$this->content_title = 'View Field '.$fieldModel->fieldname;
?>
<div class="row">
	<div class="span6">
		<h3>Properties</h3>
		<?php $this->widget('bootstrap.widgets.BootDetailView', array(
			'data'=>$fieldModel,
			'attributes'=>array(
				'fieldname',
				'label',
				'alias',
				array(
		            'name' =>'datatype',
		            'value'=>$this->renderDataType($fieldModel,0),
		        ),
				'description',
				array(
		            'name' =>'multiple',
		            'value'=>Yii::app()->format->boolean($fieldModel->multiple),
		            //$this->renderBoolean($fieldModel,'multiple'),
		        ),
				array(
		            'name' =>'required',
		            'value'=>Yii::app()->format->boolean($fieldModel->required),
		            //$this->renderBoolean($fieldModel,'required'),
		        ),
		        array(
		            'name' =>'attribute',
		            'value'=>Yii::app()->format->boolean($fieldModel->attribute),
		            //$this->renderBoolean($fieldModel,'attribute'),
		        ),
			),
		)); ?>
	</div>
	<div class="span6">
		<h3>Constraints</h3>
		<?php
			switch($fieldModel->datatype){
				case 'T':
					echo $this->renderPartial('_viewConstraintText', array(
						'constraintTextModel' =>$constraintTextModel,
					));
				   	break;
				case 'N':
					echo $this->renderPartial('_viewConstraintNumeric', array(
						'constraintNumericModel' =>$constraintNumericModel,
					));
				   	break;
				case 'D':
				case 't':
				case 'd':
					echo $this->renderPartial('_viewConstraintDatetime', array(
						'constraintDatetimeModel' =>$constraintDatetimeModel,
					));
				   	break;
				case 'O':
					echo $this->renderPartial('_viewConstraintEnum', array(
						'constraintEnumModel' =>$constraintEnumModel,
					));
				   	break;
				case 'F':
					echo $this->renderPartial('_viewConstraintFile', array(
						'constraintFileModel' =>$constraintFileModel,
					));
				   	break;
				case 'X':
					echo $this->renderPartial('_viewConstraintComputed', array(
						'constraintComputedModel' =>$constraintComputedModel,
					));
					break;
				case 'C':
				echo $this->renderPartial('_viewConstraintCompound', array(
						'fieldModel' =>$fieldModel,
					));
					break;
			};
		?>
		<h3>Others</h3>
		<?php
		$this->widget('bootstrap.widgets.BootDetailView', array(
			'data'=>$fieldModel,
			'attributes'=>array(
				array(
						'name' => 'entity_id',
						'label'=> 'Entity Association',
						'type' => 'raw',
				        'value'=> CHtml::link(CHtml::encode($fieldModel->entity->entity_name),
				        	array('entity/view','id'=>$fieldModel->entity->id)),
			        ),
			),
		));
		if($fieldModel->parent_id!=null){
			$this->widget('bootstrap.widgets.BootDetailView', array(
				'data'=>$fieldModel,
				'attributes'=>array(
					array(
						'name' => 'parent_id',
						'label' => 'Parent Field',
						'type' => 'raw',
				        'value' => CHtml::link(CHtml::encode($fieldModel->parent->fieldname),
				        	array('field/view','id'=>$fieldModel->parent->id)),
			        ),
				),
			));
		}
		?>
	</div>
</div>
