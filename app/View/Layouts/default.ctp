<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
		  integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
	echo $this->Html->meta('icon');

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
</head>
<body>
<div id="container">
	<div id="header">
		<h1><?php echo $this->Html->link($cakeDescription, 'https://cakephp.org'); ?></h1>
	</div>
	<div id="content">

		<?php echo $this->Flash->render(); ?>

		<?php echo $this->fetch('content'); ?>
	</div>

</div>
<footer class="fixed-bottom bg-dark text-center text-white">
	<!-- Grid container -->
	<div class="container p-4 pb-0">
		<!-- Section: Social media -->
		<section class="mb-4">
			<!-- Facebook -->
			<a class="btn btn-outline-light btn-floating m-1" href="https://www.facebook.com/"
			   target="_blank"><i class="fa fa-facebook"></i></i
				></a>

			<!-- Twitter -->
			<a class="btn btn-outline-light btn-floating m-1" href="https://www.twitter.com/" target="_blank"><i
						class="fa fa-twitter"></i></a>

			<!-- Google -->
			<a class="btn btn-outline-light btn-floating m-1" href="Jorge: jorgewilliam328@gmail.com" target="_blank"><i
						class="fa fa-envelope"></i></a>

			<!-- Github -->
			<a class="btn btn-outline-light btn-floating m-1" href="https://www.github.com/AvirupJU" target="_blank"><i
						class="fa fa-github"></i></a>
		</section>
		<!-- Section: Social media -->
	</div>
	<!-- Grid container -->

	<!-- Copyright -->
	<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
		© 2020 Copyright:
		<a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
	</div>
	<!-- Copyright -->
</footer>
</body>
</html>
