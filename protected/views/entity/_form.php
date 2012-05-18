<style type="text/css">
	.leftAttContainer {
		-moz-border-radius: 5px 5px 5px 5px;
		-webkit-border-radius: 5px 5px 5px 5px;
		padding: 7px;
		background: -moz-linear-gradient(center bottom, #26b1b1 100%,#26b1b1 100%);
		background: -webkit-gradient(linear, left bottom, left top, color-stop(1, #26b1b1),color-stop(1, #26b1b1));
		/*overflow: scroll;*/
		/*overflow: visible/hidden/scroll/auto;*/
		width:317px;
		overflow-y: scroll;
    	max-height:360px;

	}
	.leftAttributes {
		width: 300px;
	}
	.addbt {
		margin-top: 50px;
	}
	.removebt {
		margin-top: 30px;
	}

	.thisbg1 {
		background-color: blue;
	}
	.thisbg2 {
		background-color: red;
	}
	.thisbg3 {
		background-color: yellow;
		margin-left: -150px;
	}

</style>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'entity-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>
	<div class="alert alert-error">
		<p class="note">Fields with <span class="required">*</span> are required.</p>
	</div>

	<div class="row">
		<?php echo $form->textFieldRow($model,'entity_name', 
									   array(
										'style'		  =>'width: 50%;', 
										'placeHolder' => 'name of the entity'
										)); 
		?>
	</div>

	<div class="row">
		<?php echo $form->textAreaRow($model,'description',
									  array(
										'rows'		  =>5,
										'style'	      =>'width: 50%;',
										'placeHolder' => 'entity description'
										)); 
		?>
	</div>

	<div class='row'>
		<?php
			if(isset($model->id)) {
			$con = 'entity_id ='.$model->id;
			$criteria = new CDbCriteria;
			$criteria->condition=$con;
			echo $form->dropDownListRow($model, 'form_id', Form::conditionItems('code', $criteria), array('class'=>'leftAttributes', 'prompt' => '-SELECT-Default-Form',));
			}
		?>
	</div>

	<div class="form-actions">
		<?php 
		$lb = 'Create Entity?';
			if(isset($model->id)) {
				$lb='Save changes?';
			}
		?>
		<?php $this->widget('bootstrap.widgets.BootButton', 
			  array(
				'label'		=>$lb, 
				'buttonType'=>'submit', 
				'type'		=>'primary', 
				'icon'		=>'ok white',
				)); 
		?>
		<?php $this->widget('bootstrap.widgets.BootButton', 
			  array(
			   'buttonType'	=>'reset',
			   'icon'		=>'remove', 
			   'label'		=>'Cancel',
			   )); 
		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->



