<?php $this->widget('bootstrap.widgets.BootDetailView', array(
			'data'=>$constraintNumericModel,
			'attributes'=>array(
				'decimaldigit',
				'minvalue',
				'maxvalue',
				'default_value',
			),
		)
); ?>