<?php namespace be\imputation;
//require_once 'core/AuthenticationController.php';
?>

<div>
	<ul>
	<li><a href="/">Home</a></li>
	<li>
	<?php if(AuthenticationController::loginStatus()) {
		print('<a href="/logout">Logout</a>');} 
		else {
			print('<a href="/login">login</a>');
		}; ?>
	</li>
	</ul>
</div>

<div>
<h1><?php print $dcreg->foo ?></h1>
<h1>IMPUTATION HEADER</h1>
</div>
