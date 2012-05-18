<?php
$this->breadcrumbs=array(
	'Forms',
);

$this->menu=array(
	array('label'=>'Create Form', 'url'=>array('create')),
	array('label'=>'Manage Form', 'url'=>array('index')),
);

$this->content_title = "Form Editor";

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/formEditor.js');
?>
<div class="row">
	<div class="span9">
		<div class="row">
			<div class="span9">
				<?php
					$form = $this->widget('zii.widgets.jui.CJuiSortable',array(
						'items' 	  => array(),
						'htmlOptions' => array(
							'class' => 'connectedSortable'
						),
						'options' => array(
							'placeholder' => 'fieldsList-placeholder',
							'connectWith' => '.connectedSortable',
							'revert' => true,
						),
					));
				?>
				<?php
					$this->widget('bootstrap.widgets.BootTabbable', array(
				    	'type'     =>'tabs', // 'tabs' or 'pills'
				    	'placement'=>'left', // 'above', 'right', 'below' or 'left'
				    	'htmlOptions' => array('id' => 'formEditor'),
					));
				?>
				
			</div>
		</div>
	</div>
	<div class="span3">
		<div class="well">
			<?php $this->widget('bootstrap.widgets.BootButton', array(
				'buttonType'=>'button',
				'type'	  	=>'warning',
				'icon'		=>'plus white',
				'label'		=>'Add Section',
				'size'		=>'mini',
				'htmlOptions'=>array(
					'id' => 'AddSectionButton',
				),
			)); ?>
			<?php $this->widget('bootstrap.widgets.BootButton', array(
				'buttonType'=>'button',
				'type'		=>'primary',
				'icon'		=>'ok white',
				'label'		=>'Save',
				'size'		=>'mini',
			)); ?>
		</div>
		<h3>Available Fields</h3>
		<?php
			$this->widget('zii.widgets.jui.CJuiSortable',array(
				'items' => Field::items("fieldname"),
				'htmlOptions' => array(
					'class' => 'connectedSortable'
				),
				'options' => array(
					'placeholder' => 'fieldsList-placeholder',
					'connectWith' => '.connectedSortable',
					'containment' => 'window',
					'revert' => true,
				),
			));
		?>
	</div>
</div>

<?php
	function unorderedList($array,$htmlOptions=null){
		$html = "<ul>";
		if ($htmlOptions !== null){
			$options = "";
			foreach ($htmlOptions as $property => $value){
				$options .= "{$property}='{$value}'";
			}
			$html = "<ul {$options}>";
		}
		foreach($array as $key=>$value){
			$html .= "<li data-key='{$key}'>{$value}</li>".PHP_EOL;
		}
		return $html."</ul>";
	}
?>
<!-- form -->
<?php
		$form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
			'id'   =>'newSectionForm',
			'type' => 'inline',
			'htmlOptions' => array(
				'class'=>"well",
				'style'=>"display:none"),
		));
		echo CHtml::textField('newSection');
		$this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'		=>'primary',
			'icon'		=>'ok white',
			'label'		=>'Add',
			'htmlOptions' => array('id' => 'submitSection'),
		));
		$this->endWidget();
	?>