
<h1>Report for: <?php echo $members[0]['Member']['FName'] . " " . $members[0]['Member']['LName'];?></h1>
<table>
<tr>
	<th>Contact info</th>
	<th>God's Gifts</th>
	<th>Computer Skills</th>
	<th>Other</th>
</tr>
<tr>
<?php 
	echo "<td style='vertical-align:top'>";
		echo "<table style='width:auto'>";
		echo "<tr>";
			echo "<th style='vertical-align:center'>";
				echo  $members[0]['Member']['FName'] . " " . $members[0]['Member']['LName'];
			echo "</th>";
			echo "<th style='vertical-align:center'>";
				echo  $members[0]['Status']['Type'];
				echo "</th>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>home phone</td>" . "<td>" . $members[0]['Member']['HomePhone'] . "</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>cell phone</td>" . "<td>" . $members[0]['Member']['CellPhone'] . "</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>work phone</td>" . "<td>" . $members[0]['Member']['WorkPhone'] . "</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>email</td>" . "<td><a href='mailto:" . $members[0]['Member']['Email'] . "'>" . $members[0]['Member']['Email'] . "</a></td>";
		echo "</tr>";
		echo "</table>";
	echo "</td>";
	$i = 0;
	$choicesInSection = 0;
	echo "<td style='vertical-align:top'>";
	foreach ($choices as $choice)
	{
		
		if($choice['Choice']['SectionID'] == 1)
		{
			echo  " " . $choice['Choice']['Text'] . "<br />";
		}
		
		$i++;
	}
	echo "</td>";
	echo "<td style='vertical-align:top'>";
	foreach ($choices as $choice)
	{
		if($choice['Choice']['SectionID'] == 2)
		{
			echo  " " . $choice['Choice']['Text'] . "<br />";
		}
		//echo $choice['Choice']['Tag'] . " " . $choice['Choice']['Text'] . "<br />";
		//print_r($choice);
		
		$i++;
	}
	echo "</td>";
	echo "<td style='vertical-align:top'>";
	foreach ($choices as $choice)
	{
		if($choice['Choice']['SectionID'] != 1 && $choice['Choice']['SectionID'] != 2)
		{
			echo  " " . $choice['Choice']['Text'] . "<br />";
		}
		//echo $choice['Choice']['Tag'] . " " . $choice['Choice']['Text'] . "<br />";
		//print_r($choice);
		
		$i++;
	}
	echo "</td>";
	if ($i == 0)
	{
		echo '<h3 style = "color:red">This person hasn\'t passed the survey yet...</h3>';
	}
	else
	{
		echo "<br/>";
		echo $this->Form->create('generateMePdf', array('type' => 'get', 'url' => 'viewPdf'));
		echo $this->Form->input('selected_person', array('type' => 'hidden','default' => $members[0]['Member']['MemberID']));
		echo $this->Form->end('Generate this report in PDF');
	}
?>
</tr>
</table>