<!-- File: /app/View/Posts/add.ctp -->
<?php echo $this->Flash->render('flash') ?>
<div class="container-fluid">
<h1>Add Post</h1>
<?php
echo $this->Form->create('Post');?>
	<div class="form-group">
		<?echo $this->Form->input('title', array('class'=>'form-control'));?>
	</div>
	<div class="form-group">
		<?echo $this->Form->input('body', array('rows' => '3','class'=>'form-control'));?>
	</div>
	<div class="form-group">
		<label>Tags:</label>
		<ul class="ks-cboxtags">
			<input type="hidden" name="data[Post][tags]"/>
			<?php foreach($tags as $tag){?>
				<li><input id="<?php echo $tag[0]['id']?>"  type="checkbox" name="data[Post][tags][]" value="<?php echo $tag[0]['id']?>" /><label for="<?php echo $tag[0]['id']?>"><?php echo $tag[0]['nome'] ?></label></li>
			<?php }?>
		</ul>
	</div>
	<div class="form-group">
		<div class="form-group">
			<button class="btn btn-primary" type="submit" style=" margin: 0 auto; float: none;">Salvar</button>
		</div>
		<?echo $this->Form->end();?>
	</div>
</div>
