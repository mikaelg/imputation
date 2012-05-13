<div id="wrapper">
	<div id="content">
		<h1>content voor de Loginpage testen</h1>
		<p>
		<?php 
			//print($dcreg->foo);
			if(is_array($dcreg->warnings)){
				foreach ($dcreg->warnings as $value) {
					print($value.'<br />');
				}
			}
		?>
		</p>
		<form action="" method="post" name="login">
			
			<label for="loginName">Loginnaam</label>
			<input type="text" name="loginName" maxlength="100" autofocus="autofocus">
			<br />
			<label for="password" >Paswoord</label>
			<input type="password" maxlength="20" name="password" >
			<br />
			<input type="submit" value="Verzenden"> 
			
			<input type="hidden" name="formGuid" maxlength="100" value="<?php echo $dcreg->formGuid ?>">
		</form>
		
	</div>
</div>