<h2> Welcome, <?php echo $member['Member']['FName'];?> <?php echo $member['Member']['LName'];?>! </h2>
<br />
<h4> Address: <?php echo $member['Member']['Address']; ?> <br />
Cell Phone: <?php echo $member['Member']['CellPhone']; ?> <br />
Home Phone: <?php echo $member['Member']['HomePhone']; ?> <br />
Work Phone: <?php echo $member['Member']['WorkPhone']; ?> <br />
Email: <?php echo $member['Member']['Email']; ?> </h4>

<br /><br />

<h4> Not You? <?php echo $this->Html->link("Click Here To LOG OUT", array('controller'=>'users', 'action'=>'logout'));?>
<h3><a href="./survey">Take Survey!</a></h3>
