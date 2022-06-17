<!-- app/View/Users/add.ctp -->
<?php echo $this->Flash->render('flash') ?>
<div class="container-fluid">
	<?php echo $this->Form->create('User'); ?>
		<legend><?php echo __('Adicionar Usuário'); ?></legend>
		<div class="form-group">
			<label>Usuário : </label><?php echo $this->Form->input('username', array('label' => false, 'class'=>'form-control'));?>
		</div>
		<div class="form-group">
			<label>Senha : </label><?php echo $this->Form->input('password', array('label' => false,'class'=>'form-control')); ?>

		</div>
		<div class="form-group">
			<label for="UserRole">Cargo</label>
			<select name="data[User][role]" id="UserRole" class="form-control">
				<option value="">[ Escolher Cargo ]</option>
				<option value="admin">Admin</option>
				<option value="author">Autor</option>
			</select>
		</div>

		<div class="form-group">
			<div class="form-group">
				<button class="btn btn-primary" type="submit" style=" margin: 0 auto; float: none;">Cadastrar</button>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
</div>
