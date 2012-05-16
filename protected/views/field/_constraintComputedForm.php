<?php
Yii::app()->clientScript->registerScript('computed-checked', "
$('#Field_computed').is(':checked') ? $('#constraintComputed').show(250) : $('#constraintComputed').hide(250);
$('#Field_computed').click(function(){ $('#constraintComputed').toggle(250); });
");
?>
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
    <?php echo $form->textArea($constraintComputedModel,'view_expression_data',array(
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
	<?php echo $form->labelEx($constraintComputedModel,'view_expression_data',array('class'=>'control-label')); ?>
    <div class="controls">
		<?php echo CHtml::link('Edit View Code','#viewCodeModal', array('class'=>'btn btn-warning', 'data-toggle'=>'modal')); ?>
        <?php echo $form->error($constraintComputedModel,'view_expression_data'); ?> 
    </div>
</div>