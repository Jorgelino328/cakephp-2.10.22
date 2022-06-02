<!-- File: /app/View/Tags/add.ctp -->

<div class="container-fluid">
<h1>Add Tag</h1>
	<?php echo $this->Form->create('Tag');?>
	<div class="form-group">
		<?echo $this->Form->input('nome', array('class'=>'form-control'));?>
	</div>
	<div class="form-group">
		<div class="form-group">
			<button class="btn btn-primary" type="submit" style=" margin: 0 auto; float: none;">Salvar</button>
		</div>
		<?echo $this->Form->end();?>
	</div>
</div>
