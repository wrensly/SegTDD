<?php $this->widget('bootstrap.widgets.BootDetailView', array(
			'data'=>$constraintDatetimeModel,
			'attributes'=>array(
				'format',
				'timezone',
				'default_value',
			),
		)
); ?>