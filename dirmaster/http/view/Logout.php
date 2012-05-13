<div id="wrapper">
	<div id="content">
		<h1>content voor de Logout page</h1>
		<?php if($dcreg->logout){ ?>
			<h2>U bent succesvol uitgelogd!</h2>
			<p>U kan opnieuw inloggen op de <a href="/login">login pagina</a></p>
		<?php } else {?>
			<form action="" method="post" name="logout">
				<input type="submit" value="Logout"> 
				<input type="hidden" name="formGuid" maxlength="100" value="1234567890">
			</form>
		<?php } ?>
		
	</div>
</div>