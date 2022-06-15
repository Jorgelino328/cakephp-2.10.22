<!-- File: /app/View/Posts/index.ctp -->
<?php $user=$this->Session->read('Auth.User');?>
<?php echo $this->Flash->render('flash') ?>
<div class="jumbotron">
	<h1>Posts do Blog <?php if ($user['role'] === 'admin') { ?><?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-plus')) . " Criar Post", array('action' => 'add'), array( 'class'=>'btn btn-primary btn-lg', 'role'=>'button','escape' => false)); ?><?php }?></h1>
	<div class="panel panel-default">
						<div class="panel-body">
							<table class="table">
								<thead>
								<tr>
									<th>Título</th>
									<th>Tags</th>
									<?php if ($user['role'] === 'admin') { ?><th>Opções</th><?php }?>
									<th>Data de Criação</th>
								</tr>

								</thead>
								<tbody>

								<?php foreach ($posts as $post){ ?>
								<tr data-toggle="collapse" data-target="#post<?php echo $post
								['id']?>" class="accordion-toggle">
									<td><h3><?php echo $post['title']; ?><h3></td>
									<td><?php foreach ($posts_tags as $posts_tag){
											if($posts_tag[0]['post_id'] == $post['id']) {?>
												<ul class="ks-cboxtags" style="position: relative;display:inline-block;">
													<?php foreach($tags as $tag) {
														if($tag[0]['id']==$posts_tag[0]['tag_id']){?>
															<li	><a href="/posts/index/<?php echo $tag[0]['id']?>"><input id="<?php echo $tag[0]['id']?>"  type="checkbox" name="data[Post][tags][]" checked/><label class="checkbox-inline"><?php echo $tag[0]['nome'] ?></label></a></li>
														<?php }
													}?>
												</ul>
											<?php }
										}?></td>
									<?php if ($post['user_id'] == $user['id']  || $user['role'] === 'admin') { ?>
									<td style="text-align: center; vertical-align: middle;"	><div class="btn-toolbar" role="toolbar" >

											<?php echo $this->Form->postLink(
													$this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-trash')),
													array('action' => 'delete', $post
													['id']), array( 'class'=>'btn btn-danger btn-lg', 'role'=>'button','escape' => false),
													array('confirm' => 'Are you sure?')
											) ?>
											<?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-wrench')), array('action' => 'edit', $post['id']), array( 'class'=>'btn btn-warning btn-lg', 'role'=>'button','escape' => false));
											?></div></td><?php } ?>
									<td><?php echo date("d/m/Y", strtotime($post['created'])); ?></td>
								</tr>
								<tr>
									<td colspan="12" class="hiddenRow">
										<div class="accordian-body collapse" id="post<?php echo $post['id']?>">
											<p><?php echo $post['body']?></p>
										</div>
									</td>
								</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
	</div>
</div>
