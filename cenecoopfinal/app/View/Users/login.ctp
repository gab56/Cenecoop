<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?php echo __('Please enter your username and password'); ?>
        </legend>
        <?php echo $this->Form->input('username', array('type' => 'text'));
			  echo $this->Form->input('password');
    ?>
	<?php echo $this->Html->link("Forget Password ?",array("controller"=>"users","action"=>"forgetpw")); ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>