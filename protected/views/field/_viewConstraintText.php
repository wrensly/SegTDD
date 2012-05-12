<?php $this->widget('bootstrap.widgets.BootDetailView', array(
			'data'=>$constraintTextModel,
			'attributes'=>array(
				'minlength',
				'maxlength',
				'encoding',
				'format',
				'default_value',
			),
		)
); ?>