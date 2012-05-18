<?php
$this->breadcrumbs=array(
	'Categories',
);

$this->menu=array(
	array(
		'label'		 =>'Create Category',
		'url'		 =>'#myModal',
		'htmlOptions'=>array('data-toggle'=>'modal'),
	),
);

$this->content_title = "List of Categories";

$this->search = array(
	'simple'  => true,
	'advanced'=> false,
	'model'   => $model,
);
?>

<?php 
$template = "
{items}
<div class='row'>
	<div class='span6'>{summary}</div>
	<div class='span6'>{pager}</div>
</div>";

$this->widget('bootstrap.widgets.BootGridView', array(
	'id'			=>'field-grid',
	'type'			=>'striped',
    'dataProvider'  =>$category->search(),
	'template'		=>$template,
	'pagerCssClass' =>'pagination pull-right',
	'columns'		=>array(
						'category_name',
						'description',
							array(
            				'class'		 =>'bootstrap.widgets.BootButtonColumn',
            				'htmlOptions'=>array('style'=>'width: 50px'),
        ),
	)
)); 
?>

<?php $this->beginWidget('bootstrap.widgets.BootModal', array(
	'id'		  =>'myModal',
	'htmlOptions' => array('style'=>'display:none'))); ?>
 
<div class="modal-header">

    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Create Category</h3>

</div>

<div class="modal-body">

    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    
</div>

<?php $this->endWidget(); ?>