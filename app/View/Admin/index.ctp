<?php $this->extend('/Admin/view'); ?>

<h2 class= "infoTitle">Sections</h2>
<div  class="infoDescr"/>
	<p>A "Section" is a survey page.  Each section is created from the following parts:</p>
	<ul>
		<li>Tag: A shorthand title for the section.</li>
		<li>Text: The section's description or survey question.</li>
		<li>User Groups: Select which users will be able to see this
			section when they take the survey.</li>
		<li>Edit Choices:  A link to the choices/answers for the survey section</li>
	</ul>
	<h4><?php echo $this->Html->link("Click Here To Edit Sections", array('controller'=>'admin', 'action'=>'sections')); ?></h4>
</div>
		 
<h2 class= "infoTitle">Choices</h2>
<div class="infoDescr">
	<p>The Choices page contains all of the answers/choices for a specific section.  Each
	choice is created from the following parts:</p>
	<ul>
		<li>Text: The choice's title</li>
		<li>User Groups: Select which users will be able to see this section when they
			take the survey</li>
	</ul>
	<h4>Choices are editable by entering the Edit Sections area, and selecting the corresponding Section.</h4>
</div>

<h2 class= "infoTitle">Generate Reports</h2>
<div  class="infoDescr"/>
	<p>This section allows you to create reports based on Member survey data. These
		reports can then be exported to PDF format.</p>
	<h4><?php echo $this->Html->link("Click Here To Generate Reports", array('controller'=>'report', 'action'=>'skillsReport')); ?></h4>
</div>
		
<h2 class= "infoTitle">Change Passwords</h2>
<div  class="infoDescr"/>
	<p>This section allows you to change to default passwords for the three user groups</p>
	<ul>
		<li>Member</li>
		<li>Chair</li>
		<li>Admin</li>
	</ul>
	<h4><?php echo $this->Html->link("Click Here To Change Passwords", array('controller'=>'admin', 'action'=>'changePasswords')); ?></h4>
</div>
<h2 class= "infoTitle">Purge / Erase Survey Data</h2>
<div  class="infoDescr"/>
	<p>This section allows you to completely purge all stored Member survey responses.
		This action is irrevocable. </p>
	<h4><?php echo $this->Html->link("Click Here To Purge Survey Data", array('controller'=>'admin', 'action'=>'purgeAll')); ?></h4>
</div>
	