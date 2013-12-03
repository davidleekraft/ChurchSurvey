
<?php echo $this->fetch('title');?>
<?php echo $this->start('menu'); ?>	
<!-- The 'menu' section contains the links for all the webpages that
	 admin are allowed to access -->
<li class="page_item page-item-#">
	<?php echo $this->Html->link('Edit Sections', 'sections')?>
</li>
<li class="page_item page-item-#">
	<?php echo $this->Html->link('Reports', array('controller' => 'report', 'action'=> 'skillsReport'))?>
</li>
<li class="page_item page-item-#">
	<?php echo $this->Html->link('Printable Survey', 'printable')?>
</li>
<li class="page_item page-item-#">
	<?php echo $this->Html->link('Purge Responses', 'purgeAll')?>
</li>
<li class="page_item page-item-#">
	<?php echo $this->Html->link('Log out', array('controller' => 'users', 'action'=> 'logout'))?>
</li>
<?php echo $this->end('menu');		?>	

<?php echo $this->fetch('content'); ?>
				