<?php $this->beginContent('//layouts/main'); ?>
<div class="page-header">
	<div class="row">
		<div class="span12">
		<div class="pull-left">
			<h1><?php echo $this->content_title; ?></h1>
		</div>
		<div class="pull-right">
			<?php 
				if( count($this->menu) != 0 ){
					if(count($this->menu) == 1){
						$item = $this->menu[0];
						$item['type'] = 'success';
						$item['htmlOptions']['class']='pull-right';
						$this->widget('bootstrap.widgets.BootButton',$item);
					} else {
						$this->widget('bootstrap.widgets.BootButtonGroup', array(
							'type' => 'success',
							'buttons' => array(
								array( 'label' => 'Options', 'items' => $this->menu, ),
							),
							'htmlOptions' => array('class'=>'pull-right'),
						)); 
					}
				}
			if(count($this->search)>0)
				$this->renderPartial('_search',array(
					'model'=>$this->search['model'],
				));
			?>
		</div>
		</div>
	</div>
</div>
<?php 
if((count($this->search)>0)&&($this->search['advanced'])){
	$this->renderPartial('_advancedSearch',array(
		'model'=>$this->search['model'],
	));
}
?>
<?php echo $content; ?>
<?php $this->endContent(); ?>