<div class="sections"> 

<?php
/**
 * Admin/Choices
 *
 * Responsible for displaying choices and creating forms to edit them
 * Based on a specific Section
 *
 * @link http://book.cakephp.org/2.0/en/views.html
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/form.html
 */
 
//Used for menubar
$this->extend('/Admin/view');

//Initializes Choice Edit Form
echo $this->Form->create('Choice', array('url' => array('controller' => 'admin', 'action' => 'editChoices', $sectionID)));

foreach($choices as $choiceKey => $choice)
	{
	
	//Hidden form element is used to store ChoiceID
	echo $this->Form->input('Choice.'.$choiceKey.'.ChoiceID',
		array('type' => 'hidden',
			'value' => $choice['Choice']['ChoiceID']
		)
	);
	
	?>
	<div class="panelcollapsed">
		<h2><?php echo $choice['Choice']['Text'];?></h2> <!-- The h2 tag is the panel's title -->
	<div class="panelcontent">
	<?php
	
	//Textarea form element for Choice.Text
	//Populated from database
	//cols and rows may be overwritten by CSS
	echo $this->Form->input('Choice.'.$choiceKey.'.Text',
		array('label'=>'Text',
			'value' => $choice['Choice']['Text'],
			'type' => 'textarea',
			'rows' => '1',
			'cols' => '5'
		)
	);	
	
	//Statuses are pulled from database to create checkboxes
	$options = array();	
	foreach($statuses as $statusKey => $status)
		{
		$statusID = $status['Status']['StatusID'];
		$statusType = $status['Status']['Type'];
		$options[$statusID] = $statusType;
		}
	
	//Statuses for this choice are determined to see which check boxes will be checked
	$selected = array();	
	foreach($choice['StatusOfChoice'] as $statusKey => $status)
		{
		$selected[$statusKey] = $status['StatusID'];		
		}
	
	//Hidden form element used to keep track of which Choice this status information belongs to
	echo $this->Form->input('StatusOfChoice.'.$choiceKey.'.ChoiceID',
		array('type' => 'hidden',
			'value' => $choice['Choice']['ChoiceID']
		)
	);
	
	//Status checkboxes are created
	echo $this->Form->input('StatusOfChoice.'.$choiceKey.'.StatusID',
		array('multiple' => 'checkbox',
			'label' => '',
			'options' => $options,
			'selected' => $selected
		)
		
	);	
	?>
	<div class="clearboth"></div>
	</div>
	</div>
	<?php
	}
	
//End first form for editing choices
echo $this->Form->end('Save Changes');

//Initialize form for adding a new choice
echo $this->Form->create('Choice', array('url' => array('controller' => 'admin', 'action' => 'addChoices', $sectionID)));

echo $this->Form->input('Choice.SectionID',
		array('type' => 'hidden',
			'value' => $sectionID
		)
	);
	
echo $this->Form->input('Choice.Text',
		array('label'=>'Text',
			'value' => '',
			'type' => 'textarea',
			'rows' => '1',
			'cols' => '5'
		)
	);

echo $this->Form->end('Add New Choice');

echo $this->Html->link('<- Return to Sections', array('action' => 'sections'));
	
?>
</div>

	