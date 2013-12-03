<h2 style="text-align: center"> Add New Member </h2>
<p style="text-align: center"> The member name you entered is not in our database. <br />
	Use the following form to create an account. </p>
	
<br />

<?php

echo $this->Form->create('MemberAdd', array('url' => array('controller' => 'members', 'action' => 'add')));

echo $this->Form->input('Status', array('options' => array(
    '1'=>'Adult',
    '3'=>'Child'
 )));
 
echo "<br />";

echo $this->Form->input('FName',
		array('label'=>'First Name ',
			'type' => 'text'
		)
	);

echo "<br />";
	
echo $this->Form->input('LName',
		array('label'=>'Last Name ',
			'type' => 'text'
		)
	);

echo "<br />";
?>
<br />
<div style="border: 2px solid black;">
<p> This section is for Children Only </p>


<?php 
	
echo "<br />";

echo $this->Form->input('ParentFName',
		array('label'=>'Parent First Name ',
			'type' => 'text'
		)
	);

echo "<br />";

echo $this->Form->input('ParentLName',
		array('label'=>'Parent Last Name ',
			'type' => 'text'
		)
	);
?>
<br />
</div>
<br />
<?php

echo $this->Form->input('Address',
		array('label'=>'Address ',
			'type' => 'text'
		)
	);

echo "<br />";

echo $this->Form->input('CellPhone',
		array('label'=>'Cell Phone # ',
			'type' => 'text'
		)
	);
	
echo "<br />";
	
echo $this->Form->input('TextMessage', array('options' => array(
    '1'=>'Yes',
    '0'=>'No'
 ),
 	'label' => 'Can Receive Text Messages? '));
	
echo "<br />";
echo "<br />";
	
echo $this->Form->input('HomePhone',
		array('label'=>'Home Phone # ',
			'type' => 'text'
		)
	);
	
echo "<br />";
	
echo $this->Form->input('WorkPhone',
		array('label'=>'Work Phone # ',
			'type' => 'text'
		)
	);
	
echo "<br />";

echo $this->Form->input('Email',
		array('label'=>'Email Address ',
			'type' => 'email'
		)
	);
	
echo "<br />";

echo $this->Form->input('Gender', array(
    'options' => array('M', 'F')
));
	
echo "<br />";

echo $this->Form->end('Add New Member');