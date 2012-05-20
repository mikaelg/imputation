<div class="row">
	<div class="span12">
		<div class="page-header">
			<h1>Signed Out</h1>
		</div>
		

		
		<?php if($dcreg->logout){ ?>
			<div class="alert alert-success">
		    	<h2>U bent succesvol uitgelogd!</h2>
		    	<p>U kan opnieuw inloggen op de <a href="/login">login pagina</a></p>
		    </div>
			
		<?php } else {?>
			<form action="" method="post" name="logout">
				<input type="submit" value="Logout" class="btn btn-primary"> 
				<input type="hidden" name="formGuid" maxlength="100" value="1234567890">
			</form>
		<?php } ?>
		
	</div>
</div>