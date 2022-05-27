<!--Navbar-->
<nav class="navbar navbar-default">
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
			<a class="navbar-brand" href="#">Blog do Jorge</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
				<li><?php echo $this->Html->link('Posts', array('controller' => 'posts', 'action' => 'index'))?></li>
			</ul>
			<form class="navbar-form navbar-left">
				<?php echo $this->Form->create('Search', array('controller' => 'posts', 'url' => 'index', 'method' => 'get'),array('type'=>'text','class'=>'form-control', 'placeholder'=>'Search')); ?>
				<?php echo $this->Form->input('key', array('label' => false)); ?>
				<?php echo $this->Form->end('Buscar', array( 'class'=>'btn btn-default btn-sm', 'role'=>'button')); ?>
			</form>
			<ul class="nav navbar-nav navbar-right">

				<li class="active">
					<?php if ($this->Session->read('Auth.User')) {
					echo $this->Html->link("logout", array('controller' => 'users', 'action' => 'logout'), array( 'class'=>'btn btn-default btn-sm', 'role'=>'button'));
				} else {
					echo $this->Html->link("login", array('controller' => 'users', 'action' => 'login'), array( 'class'=>'btn btn-default btn-sm', 'role'=>'button'));
					echo $this->Html->link("  Cadastro", array('controller' => 'users', 'action' => 'add'), array( 'class'=>'btn btn-default btn-sm', 'role'=>'button'));
					}
					?>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
					   aria-expanded="false">Minha Conta <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">Separated link</a></li>
					</ul>
				</li>
				<li>
					<a href="#">Usuário <?php echo $this->Html->image('cake.icon.png', array('alt' => 'CakePHP', 'border' => '0', 'data-src' => 'holder.js/100%x100')); ?></a>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
<!--End of Navbar-->
