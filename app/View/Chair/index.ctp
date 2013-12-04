<?php $this->extend('/Chair/view'); ?>

<h2 class= "infoTitle">Generate Reports</h2>
<div  class="infoDescr"/>
	<p>This section allows you to create reports based on Member survey data. These
		reports can then be exported to PDF format.</p>
	<h4><?php echo $this->Html->link("Click Here To Generate Reports", array('controller'=>'report', 'action'=>'index')); ?></h4>
</div>
	