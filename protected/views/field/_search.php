<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions' => array(
		'class' => 'advanced-search-form',
		'style' => 'display:none',
	),
	'type' => 'vertical',
)); ?>
	
<div class="row">
	<div class="span6">
		<fieldset>
 			<legend>Properties</legend>
 			<div class="row">
 				<div class="span3">
 					<?php echo $form->textFieldRow($model,'fieldname',array('size'=>60,'maxlength'=>100)); ?>
					<?php echo $form->textFieldRow($model,'label',array('size'=>45,'maxlength'=>45)); ?>
					<?php echo $form->textFieldRow($model,'alias',array('size'=>45,'maxlength'=>45)); ?>
					<?php echo $form->dropDownListRow($model,'datatype',
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

					
 				</div>
 				<div class="span3">
 					<?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50)); ?>
					<?php echo $form->checkBoxRow($model,'multiple'); ?>
					<?php echo $form->checkBoxRow($model,'required'); ?>
					<?php echo $form->checkBoxRow($model,'derived'); ?>
					<?php echo $form->checkBoxRow($model,'attribute'); ?>
 				</div>
 			</div>
		</fieldset>
	</div>
	<div class="span6">
		<fieldset>
			<legend>Constraints</legend>
			<?php echo $form->textFieldRow($model,'default',array('size'=>45,'maxlength'=>45)); ?>
		</fieldset>
		<fieldset>
			<legend>Others</legend>
			<?php echo $form->textFieldRow($model,'entity_id'); ?>
			<?php echo $form->textFieldRow($model,'parent_id'); ?>
		</fieldset>
	</div>
</div>
<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Search')); ?>
	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Clear Fields')); ?>
</div>

<?php $this->endWidget(); ?>
<!-- search-form -->