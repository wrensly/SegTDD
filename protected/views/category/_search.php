<div class="form">
<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'inlineForm',
    'type'=>'inline'
    //'htmlOptions'=>array('class'=>'well'),
)); ?>	
		<?php echo '<b>Search</b>'; ?>
		<?php echo $form->textFieldRow($model,'category_name',array('class'=>'span2','maxlength'=>45)); ?>
		<?php echo $form->textFieldRow($model,'description',array('class'=>'span3','maxlength'=>45)); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search', 'label'=>'Search')); ?>
<?php $this->endWidget(); ?>

</div><!-- search-form -->