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
		            'name'=>'datatype',
		            'value'=>$this->renderDataType($fieldModel,0),
		        ),
				'description',
				array(
		            'name'=>'multiple',
		            'value'=>Yii::app()->format->boolean($fieldModel->multiple),
		            //$this->renderBoolean($fieldModel,'multiple'),
		        ),
				array(
		            'name'=>'required',
		            'value'=>Yii::app()->format->boolean($fieldModel->required),
		            //$this->renderBoolean($fieldModel,'required'),
		        ),
		        array(
		            'name'=>'derived',
		            'value'=>Yii::app()->format->boolean($fieldModel->derived),
		            //$this->renderBoolean($fieldModel,'derived'),
		        ),
		        array(
		            'name'=>'attribute',
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
				case 'C':
					$this->widget('bootstrap.widgets.BootDetailView', array(
						'data'=>$fieldModel,
						'attributes'=>array(
					        'parent_id',
						),
					));
					break;
			};
			if ($fieldModel->derived == 1){
				echo $this->renderPartial('_viewConstraintDerived', array(
						'constraintDerivedModel' =>$constraintDerivedModel,
					));
			}
		?>
		<h3>Others</h3>
		<?php $this->widget('bootstrap.widgets.BootDetailView', array(
			'data'=>$fieldModel,
			'attributes'=>array(
				'entity.entity_name',
			),
		)); ?>
	</div>
</div>
