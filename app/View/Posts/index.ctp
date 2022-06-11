<!-- File: /app/View/Posts/index.ctp -->
<div class="jumbotron">
	<h1>Posts do Blog <?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-plus')) . " Criar Post", array('action' => 'add'), array( 'class'=>'btn btn-primary btn-lg', 'role'=>'button','escape' => false)); ?></h1>
	<div class="panel panel-default">
						<div class="panel-body">
							<table class="table">
								<thead>
								<tr>
									<th>Título</th>
									<th>Tags</th>
									<th>Opções</th>
									<th>Data de Criação</th>
								</tr>

								</thead>
								<tbody>
								<?php $user=$this->Session->read('Auth.User');?>
								<?php foreach ($posts as $post){ ?>
								<tr data-toggle="collapse" data-target="#post<?php echo $post[0]['id']?>" class="accordion-toggle">
									<td><h3><?php echo $post[0]['title']; ?><h3></td>
									<td><?php foreach ($posts_tags as $posts_tag){
											if($posts_tag[0]['post_id'] == $post[0]['id']) {?>
												<ul class="ks-cboxtags" style="position: relative;display:inline-block;">
													<?php foreach($tags as $tag) {
														if($tag[0]['id']==$posts_tag[0]['tag_id']){?>
															<li	><a href="tags/index"><input id="<?php echo $tag[0]['id']?>"  type="checkbox" name="data[Post][tags][]" checked/><label class="checkbox-inline"><?php echo $tag[0]['nome'] ?></label></a></li>
														<?php }
													}?>
												</ul>
											<?php }
										}?></td>
									<td><?php if ($post[0]['user_id'] == $user['id']  || $user['role'] === 'admin') { ?>

											<?php echo $this->Form->postLink(
													$this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-trash')),
													array('action' => 'delete', $post[0]['id']), array( 'class'=>'btn btn-danger btn-xs', 'role'=>'button','escape' => false),
													array('confirm' => 'Are you sure?')
											) ?>
											<?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-wrench')), array('action' => 'edit', $post[0]['id']), array( 'class'=>'btn btn-warning btn-xs', 'role'=>'button','escape' => false));
										} ?></td>
									<td><?php echo $post[0]['created']; ?></td>
								</tr>
								<tr>
									<td colspan="12" class="hiddenRow">
										<div class="accordian-body collapse" id="post<?php echo $post[0]['id']?>">
											<h4 ><?php echo $post[0]['body']?></h4>
										</div>
									</td>
								</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
	</div>
</div>
