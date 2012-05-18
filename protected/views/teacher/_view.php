<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TID), array('view', 'id'=>$data->TID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Firstname')); ?>:</b>
	<?php echo CHtml::encode($data->Firstname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Midname')); ?>:</b>
	<?php echo CHtml::encode($data->Midname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Lastname')); ?>:</b>
	<?php echo CHtml::encode($data->Lastname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Address')); ?>:</b>
	<?php echo CHtml::encode($data->Address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Bdate')); ?>:</b>
	<?php echo CHtml::encode($data->Bdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Status')); ?>:</b>
	<?php echo CHtml::encode($data->Status); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Level')); ?>:</b>
	<?php echo CHtml::encode($data->Level); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubjectArea')); ?>:</b>
	<?php echo CHtml::encode($data->SubjectArea); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inactiveDate')); ?>:</b>
	<?php echo CHtml::encode($data->inactiveDate); ?>
	<br />
	*/ ?>
</div>