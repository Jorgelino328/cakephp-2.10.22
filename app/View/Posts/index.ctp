<!-- File: /app/View/Posts/index.ctp -->
<div class="jumbotron">
	<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading"><h1>Posts do Blog</h1></div>
		<div class="panel-body">
<p><?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-plus')) . " Criar Post", array('action' => 'add'), array( 'class'=>'btn btn-primary btn-lg', 'role'=>'button','escape' => false)); ?></p>
<table class="table">
	<tr>
		<th>Título</th>
		<th>Tags</th>
		<th>Opções</th>
		<th>Data de Criação</th>
	</tr>

	<!-- Aqui é onde nós percorremos nossa matriz $posts, imprimindo
	as informações dos posts -->
	<?php $user=$this->Session->read('Auth.User');?>
	<?php foreach ($posts as $post){ ?>

		<tr>
			<td>
				<?php echo $this->Html->link($post[0]['title'], array('action' => 'view', $post[0]['id'])); ?>
			</td>
			<td>
				<?php foreach ($posts_tags as $posts_tag){
					if($posts_tag[0]['post_id'] == $post[0]['id']) {?>
						<ul class="ks-cboxtags" style="position: relative;top:-25px;display:inline-block;">
						<?php foreach($tags as $tag) {
							if($tag[0]['id']==$posts_tag[0]['tag_id']){?>
								<li	><a href="tags/index"><input id="<?php echo $tag[0]['id']?>"  type="checkbox" name="data[Post][tags][]" checked/><label class="checkbox-inline"><?php echo $tag[0]['nome'] ?></label></a></li>
					<?php }

						}?>
						</ul>
				<?php }
				}?>
			</td>
			<td>
				<?php if ($post[0]['user_id'] == $user['id']  || $user['role'] === 'admin') { ?>

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
	<?php } ?>


</table>

		</div>
		</div>
</div>


