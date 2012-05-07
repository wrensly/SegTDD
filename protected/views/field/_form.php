<?php 

$form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'field-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>false,
));

Yii::app()->clientScript->registerScript('switchConstraint', "
$('#Field_datatype').change(function(){
	var datatype = $('option:selected', this).val();
	$('#constraintText').addClass('no-display');
	$('#constraintNumeric').addClass('no-display');
	$('#constraintDatetime').addClass('no-display');
	$('#constraintEnum').addClass('no-display');
	$('#constraintFile').addClass('no-display');
	$('#constraintCompound').addClass('no-display');

	switch (datatype) {
		case 'T':
			$('#constraintText').toggleClass('no-display');
			break;
		case 'N':
			$('#constraintNumeric').toggleClass('no-display');
			break;
		case 'D':
		case 't':
		case 'd':
			$('#constraintDatetime').toggleClass('no-display');
			break;
		case 'O':
			$('#constraintEnum').toggleClass('no-display');
			break;
		case 'F':
			$('#constraintFile').toggleClass('no-display');
			break;
		case 'C':
			$('#constraintCompound').toggleClass('no-display');
			break;
		default:
			break;
	}
});
");

Yii::app()->clientScript->registerScript('derived-checked', "
$('#Field_derived').click(function(){
	$('#constraintDerived').toggleClass('no-display');
});
");

?>
	<div class="alert alert-error">
		<p class="note">Fields with <span class="required">*</span> are required.</p>
	</div>
	
	<div class="row">
		<div class="span6">
			<fieldset>
	 			<legend>Properties</legend>
	 					<?php echo $form->textFieldRow($fieldModel,'fieldname', array(
			 				'size'=>60,
			 				'maxlength'=>100, 
			 				'hint' => 'Name of the field just like naming a column in a database.',)); ?>
						<?php echo $form->textFieldRow($fieldModel,'label',array(
							'size'=>45,
							'maxlength'=>45,
							'hint' => 'Label of the field that appears in the actual form.',)); ?>
						<?php echo $form->textFieldRow($fieldModel,'alias',array(
							'size'=>45,
							'maxlength'=>45,
							'hint' => 'Short Name of the field when querying to the database.',)); ?>
						<?php echo $form->dropDownListRow($fieldModel,'datatype',
							array(
								'T' => 'Text',
								'N' => 'Numeric',
								'D' => 'Date',
								't' => 'Time',
								'd' => 'Datetime',
								'O' => 'Option',
								'F' => 'File',
								'C' => 'Compound',
							),
							array(
								'size'=>1,
								'maxlength'=>1
							) ); ?>	 				
	 					<?php echo $form->textAreaRow($fieldModel,'description',array('rows'=>6, 'cols'=>50)); ?>
						<?php echo $form->checkBoxRow($fieldModel,'multiple'); ?>
						<?php echo $form->checkBoxRow($fieldModel,'required'); ?>
						<?php echo $form->checkBoxRow($fieldModel,'derived'); ?>
						<?php echo $form->checkBoxRow($fieldModel,'attribute'); ?>
	 		</fieldset>
		</div>
		<div class="span6">
			<fieldset>
				<legend>Constraints <small>(Optional)</small></legend>
				<div id="constraintText" class="constraint">
					<?php echo $this->renderPartial('_constraintTextForm', array(
						'form' => $form,
						'constraintTextModel' =>$constraintTextModel,
					)); ?>
					</div>
				<div id="constraintNumeric" class="constraint no-display">
					<?php echo $this->renderPartial('_constraintNumericForm', array(
						'form' => $form,
						'constraintNumericModel' =>$constraintNumericModel,
					)); ?>					
				</div>
				<div id="constraintDatetime" class="constraint no-display">
					<?php echo $this->renderPartial('_constraintDatetimeForm', array(
						'form' => $form,
						'constraintDatetimeModel' =>$constraintDatetimeModel,
					)); ?>					
				</div>
				<div id="constraintEnum" class="constraint no-display">
					<?php echo $this->renderPartial('_constraintEnumForm', array(
						'form' => $form,
						'constraintEnumModel' =>$constraintEnumModel,
					)); ?>					
				</div>
				<div id="constraintFile" class="constraint no-display">
					<?php echo $this->renderPartial('_constraintFileForm', array(
						'form' => $form,
						'constraintFileModel' =>$constraintFileModel,
					)); ?>					
				</div>
				<div id="constraintDerived" class="constraint no-display">
					<?php echo $this->renderPartial('_constraintDerivedForm', array(
						'form' => $form,
						'constraintDerivedModel' =>$constraintDerivedModel,
					)); ?>					
				</div>
				<div id="constraintCompound" class="constraint no-display">
					<?php echo $form->dropDownListRow($fieldModel,'parent_id',Field::items('fieldname'),array(
			 			'prompt' => '-SELECT-',
			 			'hint' => 'Select an entity to associate this field.',)); ?>
				</div>
			</fieldset>
			<fieldset>
				<legend>Others</legend>
				<?php echo $form->dropDownListRow($fieldModel,'entity_id',Entity::items('entityname'),array(
					'prompt' => '-SELECT-',
			 		'hint' => 'Select an entity to associate this field.',)); ?>
			</fieldset>
		</div>
	</div>
	<div class="form-actions">
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Submit')); ?>
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Reset')); ?>
	</div>

<?php $this->endWidget(); ?>
<!-- form -->