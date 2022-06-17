<!-- File: /app/View/Posts/index.ctp -->
<?php echo $this->Flash->render('flash') ;
$mine=$date1=$date2=false;
$type=1;
if ($this->Session->data){
	if (!empty($this->Session->data['myposts'])) {
		$mine = $this->Session->data['myposts'];
	}
	if ($this->Session->data['SearchType']==2) {
		$type =2;
	}
	$date1=$this->Session->data['before'];;
	$date2=$this->Session->data['after'];
}else{?>
	<script>
		var date = new Date();
		date.setFullYear(date.getFullYear() - 10);
		$('.date1').datepicker("setDate",date);
		$('.date2').datepicker("setDate",'now');
	</script>
<?php }?>
<div class="jumbotron">
	<?php echo $this->Form->create('Search', array('label' => false,'controller' => 'posts', 'url' => $this->params['action'], 'method' => 'get')); ?>
	<div class="form-group form-inline col-md-12">
		<div class="input-group col-md-8">
		<?php echo $this->Form->input('key', array('div'=>false,'label' => false,'type'=>'text','class'=>'form-control', 'placeholder'=>'Buscar...')); ?>
		<span class="input-group-btn">
			<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
		</span>
		</div>
		<div class="input-group col-md-3">
			<input type="text" class="form-control datepicker date1" name="before" <?php if($date1){?>value="<?php echo $date1?>"<?} ?>>
			<div class="input-group-addon">até</div>
			<input type="text" class="form-control datepicker date2" name="after" <?php if($date2){?>value="<?php echo $date2?>"<?} ?>>
		</div>
	</div>
			<ul class="ks-cboxtags">
				<input type="hidden" name="data[Tags]"/>
				<?php foreach($tags as $tag){?>
					<li><input id="<?php echo $tag[0]['id']?>"  type="checkbox" name="data[Tags][]" value="<?php echo $tag[0]['id']?>" <?php if(in_array($tag[0]['id'],$this->Session->data['Tags'])){?>checked <?php } ?>/><label for="<?php echo $tag[0]['id']?>"><?php echo $tag[0]['nome'] ?></label></li>
				<?php }?>

				<div class="input-group">
					<label class="radio-inline"><input type="radio" name="SearchType" value="1" <?php if($type==1){?>checked<?php }?>>Pesquisa Inclusiva</label>
					<label class="radio-inline"><input type="radio" name="SearchType" value="2" <?php if($type==2){?>checked<?php }?>>Pesquisa Exclusiva</label>
					<?php if ($this->Session->read('Auth.User')) {	?><span style="position: relative; left: 10px;" ><label class="checkbox-inline"><input type="checkbox" name="myposts" value="1" <?php if($mine){?>checked<?php }?>>Somente meus posts </label></span><?php } ?>
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
					<?php if ($this->Session->read('Auth.User')) {?><th>Opções</th><?php } ?>
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
						<td style="text-align: center; vertical-align: middle;"	><div class="btn-toolbar" role="toolbar" ><?php if ($post
										['user_id'] == $user['id']  || $user['role'] === 'admin') { ?>

									<?php echo $this->Form->postLink(
											$this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-trash')),
											array('action' => 'delete', $post['id']), array( 'class'=>'btn btn-danger btn-lg', 'role'=>'button','escape' => false),
											array('confirm' => 'Are you sure?')
									) ?>
									<?php echo $this->Html->link($this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-wrench')), array('action' => 'edit', $post['id']), array( 'class'=>'btn btn-warning btn-lg', 'role'=>'button','escape' => false));
								} ?></div></td>
						<td><?php echo date("d-m-Y", strtotime($post['created'])); ?></td>
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
	$('.datepicker').datepicker({
		setDate: new Date(),
		format: 'dd-mm-yyyy',
		autoclose: true,
		language:'pt-BR',
	})
</script>
