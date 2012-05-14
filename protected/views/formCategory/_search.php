<div class="wide form">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'inlineForm',
    'type'=>'inline',
   // 'htmlOptions'=>array('class'=>'well'),
)); ?>
		<?php echo $form->textFieldRow($model,'code',array('maxlength'=>50)); ?>
		<?php echo $form->textFieldRow($model,'name',array('maxlength'=>50)); ?>
		<?php echo $form->textFieldRow($model,'description',array('maxlength'=>50)); ?>
		<?php echo $form->dropDownList($model, 'status', array('' => '-Select Status-', '1' => 'Active', '0' => 'Inactive')); ?>
		<?php echo $form->dropDownList($model,'entity_id', CHtml::listData(Entity::model()->findAll(), 'id', 'entity_name')); ?>
		<?php //echo $form->dropDownList($formCategory,'category_id',CHtml::listData(Category::model()->findAll(), 'id', 'category_name')); ?>
		<?php //echo $form->textFieldRow($model,'tags',array('maxlength'=>50)); ?>

		<div class = "row">
		<?php echo CHtml::submitButton('Search'); ?>
		</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->