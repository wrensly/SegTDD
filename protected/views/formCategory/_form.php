<?php 
$cs=Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->baseUrl.'/css/jquery.tagsinput.css');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.tagsinput.js');

$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'verticalForm',
    'type' => 'horizontal',
)); ?>
	<div class="alert alert-error">
		<p class="note">Fields with <span class="required">*</span> are required.</p>
	</div>
	
	<div class="row">
		<div class="span6">
			<fieldset>
	 			<legend>Properties</legend>
				<?php echo $form->textFieldRow($model,'code',array('maxlength'=>50,)); ?>
				<?php echo $form->textFieldRow($model,'name',array('maxlength'=>50,)); ?>
				<?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->checkBoxRow($model,'status', array('checked' => true)); ?>
				
			</fieldset>
		</div>
		<div class="span6">
			<fieldset>
				<legend>Others</legend>
				<?php echo $form->dropDownListRow($model,'entity_id', CHtml::listData(Entity::model()->findAll(), 'id', 'entity_name')); ?>
				<div class="control-group">
					<?php echo $form->labelEx($formCategory,'Category',array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->dropDownList($formCategory,'category_id',CHtml::listData(Category::model()->findAll(), 'id', 'category_name')); ?>
						<?php echo $form->error($formCategory,'category_id'); ?>
				    </div>
				</div>
				<div class="control-group">
					<?php echo $form->labelEx($tags,'tag_name',array('class'=>'control-label')); ?>
					<div class="controls">
						<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
							
							'id' => 'add',
						    'name'=>'Tag[tag_name]',
						   
						   	'source'=>$suggest,
						    // additional javascript options for the autocomplete plugin
						   	'options'=>array(
						        'minLength'=>'2',
						    	),
						    'htmlOptions'=>array(
						        'style'=>'height:20px;',
						   		),
							));
						?>
						<?php echo CHtml::button('Add', array('onClick' => 'addTag()')) . '<br><br>';?>
						<?php echo $form->textField($tags,'tag_name',array('id' => 'tag', 'disabled' => 'true')); ?>
 						
					</div>
				</div>
			</fieldset>
		</div>
	</div>
	<div class="form-actions">
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Submit')); ?>
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Reset')); ?>
	</div>

<?php $this->endWidget(); ?>