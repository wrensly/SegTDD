<?php
$this->breadcrumbs=array(
	'Forms',
);

$this->menu=array(
	array('label'=>'Create Form', 'url'=>array('create')),
	array('label'=>'Manage Form', 'url'=>array('index')),
);

$this->content_title = "Form Editor";

Yii::app()->CodeMirror->load('Form_layout',array(
	'lineNumbers' => true,
	'mode' 	  => 'xml',
	'tabSize' => 2,
	'theme'   => 'ambiance',
));

$form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'   =>'field-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>true,
));
?>
<div class="row">
	<div class="span9">
	<div class="row editor-toolbar">
		<div class="span9">
			<div class="pull-right">
				<?php $this->widget('bootstrap.widgets.BootButton', array(
					'buttonType'=>'submit',
					'type'		=>'primary',
					'icon'		=>'ok white',
					'label'		=>'Save',
					'size'		=>'mini',
				)); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span9">
			<?php
			echo $form->textArea($model->form,'layout',array(
		        'rows'=>6,
		        'cols'=>200,
		        ));   
			?>
		</div>
	</div>
</div>
	<div class="span3">
		<h3>Available Fields</h3>
		<?php echo Chtml::dropDownList('fields',null,Field::items("fieldname"),array(
			'multiple'=>'multiple',
		)); ?>
	</div>
</div>
	
<?php $this->endWidget(); ?>
<!-- form -->