<?php $this->widget('bootstrap.widgets.BootDetailView', array(
			'data'=>$constraintEnumModel,
			'attributes'=>array(
				'maxselect',
				'minselect',
				array(
		            'name'=>'picklist',
		            'type' => 'raw',
		            'value'=> CHtml::link('View Options','#optionsListModal', array('class'=>'btn btn-warning btn-mini', 'data-toggle'=>'modal')),
		        ),
				'default_value',
			),
		)
); ?>
<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'optionsListModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>View Options</h3>
</div>
 
<div class="modal-body">
    <table class="table table-striped">
	    <tr>
	    	<th>Value</th>
	    	<th>Label</th>
	    <tr>
    <?php
        $options = CJSON::decode($constraintEnumModel->picklist);
        foreach($options as $value => $label){
    ?>
    	<tr>
	    	<td><?php echo $value; ?></td>
	    	<td><?php echo $label; ?></td>
	    <tr>
    <?php
        }
    ?>
    </table>
</div>
 
<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Close',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>