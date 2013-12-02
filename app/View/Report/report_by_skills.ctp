<?php 
echo $skills;
echo $this->Form->create('generateMePdf', array('type' => 'get', 'url' => 'view_skills_pdf'));
		echo $this->Form->input('gift', array('type' => 'hidden','default' => $gift));
		echo $this->Form->input('comp', array('type' => 'hidden','default' => $comp));
		echo $this->Form->input('other', array('type' => 'hidden','default' => $other));
		echo $this->Form->input('cons', array('type' => 'hidden','default' => $cons));
		echo $this->Form->input('uptd', array('type' => 'hidden','default' => $uptd));
		echo $this->Form->end('Generate this report in PDF');
foreach($members as $member): ?>
<h4>Report for: <?php echo $member['Member']['FName'] . " " . $member['Member']['LName'];?></h4>
<table>
<tr>
	<th>Contact info</th>
	<th>God's Gifts</th>
	<th>Computer Skills</th>
	<th>Other</th>
	<th>Alter Date</th>
</tr>
<tr>
<?php 
	echo "<td style='vertical-align:top'>";
		echo "<table style='width:auto'>";
		echo "<tr>";
			echo "<th style='vertical-align:center'>";
				echo  $member['Member']['FName'] . " " . $member['Member']['LName'];
			echo "</th>";
			echo "<th style='vertical-align:center'>";
				echo  $member['Status']['Type'];
				echo "</th>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>home phone</td>" . "<td>" . $member['Member']['HomePhone'] . "</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>cell phone</td>" . "<td>" . $member['Member']['CellPhone'] . "</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>work phone</td>" . "<td>" . $member['Member']['WorkPhone'] . "</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>email</td>" . "<td><a href='mailto:" . $member['Member']['Email'] . "'>" . $member['Member']['Email'] . "</a></td>";
		echo "</tr>";
		echo "</table>";
	echo "</td>";
	$i = 0;
	$choicesInSection = 0;
	echo "<td style='vertical-align:top'>";
	foreach ($choices as $choice)
	{
		
		if($choice['Choice']['SectionID'] == 1  && $choice['Member']['MemberID'] == $member['Member']['MemberID'])
		{
			if(in_array($choice['Choice']['ChoiceID'], $chosen_skills))
				echo  '<span style="color:red">' . $choice['Choice']['Text'] . "</span><br />";
			else
				echo  "" . $choice['Choice']['Text'] . "<br />";
		}
		
		$i++;
	}
	echo "</td>";
	echo "<td style='vertical-align:top'>";
	foreach ($choices as $choice)
	{
		if($choice['Choice']['SectionID'] == 2 && $choice['Member']['MemberID'] == $member['Member']['MemberID'])
		{
			if(in_array($choice['Choice']['ChoiceID'], $chosen_skills))
				echo  '<span style="color:red">' . $choice['Choice']['Text'] . "</span><br />";
			else
				echo  "" . $choice['Choice']['Text'] . "<br />";
		}
		//echo $choice['Choice']['Tag'] . " " . $choice['Choice']['Text'] . "<br />";
		//print_r($choice);
		
		$i++;
	}
	echo "</td>";
	echo "<td style='vertical-align:top'>";
	foreach ($choices as $choice)
	{
		if($choice['Choice']['SectionID'] != 1 && $choice['Choice']['SectionID'] != 2 && $choice['Member']['MemberID'] == $member['Member']['MemberID'])
		{
			if(in_array($choice['Choice']['ChoiceID'], $chosen_skills))
				echo  '<span style="color:red">' . $choice['Choice']['Text'] . "</span><br />";
			else
				echo  "" . $choice['Choice']['Text'] . "<br />";
		}
		//echo $choice['Choice']['Tag'] . " " . $choice['Choice']['Text'] . "<br />";
		//print_r($choice);
		
		$i++;
	}
	echo "</td>";
	echo "<td style='vertical-align:top'>" . $member['Member']['SurveyUpdated'] . "</td>";
	?>
</tr>
</table>
<?php endforeach;?>