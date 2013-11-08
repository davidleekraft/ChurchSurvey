<?php
/*
 * TODO: Implement survey
 */
 
<<<<<<< HEAD
foreach($members as $memberKey => $member)
{
	if($member['Member']['MemberID'] == $this->Session->read('Member.MemberID'))
	{
		$memberName = $member['Member']['FName'];
	}
}
 
=======
>>>>>>> 443b293f0f1f2ab9632b4118bbc32e773a2e3463
?>
<h2> Welcome, <?php echo $memberName; ?>! </h2>
<h2> SURVEY </h2>
<p> Select All That Apply </p>

<<<<<<< HEAD
=======
<h2> SURVEY </h2>
<p> Select All That Apply </p>

>>>>>>> 443b293f0f1f2ab9632b4118bbc32e773a2e3463
<form>

<?php

<<<<<<< HEAD
	foreach($sections as $sectionKey => $section)
	{
		
		?><div class="panelcollapsed"><?php
=======
	
	foreach($sections as $sectionKey => $section)
	{
>>>>>>> 443b293f0f1f2ab9632b4118bbc32e773a2e3463
		echo "<h4>".$section['Section']['Tag']."</h4>";
		
		
		$sectionIdent = $section['Section']['SectionID'];
		
<<<<<<< HEAD
		
=======
>>>>>>> 443b293f0f1f2ab9632b4118bbc32e773a2e3463
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
<<<<<<< HEAD
		?><div class="clearboth"></div></div><?php
		
		
		
=======
>>>>>>> 443b293f0f1f2ab9632b4118bbc32e773a2e3463
		
		echo "<br /><br />";
	
	}
	
?>

<input type="submit" value="Submit" />
<input type="reset" value="Clear" />

</form>