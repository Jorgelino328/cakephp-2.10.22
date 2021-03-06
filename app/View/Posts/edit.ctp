<!-- File: /app/View/Posts/edit.ctp -->
<?php echo $this->Flash->render('flash') ?>
<div class="container-fluid">
<h1>Edit Post</h1>
		<?php echo $this->Form->create('Post', array('action' => 'edit'));?>
	<div class="form-group">
    	<?php echo $this->Form->input('title', array('class'=>'form-control'));?>
	</div>
	<div class="form-group">
    	<?php echo $this->Form->input('body', array('rows' => '3','class'=>'form-control'));?>
	</div>
	<div class="form-group">
	<label>Tags:</label>
		<ul class="ks-cboxtags">
			<input type="hidden" name="data[Post][tags]"/>

			<?php
			foreach($tags as $tag){?>

				<li><input id="<?php echo $tag[0]['id']?>"  type="checkbox" name="data[Post][tags][]" value="<?php echo $tag[0]['id']?>" <?php foreach($this->Session->data['Tag'] as $mytag){ if($mytag['PostsTag']['tag_id'] == $tag[0]['id'] ){?>checked<?php } }?>/><label for="<?php echo $tag[0]['id']?>"><?php echo $tag[0]['nome'] ?></label></li>
			<?php }?>
		</ul>
	</div>
	<div class="form-group">
    	<?php echo $this->Form->input('id', array('type' => 'hidden','class'=>'form-control'));?>
	</div>
	<div class="form-group">
		<button class="btn btn-primary" type="submit" style=" margin: 0 auto; float: none;">Salvar</button>
	</div>
    	<?php echo $this->Form->end();?>
</div>
