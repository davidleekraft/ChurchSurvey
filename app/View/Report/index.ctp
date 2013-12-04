<?php $this->extend('/Report/view'); ?>
<h2>Please choose a report option:</h2>

<h3><?php echo $this->Html->link("Click Here to Generate a Report by Member", array('controller'=>'report', 'action'=>'findMember')); ?></h3>

<h3><?php echo $this->Html->link("Click Here to Generate a Report by Skills", array('controller'=>'report', 'action'=>'skillsReport')); ?></h3>