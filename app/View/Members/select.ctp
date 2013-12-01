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

} else { ?>
<p> More than one user was found with this name. Please select yourself from the list below.</p>
<p> If you are not on this list, please create a new account here</p>
<?php
	$options = array();
	foreach($members as $memberKey => $member)
	{
		
		// Creates an information string for each of the members
		// TODO: Make this only display content from database that exists
		//       for that member
		$memberString = "<b>Name:</b> {$member['Member']['FName']} {$member['Member']['LName']}<br /><b>Email</b>: {$member['Member']['Email']}<br /><b>Address:</b> {$member['Member']['Address']}";
		$options[$member['Member']['MemberID']] = $memberString;
	}
	echo $this->Form->create('Member');
	echo $this->Form->radio('Member.MemberID', $options, array('separator' => '<br /><hr><br />'));
	echo $this->Form->end('Submit');

 } ?>
</div>