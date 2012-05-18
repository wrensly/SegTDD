<?php
Yii::app()->clientScript->registerScript('load-form-as-JSON', "
    $('#modalSave').click(function(){
        var fields = $('#optionsForm').serializeOptionsJSON();
        $('#ConstraintEnum_picklist').val($.toJSON(fields));
        var select = document.getElementById('ConstraintEnum_default_value');
        var selected = select.options[select.selectedIndex].value;
        var options = select.options;
        $('option',select).remove();
        $.each(fields,function(name,value){
            options[options.length] = new Option(value,name);
        });
        $('#ConstraintEnum_default_value').val(selected);
    });
");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/serializeJSON.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.json-2.3.js');
?>
<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'optionsListModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Modify Options</h3>
</div>
 
<div class="modal-body">
    <?php echo $form->hiddenField($constraintEnumModel,'picklist','',array('id'=>'picklist')); ?>
    <div class="panel">
        <table class="templateFrame grid table">
            <thead class="templateHead">
                <tr>
                    <td>Value</td>
                    <td>Label</td>
                    <td></td>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="3">
                        <?php $this->widget('bootstrap.widgets.BootButton', array(
                            'label' => 'Add Option',
                            'type'  => 'warning',
                            'icon'  => 'plus white',
                            'htmlOptions'   => array(
                                    'class' => 'add',
                                ),
                        )); ?>
                        <textarea class="template">
                            <tr class="templateContent">
                                <td><?php echo CHtml::textField('picklist[{0}][value]'); ?></td>
                                <td><?php echo CHtml::textField('picklist[{0}][label]'); ?></td>
                                <td>
                                    <input type="hidden" class="rowIndex" value="{0}" />
                                    <?php $this->widget('bootstrap.widgets.BootButton', array(
                                        'label' => '',
                                        'type'  => 'danger',
                                        'icon'  => 'minus white',
                                        'htmlOptions'   => array(
                                                'class' => 'remove',
                                            ),
                                    )); ?>
                                </td>
                            </tr>
                        </textarea>
                    </td>
                </tr>
            </tfoot>
            <tbody class="templateTarget" id="optionsForm">
                <?php
                    $options = CJSON::decode($constraintEnumModel->picklist);
                ?>
                <?php 
                $i = 0;
                if ($options == null){
                    $options=array('');
                } else {
                    foreach($options as $value=>$label){ ?>
                        <tr class="templateContent">
                            <td><?php echo CHtml::textField('picklist[$i][value]',$value); ?></td>
                            <td><?php echo CHtml::textField('picklist[$i][label]',$label); ?></td>
                            <td>
                                <input type="hidden" class="rowIndex" value="$i" />
                                <?php $this->widget('bootstrap.widgets.BootButton', array(
                                    'label' => '',
                                    'type'  => 'danger',
                                    'icon'  => 'minus white',
                                    'htmlOptions'   => array(
                                            'class' => 'remove',
                                        ),
                                )); ?>
                            </td>
                        </tr>
                <?php
                    }
                    $i++;
                } ?>
            </tbody>
        </table>
    </div><!--panel-->
</div>
 
<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'type' =>'primary',
        'label'=>'Save changes',
        'url'  =>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal', 'id' => 'modalSave'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>
<?php
// Setting the default values
defineDefaultsof($constraintEnumModel,array(
    'minselect' => 1,
    'maxselect' => 1,
));
?>

<?php echo $form->textFieldRow($constraintEnumModel,'minselect'); ?>
<?php echo $form->textFieldRow($constraintEnumModel,'maxselect'); ?>

<div class="control-group">
	<label class="control-label">Options</label>
	<div class="controls">
		<?php echo CHtml::link('Modify Options','#optionsListModal', array('class'=>'btn btn-warning', 'data-toggle'=>'modal')); ?>	
	</div>
</div>

<?php echo $form->dropDownListRow($constraintEnumModel,'default_value',$options,array(
      'prompt' => '-SELECT-',
)); ?>