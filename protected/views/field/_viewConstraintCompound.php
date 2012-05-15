<?php $this->widget('bootstrap.widgets.BootDetailView', array(
			'data'=>$fieldModel,
			'attributes'=>array(
				array(
		            'label'=> 'Child Fields',
		            'type' => 'raw',
		            'value'=> renderChildFields($fieldModel),
		        ),
			),
		)
);

function renderChildFields($fieldModel){
	$html = '';
	$childFields = $fieldModel->fields;
	foreach ($childFields as $childField){
		$html = $html.CHtml::link(CHtml::encode($childField->fieldname),
				        	array('field/view','id'=>$childField->id))."<br>";
	}
	return $html;
}
?>