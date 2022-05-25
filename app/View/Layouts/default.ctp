<html>
<head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
		  integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"
		  integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
			integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
			crossorigin="anonymous"></script>
	<!--Icons-->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

	<!--
	//here your javascript yourscript.js
	//It will be present in all your views.
	//the file has to be present in /app/webroot/js
	-->
	<?php echo $this->Html->script('bootstrap.min'); ?>

</head>
<body>

<!--
//header
//the file header.ctp has to be present in /View/Elements
-->
<?php echo $this->element('header'); ?>

<!--
//here the content, for example from /View/Posts/edit.ctp
-->
<?php echo $this->fetch('content'); ?>

<!--
//footer
//the file footer.ctp has to be present in /View/Elements
-->
<?php echo $this->element('footer'); ?>
<?php echo $this->element('sql_dump'); ?>

</body>
</html>
