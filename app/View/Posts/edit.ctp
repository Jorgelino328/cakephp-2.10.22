<!-- File: /app/View/Posts/edit.ctp -->
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
				<li><input type="checkbox" id="checkboxOne" name="data[PostTag][tagId]" value="acao"><label for="checkboxOne">Ação</label></li>
				<li><input type="checkbox" id="checkboxTwo" name="data[PostTag][tagId]" value="comedia"><label for="checkboxTwo">Comédia</label></li>
				<li><input type="checkbox" id="checkboxThree" name="data[PostTag][tagId]" value="drama"><label for="checkboxThree">Drama</label></li>
				<li><input type="checkbox" id="checkboxFour" name="data[PostTag][tagId]" value="romance"><label for="checkboxFour">Romance</label></li>
			</ul>
	</div>
	<div class="form-group">
    	<?php echo $this->Form->input('id', array('type' => 'hidden','class'=>'form-control'));?>
	</div>
	<div class="form-group">
		<button class="btn btn-primary" type="submit" style=" margin: 0 auto; float: none;">Login</button>
	</div>
    	<?php echo $this->Form->end();?>
</div>
