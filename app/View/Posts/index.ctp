<!-- File: /app/View/Posts/index.ctp -->
<h1>Blog posts</h1>
<p><?php echo $this->Html->link("Add Post", array('action' => 'add')); ?></p>
<table>
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
			<td><?php echo $post[0]['id']; ?></td>
			<td>
				<?php echo $this->Html->link($post[0]['title'], array('action' => 'view', $post[0]['id'])); ?>
			</td>
			<td>
				<?php echo $this->Form->postLink(
						'Delete',
						array('action' => 'delete', $post[0]['id']),
						array('confirm' => 'Are you sure?')
				) ?>
				<?php echo $this->Html->link('Edit', array('action' => 'edit', $post[0]['id'])); ?>
			</td>
			<td><?php echo $post[0]['created']; ?></td>
		</tr>
	<?php endforeach; ?>

</table>
