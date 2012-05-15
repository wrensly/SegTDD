<?php $this->widget('bootstrap.widgets.BootDetailView', array(
			'data'=>$constraintComputedModel,
			'attributes'=>array(
				array(
		            'name'=>'view_expression_data',
		            'type' => 'raw',
		            'value'=> CHtml::link('View Code','#viewCodeModal', array('class'=>'btn btn-warning btn-mini', 'data-toggle'=>'modal')),
		        ),
			),
		)
); ?>

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'viewCodeModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>View Expression Code</h3>
</div>
 
<div class="modal-body">
    <div class="code-display well">
        <?php $this->beginWidget('CTextHighlighter',array(
            'language'=>'javascript',
            'showLineNumbers' => true,
        )); ?>
<?php echo $constraintComputedModel->view_expression_data; ?>
        <?php $this->endWidget(); ?>
    </div>
</div>
 
<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Close',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>
