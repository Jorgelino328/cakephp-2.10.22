<!-- File: /app/View/Posts/index.ctp -->
<div class="jumbotron">
	<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading"><h1>Blog posts</h1></div>
		<div class="panel-body">
<p><?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-plus')) . " Add Post", array('action' => 'add'), array( 'class'=>'btn btn-primary btn-lg', 'role'=>'button','escape' => false)); ?></p>
<table class="table">
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
				<?php if ($post[0]['user_id'] == $this->Session->read('Auth.User.id')) { ?>

					<?php echo $this->Form->postLink(
							$this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-trash')),
							array('action' => 'delete', $post[0]['id']), array( 'class'=>'btn btn-danger btn-xs', 'role'=>'button','escape' => false),
							array('confirm' => 'Are you sure?')
					) ?>
					<?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-wrench')), array('action' => 'edit', $post[0]['id']), array( 'class'=>'btn btn-warning btn-xs', 'role'=>'button','escape' => false));
				} ?>
			</td>
			<td><?php echo $post[0]['created']; ?></td>
		</tr>
	<?php endforeach; ?>

</table>
		</div>
		</div>
</div>


