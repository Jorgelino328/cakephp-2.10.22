<!-- File: /app/View/Tags/index.ctp -->
<div class="jumbotron">
	<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading"><h1>Lista de Tags</h1></div>
		<div class="panel-body">
			<p><?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-plus')) . " Criar Tag", array('action' => 'add'), array( 'class'=>'btn btn-primary btn-md', 'role'=>'button','escape' => false)); ?></p>
			<table class="table">
				<tr>
					<th>Nome</th>
					<th>Opções</th>
					<th>Data de Criação</th>
				</tr>

				<!-- Aqui é onde nós percorremos nossa matriz $posts, imprimindo
				as informações dos posts -->
				<?php $user=$this->Session->read('Auth.User');?>
				<?php foreach ($tags as $tag): ?>

					<tr>
						<td><?php echo $tag[0]['id']; ?></td>
						<td>
							<?php echo $this->Html->link($tag[0]['nome'], array('action' => 'view', $tag[0]['id'])); ?>
						</td>
						<td>
							<?php if ($user['role'] === 'admin') { ?>

								<?php echo $this->Form->postLink(
										$this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-trash')),
										array('action' => 'delete', $tag[0]['id']), array( 'class'=>'btn btn-danger btn-xs', 'role'=>'button','escape' => false),
										array('confirm' => 'Are you sure?')
								);
							} ?>
						</td>
						<td><?php echo $tag[0]['created']; ?></td>
					</tr>
				<?php endforeach; ?>

			</table>
		</div>
	</div>
</div>
