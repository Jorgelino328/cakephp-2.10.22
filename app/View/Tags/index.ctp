<!-- File: /app/View/Tags/index.ctp -->
<?php $user=$this->Session->read('Auth.User');?>
<?php echo $this->Flash->render('flash') ?>
<div class="jumbotron">
	<h1>Lista de Tags <?php if ($user['role'] === 'admin') { ?><?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-plus')) . " Criar Tag", array('action' => 'add'), array( 'class'=>'btn btn-primary btn-lg', 'role'=>'button','escape' => false)); }?></h1>
	<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-body">
			<table class="table">
				<tr>
					<th>Nome</th>
					<?php if ($user['role'] === 'admin') { ?><th>Opções</th><?php } ?>
					<th>Data de Criação</th>
				</tr>

				<!-- Aqui é onde nós percorremos nossa matriz $posts, imprimindo
				as informações dos posts -->

				<?php foreach ($tags as $tag): ?>

					<tr>
						<td>
							<h4><?php echo $this->Html->link($tag[0]['nome'], array('controller' => 'posts', 'action' => 'index', $tag[0]['id']))?></h4>
						</td>
						<?php if ($user['role'] === 'admin') { ?>
						<td style="text-align: center; vertical-align: middle;"	><div class="btn-toolbar" role="toolbar" >


								<?php echo $this->Form->postLink(
										$this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-trash')),
										array('action' => 'delete', $tag[0]['id']), array( 'class'=>'btn btn-danger btn-lg', 'role'=>'button','escape' => false),
										array('confirm' => 'Are you sure?')
								);
							?>
							</div>
						</td>
						<?php } ?>
						<td><?php echo date("d/m/Y", strtotime($tag[0]['created'])); ?></td>
					</tr>
				<?php endforeach; ?>

			</table>
		</div>
	</div>
</div>
