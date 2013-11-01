
<?php echo $this->fetch('title');?>
<?php echo $this->start('menu'); ?>	
<!-- The 'menu' section contains the links for all the webpages that
	 admin are allowed to access -->
<li class="page_item page-item-#">
	<?php echo $this->Html->link('Edit Sections', 'sections')?>
</li>
<?php echo $this->end('menu');		?>	

<?php echo $this->fetch('content'); ?>
				