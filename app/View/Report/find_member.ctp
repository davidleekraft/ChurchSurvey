<div style = "width:600px">
	<?php 
	$i = 1;
	foreach ($members as $member)
	{
		$user_names[$member['Member']['MemberID'] . '--' . $member['Member']['FName'] . '--' . 
					$member['Member']['LName'] . '--' . $member['Member']['HomePhone']. '--' . 
					$member['Member']['CellPhone'] . '--' . $member['Member']['WorkPhone'] . '--' . 
					$member['Member']['Email']] = $member['Member']['FName'] . " " . $member['Member']['LName'];
		
		$membersFNames[$i] = $member['Member']['FName'];
		
		$i++;
	}?>

<script>
function setFields(sel) {
	var value = sel.options[sel.selectedIndex].value;
	var member_info = value.split('--');
	document.getElementById('FirstName').value = member_info[1];
	document.getElementById('LastName').value = member_info[2];
	document.getElementById('HomePhone').value = member_info[3];
	document.getElementById('CellPhone').value = member_info[4];
	document.getElementById('WorkPhone').value = member_info[5];
	document.getElementById('Email').value = member_info[6];
}
</script>
	<?php
	
		echo $this->Form->create('memberForm', array('type' => 'get',
													 'url' => 'individual_report'));
		echo $this->Form->input('selected_person', array('options' =>$user_names,
														 'size' => 20,
														 'style' => 'width:230px;font-size:medium',
														 'onchange' => 'setFields(this)',
														 'label' => false));
		echo $this->Form->end('Get Skills Report');
	?>
	<div style="position:relative;left:400px;top: -400px">
		<?php echo $this->Form->input('FirstName', array('readonly' =>'readonly',
														 'style' =>'margin-left:15px'))?>
		<br />
		<?php echo $this->Form->input('LastName', array('readonly' =>'readonly',
														 'style' =>'margin-left:17px'));?>
		<br />
		<?php echo $this->Form->input('HomePhone', array('readonly' =>'readonly',
														 'style' =>'margin-left:4px'));?>
		<br />
		<?php echo $this->Form->input('CellPhone', array('readonly' =>'readonly',
														 'style' =>'margin-left:15px'));?>
		<br />
		<?php echo $this->Form->input('WorkPhone', array('readonly' =>'readonly',
														 'style' =>'margin-left:8px' ));?>
		<br />
		<?php echo $this->Form->input('Email', array('readonly' =>'readonly',
													 'style' =>'width:200px;margin-left:45px' ));?>
	</div>
</div>
