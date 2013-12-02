


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


  <script>
  $(function() {
    $( "#accordion" ).accordion({
      heightStyle: "content",
      collapsible: true
    });
  });
  $(function() {
    $( "#accordion-resizer" ).resizable({
      minHeight: 140,
      minWidth: 200,
      resize: function() {
        $( "#accordion" ).accordion( "refresh" );
      }
    });
  });
  </script>
  




<h2> Welcome, <?php echo $memberName; ?>! </h2>
<h2> Time & Talent Survey </h2>
<p> Under Each Category, Select All That Apply </p>

<form method="POST">
  <div id="accordion">
<?php

	foreach($sections as $sectionKey => $section)
	{
		
		echo "<h3>".$section['Section']['Tag']."</h3><div><p>";
		
		
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
		?></p></div><?php
	
	}
?>
</div>
<input type="submit" value="Submit"/>
<input type="reset" value="Clear" />

</form>

