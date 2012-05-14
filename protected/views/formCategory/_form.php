<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well'),
)); ?>



	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('maxlength'=>50, 'class'=>'span6')); ?>
		<?php echo $form->error($model,'code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('maxlength'=>50, 'class'=>'span6')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->checkBox($model,'status') . ' ' . 'Active' ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Entity Association'); ?>
		<?php echo $form->dropDownList($model,'entity_id', CHtml::listData(Entity::model()->findAll(), 'id', 'entityname')); ?>
		<?php echo $form->error($model,'entity_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($formCategory,'Category'); ?>
		<?php echo $form->dropDownList($formCategory,'category_id',CHtml::listData(Category::model()->findAll(), 'id', 'category_name')); ?>
		<?php echo $form->error($formCategory,'category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($tags,'tag_name'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
		'model' => $tags,
    	'name'=>'tag_name',
    	'attribute'=>'tag_name',
   		'source'=>$suggest,
    	// additional javascript options for the autocomplete plugin
    	'options'=>array(
        'minLength'=>'2',
    	),
    	'htmlOptions'=>array(
        'style'=>'height:20px;',
    ),
));
	?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('label'=>'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->