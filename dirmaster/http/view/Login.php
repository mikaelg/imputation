
<div class="row">
	<div class="span4">
		<div class="page-header">
			<h1>Sign In</h1>
		</div>

		<?php 
			if(is_array($dcreg->warnings)){
				echo '<div class="alert alert-error">';
				foreach ($dcreg->warnings as $value) {
					print($value.'<br />');
				}
				echo '</div>';
			}
		?>

		<form action="" method="post" name="login">
			
			<label for="loginName">Loginnaam</label>
			<input type="text" name="loginName" maxlength="100" autofocus="autofocus">
			<br />
			<label for="password" >Paswoord</label>
			<input type="password" maxlength="20" name="password" >
			
			<div class="form-actions">
			<input type="submit" value="Verzenden" class="btn btn-primary"> 
			</div>
			
			<input type="hidden" name="formGuid" maxlength="100" value="<?php echo $dcreg->formGuid ?>">
		</form>
	</div>
	<div class="span8">
	</div>
	
</div>
		

