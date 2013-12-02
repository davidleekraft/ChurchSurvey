<div class="members form">
<?php 
echo $this->Session->flash('auth');
if(!isset($members)) {
	echo $this->Form->create('Member'); ?>
	    <fieldset>
	        <legend><?php echo __('Please enter your name'); ?></legend>
	        <?php echo $this->Form->input('FName');?>
	        <?php echo $this->Form->input('LName');?>
	    </fieldset>
	<?php 
	echo $this->Form->end('Submit');

} ?>
</div>