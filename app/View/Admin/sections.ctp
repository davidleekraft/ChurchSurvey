<div class="sections">

<?php
/**
 * Admin/Sections
 *
 * Responsible for displaying sections and creating forms to edit them
 *
 * @link http://book.cakephp.org/2.0/en/views.html
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/form.html
 */

//Used for menubar
$this->extend('/Admin/view');

//Initializes Section Edit Form
echo $this->Form->create('Section', array('url' => array('controller' => 'admin', 'action' => 'editSections')));

//Form elements are created for each Section in the database
foreach($sections as $sectionKey => $section)
	{
	
	//Hidden form element is used to store SectionID
	echo $this->Form->input('Section.'.$sectionKey.'.SectionID',
		array('type' => 'hidden',
			'value' => $section['Section']['SectionID']
		)
	);
	
	?>
	<div class="panelcollapsed">
		<h2><?php echo $section['Section']['Tag'];?></h2><!--The h2 tag is the panel's title -->
	<div class="panelcontent">
	<?php
	
	//Textarea form element for Section.Tag
	//Populated from database
	//cols and rows may be overwritten by CSS
	echo $this->Form->input('Section.'.$sectionKey.'.Tag',
		array('label'=>'Tag',
			'value'=>$section['Section']['Tag'],
			'type' => 'textarea',
			'rows' => '1',
			'cols' => '5'
		)
	);
	
	//Textarea form element for Section.Text
	//Populated from database
	//cols and rows may be overwritten by CSS
	echo $this->Form->input('Section.'.$sectionKey.'.Text',
		array('label'=>'Text',
			'value'=>$section['Section']['Text'],
			'type' => 'textarea',
			'rows' => '2',
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
	
	//Statuses for this section are determined to see which check boxes will be checked
	$selected = array();	
	foreach($section['StatusOfSection'] as $statusKey => $status)
		{
		$selected[$statusKey] = $status['StatusID'];		
		}
	
	//Hidden form element used to keep track of which Section this status information belongs to
	echo $this->Form->input('StatusOfSection.'.$sectionKey.'.SectionID',
		array('type' => 'hidden',
			'value' => $section['Section']['SectionID']
		)
	);
	
	//Status checkboxes are created
	echo $this->Form->input('StatusOfSection.'.$sectionKey.'.StatusID',
		array('multiple' => 'checkbox',
			'label' => '',
			'options' => $options,
			'selected' => $selected
		)
		
	);
	
	?>
	<div class="clearboth"></div>
	<?php
	//Generates a link to edit the Choices for this Section
	echo $this->Html->link('Edit Section Choices ->', array('action' => 'choices', $section['Section']['SectionID']));
	?>
	</div>
	</div>
	<?php
	
	}

//End first form for editing sections
echo $this->Form->end('Save Changes');

//Initialize form for adding a new section
echo $this->Form->create('Section', array('url' => array('controller' => 'admin', 'action' => 'addSections')));

echo $this->Form->input('Section.Tag',
		array('label'=>'Tag',
			'value' => '',
			'type' => 'textarea',
			'rows' => '1',
			'cols' => '5'
		)
	);
	
	echo $this->Form->input('Section.Text',
		array('label'=>'Text',
			'value' => '',
			'type' => 'textarea',
			'rows' => '2',
			'cols' => '5'
		)
	);
echo $this->Form->end('Add New Section');

?>
</div>
	