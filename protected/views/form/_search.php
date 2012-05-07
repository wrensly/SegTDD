<div class="wide form">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well'),
    'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


	<div class="row">
		<div class = "span12">
			<div class = "span4">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>

		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>

		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>

		<?php echo $form->label($model,'layout'); ?>
		<?php echo $form->textField($model,'layout',array('size'=>50,'maxlength'=>50)); ?>

		<?php echo $form->label($model,'entity_id'); ?>
		<?php echo $form->dropDownList($model,'entity_id', CHtml::listData(Entity::model()->findAll(), 'id', 'entityname')); ?>

		
			</div>
		<div class = "span4">
		<?php echo $form->label($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>50,'maxlength'=>50)); ?>

		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('rows'=>6, 'cols'=>50)); ?>

		<?php echo $form->label($model,'tags'); ?>
		<?php echo $form->textField($model,'tags',array('size'=>50,'maxlength'=>50)); ?>

		<?php echo $form->label($model,'attribute'); ?>
		<?php echo $form->textField($model,'attribute'); ?>


			</div>
		</div>
	</div>
	<div class="row">
		<div class = "span9">
			<center><?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'icon'=>'search', 'label'=>'Search')); ?></center>
		</div>
	</div>


<?php $this->endWidget(); ?>

</div><!-- search-form -->