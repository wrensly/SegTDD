<?php
Yii::app()->clientScript->registerScript('load-numeric-preset', "
$('#ConstraintNumeric_presetSelect').change(function(){ loadPreset(this); });

function loadPreset(object){
	var preset = $('option:selected', object).val();
	switch (preset) {
		case 'b': setPreset(0,0,1,0); break;
		case 'i': setPreset(0,-2147483648,2147483648,0); break;
		case 'd': setPreset(64,'-2.2250738585072014E-308','+2.2250738585072014E-308',0); break;
		case 'm': setPreset(2,0,4294967295,0); break;
		default : setPreset(0,0,100,0); break;
	}
}
function setPreset(digits,min,max,def){
	$('input[type=text]','#constraintNumeric').each(function(index){
		switch(index){
			case 0: this.value = digits; break;
			case 1: this.value = min; break;
			case 2: this.value = max; break;
			case 3: this.value = def; break;
		}
	});
}
");
?>

<?php
$numericPresetsSelect = array(
	'b' => 'Boolean',
	'i' => 'Integer',
	'd' => 'Decimal',
	'm' => 'Currency',
);
?>
<div class="control-group">
	<label class="control-label" for="ConstraintNumeric_presetSelect">Presets</label>
	<div class="controls">
		<?php echo CHtml::dropdownlist('ConstraintNumeric_presetSelect',null, $numericPresetsSelect,array(
 			'prompt' => '-SELECT-',)); ?>
    </div>
</div>
<?php
// Setting the default values
defineDefaultsof($constraintNumericModel,array(
	'decimaldigit'  => 0,
	'minvalue'      => 0,
	'maxvalue'      => 100,
	'default_value' => 0,
));
?>
<?php echo $form->textFieldRow($constraintNumericModel,'decimaldigit'); ?>
<?php echo $form->textFieldRow($constraintNumericModel,'minvalue'); ?>
<?php echo $form->textFieldRow($constraintNumericModel,'maxvalue'); ?>
<?php echo $form->textFieldRow($constraintNumericModel,'default_value'); ?>