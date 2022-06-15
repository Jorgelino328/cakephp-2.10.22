<!-- File: /app/View/Posts/index.ctp -->
<div class="jumbotron">
				<?php echo $this->Form->create('Search', array('label' => false,'controller' => 'posts', 'url' => $this->params['action'], 'method' => 'get')); ?>
					<div class="input-group">
						<?php echo $this->Form->input('key', array('label' => false,'type'=>'text','class'=>'form-control', 'placeholder'=>'Buscar...')); ?>
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
						</span>

					<div class="input-group input-daterange" id="datepicker">
							<input type="text" class="form-control" value="2012-04-05">
							<div class="input-group-addon">até</div>
							<input type="text" class="form-control" value="2012-04-19">
						</div>
					</div>
			<ul class="ks-cboxtags">
				<input type="hidden" name="data[Tags]"/>
				<?php foreach($tags as $tag){?>
					<li><input id="<?php echo $tag[0]['id']?>"  type="checkbox" name="data[Tags][]" value="<?php echo $tag[0]['id']?>" /><label for="<?php echo $tag[0]['id']?>"><?php echo $tag[0]['nome'] ?></label></li>
				<?php }?>

				<div class="input-group">
					<label class="radio-inline"><input type="radio" name="SearchType" value="1" checked>Pesquisa Inclusiva</label>
					<label class="radio-inline"><input type="radio" name="SearchType" value="2">Pesquisa Exclusiva</label>
					<span style="position: relative; left: 10px;" ><label class="checkbox-inline"><input type="checkbox" name="myposts" value="1">Somente meus posts </label></span>
				</div>
				<li style="position:relative;margin-top:8px;">
					<?php echo $this->Form->end();?>
				</li>
			</ul>

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
					<tr data-toggle="collapse" data-target="#post<?php echo $post['id']?>" class="accordion-toggle">
						<td><h3><?php echo $post['title']; ?><h3></td>
						<td><?php foreach ($posts_tags as $posts_tag){
								if($posts_tag[0]['post_id'] == $post['id']) {?>
									<ul class="ks-cboxtags" style="position: relative;display:inline-block;">
										<?php foreach($tags as $tag) {
											if($tag[0]['id']==$posts_tag[0]['tag_id']){?>
												<li	><a href="posts/index/<?php echo $tag[0]['id']?>"><input id="<?php echo $tag[0]['id']?>"  type="checkbox" name="data[Post][tags][]" checked/><label class="checkbox-inline"><?php echo $tag[0]['nome'] ?></label></a></li>
											<?php }
										}?>
									</ul>
								<?php }
							}?></td>
						<td><?php if ($post['user_id'] == $user['id']  || $user['role'] === 'admin') { ?>

								<?php echo $this->Form->postLink(
									$this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-trash')),
									array('action' => 'delete', $post['id']), array( 'class'=>'btn btn-danger btn-xs', 'role'=>'button','escape' => false),
									array('confirm' => 'Are you sure?')
								) ?>
								<?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-wrench')), array('action' => 'edit', $post['id']), array( 'class'=>'btn btn-warning btn-xs', 'role'=>'button','escape' => false));
							} ?></td>
						<td><?php echo date("d/m/Y", strtotime($post['created'])); ?></td>
					</tr>
					<tr>
						<td colspan="12" class="hiddenRow">
							<div class="accordian-body collapse" id="post<?php echo $post['id']?>">
								<h4 ><?php echo $post['body']?></h4>
							</div>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$('#datepicker').datepicker({
		format: 'dd/mm/yyyy',
		autoclose: true,
		language:'pt-BR',
		startDate: '+0'
	});
</script>
