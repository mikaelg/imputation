<?php namespace be\imputation;
//require_once 'core/AuthenticationController.php';
?>

<div>
<?php if(AuthenticationController::loginStatus()) {
	print('<a href="/logout">Logout</a>');} 
	else {
		print('<a href="/login">login</a>');
	}; ?>
</div>

<div>
<h1>IMPUTATION HEADER</h1>
</div>
