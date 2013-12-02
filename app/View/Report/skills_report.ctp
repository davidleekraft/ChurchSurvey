<script>
$(function() {
       $("#datepicker").datepicker();
});
</script>
<?php
//Here we are creating three arrays from database
foreach ($choices as $choice)
{
	//First Array - List of God's Gift skills of members 1 because it is its id in table
	if($choice['Choice']['SectionID'] == 1)
	{
		$gifts[$choice['Choice']['ChoiceID']] = $choice['Choice']['Text'];
	}
	
	elseif($choice['Choice']['SectionID'] == 2)
	{
		$compSkills[$choice['Choice']['ChoiceID']] = $choice['Choice']['Text'];
	}
	else
	{
		$others[$choice['Choice']['ChoiceID']] = $choice['Choice']['Text'];
	}
}
?>
<table>
<tr>
<th colspan = 3 style="text-align:center">Search by Skill</th>
</tr>
<tr>

<td colspan = 3 style="text-align:center">
<?php 
echo $this->Form->create('memberForm', array('type' => 'get', 'url' => 'report_by_skills'));
echo $this->Form->input('Constituents', array(
    'type' => 'select',
    'multiple' => 'checkbox',
    'options' => $memberTypes,
	'label'  => 'Constituents*',
	'style' => 'float:left'
));
?>
</td>
</tr>
<tr>
<th>God's Gifts</th>
<th>Computer Skills</th>
<th>Other</th>
</tr>
<?php
		echo "<tr><td>";
		echo $this->Form->input('gifts', array('options' =>$gifts,
											   'size' => 25,
											  'style' => 'width:300px;font-size:small',
											  'multiple' => 'multiple',
											  'label' => false));
		echo "</td>";
		echo "<td>";
		echo $this->Form->input('compSkills', array('options' =>$compSkills,
											   'size' => 25,
											  'style' => 'width:300px;font-size:small',
											  'multiple' => 'multiple',
											  'label' => false));
		echo "</td>";
		echo "<td>";
		echo $this->Form->input('Others', array('options' =>$others,
											   'size' => 25,
											  'style' => 'width:300px;font-size:small',
											  'multiple' => 'multiple',
											  'label' => false));

?>
<tr>
	<td colspan = 3 style="text-align:center">
	
	<?php 
		echo $this->Form->input('updated',
				array(
				   'id'=>'datepicker',
				   'type'=>'text',
				   'label' => 'Surveys updated since:** '
				));
	?> 
	</td>
</tr>
<tr>
	<td colspan = 3>
	<?php
		echo $this->Form->end('Generate Report');
	?> 
	</td>
</tr>
</table>
<br/>
<p>* You must provide a skill or a list of skills with needed constituents.</p>
<p>** This field is optional </p>