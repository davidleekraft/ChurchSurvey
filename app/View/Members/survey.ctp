<div class="sections">

<?php
/*
 * TODO: Implement survey
 */
 
foreach($members as $memberKey => $member)
{

	if($member['Member']['MemberID'] == $this->Session->read('Member.MemberID'))
	{
		$memberName = $member['Member']['FName'];
	}
	
}
 if(!isset($memberName))
	{
		header("Location: ./select");
		die();
	}

 
?>
<h2> Welcome, <?php echo $memberName; ?>! </h2>
<h2> SURVEY </h2>
<p> Click On Categories To Expand, Then Select All That Apply </p>

<form method="POST">

<?php

	foreach($sections as $sectionKey => $section)
	{
		
		?><div class="panelcollapsed"><details><?php
		echo "<summary style='font-size: 1.3em'>".$section['Section']['Tag']."</summary><p>";
		
		
		$sectionIdent = $section['Section']['SectionID'];
		
		foreach($choices as $choiceKey => $choice)
		{
			$choiceIdent = $choice['Choice']['SectionID'];
			
			if($sectionIdent == $choiceIdent)
			{
				
				echo "<input type='checkbox' name='survey[]' value='".$choice['Choice']['ChoiceID']."' />";
				echo " ".$choice['Choice']['Text'];
				
				
				echo "<br />";
			}
			
		}
		?></p><div class="clearboth"></div></div><?php
		
		
		
		
		echo "<br />";
	
	}
?>

<input type="submit" value="Submit" />
<input type="reset" value="Clear" />

</form>

</div>