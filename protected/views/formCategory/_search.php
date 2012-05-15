<div class="wide form">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'inlineForm',
    'type'=>'inline',
   // 'htmlOptions'=>array('class'=>'well'),
)); ?>
		<?php echo $form->textFieldRow($model,'tags',array('maxlength'=>50)); ?>
		<?php echo $form->textFieldRow($model,'code',array('maxlength'=>50)); ?>
		<?php echo $form->textFieldRow($model,'name',array('maxlength'=>50)); ?>
		<?php echo $form->textFieldRow($model,'description',array('maxlength'=>50)); ?>
		<?php echo $form->dropDownList($model, 'status', array('1' => 'Active', '0' => 'Inactive'), array('prompt' => '-Select Status-')); ?>
		<?php echo $form->dropDownList($model,'entity_id', CHtml::listData(Entity::model()->findAll(), 'id', 'entity_name'), array('prompt' => '-Select Entity-')); ?>
		<?php echo $form->dropDownList($model,'category_name',CHtml::listData(Category::model()->findAll(), 'category_name', 'category_name'), array('prompt' => '-Select Category-')); ?>
		<?php //echo $form->textFieldRow($tags,'tag_name',array('maxlength'=>50)); ?>

		<div class = "row">
		<br><br>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search', 'label'=>'Search')); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Reset')); ?>
		</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->