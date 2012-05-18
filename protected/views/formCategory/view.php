<?php
$this->breadcrumbs=array(
	'Form Categories'=>array('index'),
	$model->form->name,
);

$this->menu=array(
	array('label'=>'Create Form', 'url'=>array('create')),
	array('label'=>'Update Form', 'url'=> Yii::app()->createUrl('formCategory/', array('update'=> $model->id))),
//	array('label'=>'Delete FormCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Form', 'url'=>array('index')),
);

$this->content_title = 'View ' . $model->form->code;
?>
<div class="row">
	<div class="span6">
		<h3>Properties</h3>
		<?php $this->widget('bootstrap.widgets.BootDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name' => 'code', 'value' => $model->form->code),
				array('name' => 'name', 'value' => $model->form->name),
				array('name' => 'description', 'value' => $model->form->description),
				array('name' => 'status', 'value' => Yii::app()->format->boolean($model->form->status)),
				
			),
		)); ?>
	</div>
	<div class="span6">
		<h3>Others</h3>
		<?php $this->widget('bootstrap.widgets.BootDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name' => 'category_name', 'value' => $model->category->category_name),
				array(
					'label'=> 'Entity Association',
					'type' => 'raw',
			        'value'=> CHtml::link(CHtml::encode($entity->entity_name),
			        	array('entity/view','id'=>$entity->id)),
		        ),
				array('name' => 'tags', 'value' => implode(',', $tags)),
				array(
		            'name' =>'layout',
		            'type' => 'raw',
		            'value'=> CHtml::link('View Code','#viewCodeModal', array('class'=>'btn btn-warning btn-mini', 'data-toggle'=>'modal')),
		        ),
			),
		)); ?>
	</div>
</div>

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'viewCodeModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>View Layout Code</h3>
</div>
 
<div class="modal-body">
    <div class="code-display well">
        <?php $this->beginWidget('CTextHighlighter',array(
            'language'=>'xml',
            'showLineNumbers' => true,
        )); ?>
<?php echo $model->form->layout; ?>
        <?php $this->endWidget(); ?>
    </div>
</div>
 
<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Close',
        'url'  =>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>
