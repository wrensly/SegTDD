<?php /**
 *  @todo make the selected options from each dropdown list disappear from other dropdowns
 */ ?>
<div class="panel">
    <table class="templateFrame grid table">
        <thead class="templateHead">
            <tr>
            	<td colspan="2">Child Fields</td>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="2">
                    <?php $this->widget('bootstrap.widgets.BootButton', array(
                        'label' => 'Add a Child Field',
                        'type' => 'warning',
                        'icon' => 'plus white',
                        'htmlOptions' => array(
                                'class' => 'add',
                            ),
                    )); ?>
                    <textarea class="template">
                        <tr class="templateContent">
                            <td>
                            	<?php echo CHtml::dropDownList('ConstraintCompound[child][{0}]',null,Field::items('fieldname'),array(
						 			'prompt' => '-SELECT-',)); ?>
                            </td>
                            <td>
                                <input type="hidden" class="rowIndex" value="{0}" />
                                <?php $this->widget('bootstrap.widgets.BootButton', array(
                                    'label' => '',
                                    'type' => 'danger',
                                    'icon' => 'minus white',
                                    'htmlOptions' => array(
                                            'class' => 'remove',
                                        ),
                                )); ?>
                            </td>
                        </tr>
                    </textarea>
                </td>
            </tr>
        </tfoot>
        <tbody class="templateTarget" id="childFieldsForm">
        <?php
            $i = 0;
            $childFields = $fieldModel->fields;
            foreach ($childFields as $childField){
        ?>
            <tr class="templateContent">
                <td>
                	<?php echo CHtml::dropDownList('ConstraintCompound[child][$i]',$childField->id,Field::items('fieldname'),array(
						'prompt' => '-SELECT-',)); ?>
                </td>
                <td>
                    <input type="hidden" class="rowIndex" value="<?php echo $i; ?>" />
                    <?php $this->widget('bootstrap.widgets.BootButton', array(
                        'label' => '',
                        'type' => 'danger',
                        'icon' => 'minus white',
                        'htmlOptions' => array(
                                'class' => 'remove',
                            ),
                    )); ?>
                </td>
            </tr>
        <?php
            $i++;
            } 
            if($childFields == null){
        ?>
            <tr class="templateContent">
                <td>
                    <?php echo CHtml::dropDownList('ConstraintCompound[child][$i]',null,Field::items('fieldname'),array(
                        'prompt' => '-SELECT-',)); ?>
                </td>
                <td>
                    <input type="hidden" class="rowIndex" value="<?php echo $i; ?>" />
                    <?php $this->widget('bootstrap.widgets.BootButton', array(
                        'label' => '',
                        'type' => 'danger',
                        'icon' => 'minus white',
                        'htmlOptions' => array(
                                'class' => 'remove',
                            ),
                    )); ?>
                </td>
            </tr>
        <?php 
            }
        ?>
        </tbody>
    </table>
</div><!--panel-->