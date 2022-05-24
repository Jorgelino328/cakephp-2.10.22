<form>
	<div class="form-group">
		<?php echo $this->Flash->render('auth'); ?>
		<?php echo $this->Form->create('User'); ?>
		<legend><?php echo __('Please enter your username and password'); ?></legend>
		<?php echo $this->Form->input('Usuário', array('class' => 'form-control', 'placeholder' => 'Digite seu email...')); ?>
	</div>
	<div class="form-group">
		<? echo $this->Form->input('Senha ', array('class' => 'form-control', 'placeholder' => 'Digite sua Senha')); ?>
	</div>
	<?php echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login'), array('class' => 'btn btn-primary')); ?>
</form>
</form>


