<h2 style="text-align: center"> Time & Talent Survey </h2>
<h4 style="text-align: center"> Log in below to begin. </h4>
<br />
<p style="text-align: center"> Church Members taking survey, use the password "Member". <br />
	Committee Chair Members are to log in with the password provided to them. </p>

<div class="users form" style="text-align: center">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Please enter your password'); ?></legend>
        <?php echo $this->Form->input('password');?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>