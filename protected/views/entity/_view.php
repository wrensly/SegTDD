<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('entityname')); ?>:</b>
	<?php echo CHtml::encode($data->entityname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	b><?php echo CHtml::encode($data->getAttributeLabel('form_id')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>