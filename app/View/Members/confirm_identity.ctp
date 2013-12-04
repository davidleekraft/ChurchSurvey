<?php
	foreach($members as $memberKey => $member)
	{
		// Creates an information string for each of the members
		// TODO: Make this only display content from database that exists
		//       for that member
		$options = array();
		$memberString = "<b>Name:</b> {$member['Member']['FName']} {$member['Member']['LName']}<br /><b>Email</b>: {$member['Member']['Email']}<br /><b>Address:</b> {$member['Member']['Address']}";
		$options[$member['Member']['MemberID']] = $memberString;
		echo $this->Form->create('Member');
		echo $this->Form->input('Member.MemberID', array('value' => $member['Member']['MemberID']));
		echo $memberString;
		echo $this->Form->end('This is me'), '<br />';
	}
?>
<br />
<h4> Don't see your name listed? <?php echo $this->Html->link("Click Here", array('controller'=>'members', 'action'=>'add'));?> to create a new member account. </h4>