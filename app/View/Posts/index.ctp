<!-- File: /app/View/Posts/index.ctp -->
<br class="jumbotron">
<h1>Blog
	posts <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus')) . ' Criar Post', array('action' => 'add'), array('class' => 'btn btn-primary btn-sm', 'role' => 'button', 'escape' => false)); ?></h1>
<br></br>
<table class="table table-striped">
	<tr>
		<th>Id</th>
		<th>Title</th>
		<th>Action</th>
		<th>Created</th>
	</tr>

	<!-- Aqui é onde nós percorremos nossa matriz $posts, imprimindo
	as informações dos posts -->

	<?php foreach ($posts as $post): ?>
		<tr>
			<td><?php echo $post['Post']['id']; ?></td>
			<td>
				<?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'index', $post['Post']['id'])); ?>
			</td>
			<td>
				<?php echo $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash-o')),
						array('action' => 'delete', $post['Post']['id']), array('class' => 'btn btn-xs btn-danger', 'height' => 'height: 100px', 'escape' => false),
						array('confirm' => 'Are you sure?')
				) ?>
				<?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-wrench')),
						array('action' => 'edit', $post['Post']['id']),
						array('class' => 'btn btn-xs btn-warning btn', 'escape' => false)); ?>
			</td>
			<td><?php echo $post['Post']['created']; ?></td>
		</tr>
	<?php endforeach; ?>

</table>
</div>
