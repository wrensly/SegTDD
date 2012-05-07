<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'viewCodeModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Edit View Expression Code</h3>
</div>
 
<div class="modal-body">
    <div class="alert alert-info">
        <a class="close" data-dismiss="alert">×</a>
        <strong>Use Javascript!</strong> Please use javascript in defining your View Expression code.
    </div>
    <?php echo $form->textArea($constraintDerivedModel,'view_expression_data',array(
        'rows'=>6,
        'cols'=>200,
        'class'=>'view-code-textarea well',
        )); ?>
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
<div class="control-group">
	<label class="control-label">View Expression Data</label>
	<div class="controls">
		<?php echo CHtml::link('Edit View Code','#viewCodeModal', array('class'=>'btn btn-warning', 'data-toggle'=>'modal')); ?>	
	</div>
</div>