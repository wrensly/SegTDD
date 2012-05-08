<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'optionsListModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Modify Options</h3>
</div>
 
<div class="modal-body">
    <?php echo $form->textField($constraintEnumModel,'picklist'); ?>
</div>
 
<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'type'=>'primary',
        'label'=>'Save changes',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Close',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>
<?php echo $form->textFieldRow($constraintEnumModel,'maxselect'); ?>
<?php echo $form->textFieldRow($constraintEnumModel,'minselect'); ?>
<div class="control-group">
	<label class="control-label">Options</label>
	<div class="controls">
		<?php echo CHtml::link('Modify Options','#optionsListModal', array('class'=>'btn btn-warning', 'data-toggle'=>'modal')); ?>	
	</div>
</div>
<?php echo $form->textFieldRow($constraintEnumModel,'default_value'); ?>