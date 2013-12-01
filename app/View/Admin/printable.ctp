	
	<button onCLICK="window.print()" id="printArea">PRINT SURVEY</button> | 
	<a href=".">RETURN TO ADMIN VIEW</a>
	
<div id="printArea">

	<h1 style="text-align: center">Time and Talent Survey</h1>
	<br />
	<h3>Member Name: ______________________________ </h3>

	<?php
		
		/*PAGE HEAD FORM HERE*/
		
		foreach($sections as $sectionKey => $section)
		{
			echo "<h4>".$section['Section']['Tag']."</h4>";
			
			$sectionIdent = $section['Section']['SectionID'];
			
			foreach($choices as $choiceKey => $choice)
			{
				$choiceIdent = $choice['Choice']['SectionID'];
				
				if($sectionIdent == $choiceIdent)
				{
					
					echo "____".$choice['Choice']['Text'];
					
					echo "<br />";
				}
				
			}
		}
		
	?>
</div>