<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
	<div class="span12">
		<div class="page-header">
			<div class="row">
				<div class="span6">
					<h1><?php echo $this->content_title; ?></h1>
				</div>
				<div class="span6">
					<?php if( count($this->menu) !== 0 ): ?>
						<?php $this->widget('bootstrap.widgets.BootButtonGroup', array(
							'type' => 'success',
							'buttons' => array(
								array( 'label' => 'Options', 'items' => $this->menu, ),
							),
							'htmlOptions' => array('class'=>'pull-right'),
						)); ?>
					<?php endif ?><!-- breadcrumbs -->
				</div>
			</div>
		</div>	
	</div>
</div>
<div class="row">
	<div class="span12"><?php echo $content; ?></div>
</div>
<?php $this->endContent(); ?>