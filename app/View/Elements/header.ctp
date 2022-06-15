<!--Navbar-->

<nav class="navbar navbar-default col-md-12">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
					data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php echo $this->Html->link('Blog do Jorge', array('controller' => 'posts', 'action' => 'index'), array('class' => 'navbar-brand'))?>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><?php echo $this->Html->link('Home', array('controller' => 'posts', 'action' => 'index'))?></li>
				<li><?php echo $this->Html->link('Meus Posts', array('controller' => 'posts', 'action' => 'my_posts'))?></li>
				<li><?php echo $this->Html->link('Tags', array('controller' => 'tags', 'action' => 'index'))?></li>
				<li style="position:relative; left:10px; margin-top:8px; width: 1000px"><?php echo $this->Form->create('Search', array('label' => false,'controller' => 'posts', 'url' => $this->params['action'], 'method' => 'get')); ?>
				<?php echo $this->Form->input('key', array('label' => false,'type'=>'text','class'=>'form-control', 'placeholder'=>'Buscar...'), array('div' => false)); ?></li>
				<li style="position:relative;margin-top:8px;"><button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
					<?php echo $this->Form->end();?>
				</li>
				<div class="btn-group" style="position:relative;margin-top:8px;">
					<a href="/posts/busca_avancada" role="button" class="btn btn-default" >
						Busca Avançada
					</a>
				</div>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
					   aria-expanded="false">Minha Conta <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li>
							<?php if ($this->Session->read('Auth.User')) {
								echo $this->Html->link("Logout", array('controller' => 'users', 'action' => 'logout'));
							} else {
								echo $this->Html->link("Login", array('controller' => 'users', 'action' => 'login'));}?></li>
						<li><?php echo $this->Html->link("  Cadastro", array('controller' => 'users', 'action' => 'add'));?></li>
					</ul>
				</li>
				<li><a href="#"><?php echo $this->Session->read('Auth.User.username');?></a></li>
				<li><a href="#"><?php echo $this->Html->image('cake.icon.png', array('alt' => 'CakePHP', 'border' => '0', 'data-src' => 'holder.js/100%x100')); ?></a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
<!--End of Navbar-->
