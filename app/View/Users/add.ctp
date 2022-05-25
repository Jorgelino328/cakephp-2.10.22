<!-- app/View/Users/add.ctp -->
<div class="users form">
	<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
		<?php echo $this->Form->input('username', array('label' => 'Usuário: '));
		echo $this->Form->input('password', array('label' => 'Senha: '));
		echo $this->Form->input('role', array(
				'options' => array('admin' => 'Admin', 'author' => 'Author')
		));
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>
