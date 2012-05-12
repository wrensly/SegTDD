<div class="form">
<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'inlineForm',
    'type'=>'inline'
    //'htmlOptions'=>array('class'=>'well'),
)); ?>	
		<?php echo '<b>Search</b>'; ?>
		<?php echo $form->textFieldRow($model,'category_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->textFieldRow($model,'description',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo CHtml::submitButton('Search'); ?>


<?php $this->endWidget(); ?>

</div><!-- search-form -->