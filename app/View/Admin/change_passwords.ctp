<div class="changePasswords">

<?php
/**
 * Admin/changePasswords
 *
 * Responsible for changing passwords
 *
 * @link http://book.cakephp.org/2.0/en/views.html
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/form.html
 */

//Used for menubar
$this->extend('/Admin/view');

//Initialize form to change password
echo $this->Form->create('User', array('url' => array('controller' => 'admin', 'action' => 'changePasswords')));
?>

<table>
	<tr>
		<td width="150">Choose User Type: </td>
		<td>
			<select name="userType"><?php
			foreach($users as $userKey => $user)
			{
				?><option value="<?php echo $user['User']['UserType']?>"> <?php echo $user['User']['UserType']?></option><?php ;
			}
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Current Password:</td>
		<td><input type="password" size="20" name="currentPassword" /></td>
	</tr>
	<tr>
		<td>New Password:</td>
		<td><input type="password" size="20" name="newPassword" /></td>
	</tr>
	<tr>
		<td>Confirm Password:</td>
		<td><input type="password" size="20" name="verifyPassword" /></td>
	</tr>
</table>
<h2><?php foreach($users as $userKey => $user)
			{echo $user['User']['Password'];} ?></h2>
<?php echo $this->Form->end('Change Password'); ?>

</div>