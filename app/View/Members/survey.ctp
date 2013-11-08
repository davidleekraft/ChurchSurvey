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
<p> Select All That Apply </p>

<form>

<?php

	foreach($sections as $sectionKey => $section)
	{
		
		?><div class="panelcollapsed"><?php
		echo "<h4>".$section['Section']['Tag']."</h4>";
		
		
		$sectionIdent = $section['Section']['SectionID'];
		
		
		foreach($choices as $choiceKey => $choice)
		{
			$choiceIdent = $choice['Choice']['SectionID'];
			
			if($sectionIdent == $choiceIdent)
			{
				
				echo "<input type='checkbox' name='".$sectionIdent."' value='".$choice['Choice']['Text']."' />";
				echo " ".$choice['Choice']['Text'];
				
				
				echo "<br />";
			}
			
		}
		?><div class="clearboth"></div></div><?php
		
		
		
		
		echo "<br /><br />";
	
	}
?>

<input type="submit" value="Submit" />
<input type="reset" value="Clear" />

</form>