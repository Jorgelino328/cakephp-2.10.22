<div class="container-fluid">
	<?php echo $this->Flash->render('auth'); ?>
	<?php echo $this->Form->create('User'); ?>
		<legend><?php echo __('Por favor digite seu nome de usuário e senha'); ?></legend>
		<div class="form-group">
			<label>Usuário : </label><?php echo $this->Form->input('username', array('label' => false, 'class'=>'form-control'));?>
		</div>
		<div class="form-group">
			<label>Senha : </label><?php echo $this->Form->input('password', array('label' => false,'class'=>'form-control')); ?>

		</div>
		<div class="form-group">
			<button class="btn btn-primary" type="submit" style=" margin: 0 auto; float: none;">Login</button>
		</div>
		<?php echo $this->Form->end(); ?>
</div>
