<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
	<div class="span9">
			<?php echo $content; ?>
	</div>
	<div class="span3 last">
	<?php $this->widget('bootstrap.widgets.BootMenu', array(
		'type' => 'list',
		'items' => $this->menu,
	));
	?>
	<!--
	<div id="sidebar">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Operations',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
		?>
		</div><!-- sidebar -->
	</div>
</div>
<?php $this->endContent(); ?>