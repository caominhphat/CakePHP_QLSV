<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
	?>
		<div style="color: red">Role</div>
		<select id="role" name="data[User][role]">
			<option value="admin">Admin (You have all rights with admin role)</option>
			<option value="author">Author (You can only add student, cannot edit or delete)</option>
			<option value="lol" style="color: #0b2e13" selected>This is wrong value to check transaction</option>
		</select>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
	</ul>
</div>
