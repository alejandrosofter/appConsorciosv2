<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
			<?php echo $content; ?>
	</div>
	
	<div class="span2">
		<div class="well">
		<?php
			
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'nav nav-list'),
			));
	
		?>
		
	</div>
	</div>
</div>
<?php $this->endContent(); ?>