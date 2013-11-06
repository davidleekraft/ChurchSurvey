<?php
/*
 * TODO: Implement survey
 */
 
?>

<h2> SURVEY </h2>
<p> Select All That Apply </p>

<form>

<?php

	
	foreach($sections as $sectionKey => $section)
	{
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
		
		echo "<br /><br />";
	
	}
	
?>

<input type="submit" value="Submit" />
<input type="reset" value="Clear" />

</form>