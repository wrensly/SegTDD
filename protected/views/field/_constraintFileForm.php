<?php
// Setting the default values
defineDefaultsof($constraintFileModel,array(
	'minsize' => 0,
	'maxsize' => 25600,
));
?>
<?php echo $form->textFieldRow($constraintFileModel,'minsize'); ?>
<?php echo $form->textFieldRow($constraintFileModel,'maxsize'); ?>