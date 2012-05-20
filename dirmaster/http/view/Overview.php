<div id="wrapper">

<?php  if($dcreg->showFormOverview){ ?>
<div>
	<form action="" method="post" name="overiew">
		<label for="startDate">Loginnaam</label>
		<input type="date" class="" autofocus="autofocus" id="startDate" name="startDate">
		<br />
		<input type="submit" value="Verzenden"> 
		<input type="hidden" name="formGuid" maxlength="100" value="<?php echo $dcreg->formGuid ?>">		
	</form>
</div>
<?php } //end form ?>

<?php  if(!$dcreg->showFormOverview){ ?>
<p>content voor de Overview</p>


	<?php
	foreach ($dcreg->projects as $p) {
		echo '<p>Projectnaam: <a href="/project/'.$p->name.'">'.$p->name.'</a></p>';
	} 
	?>
<?php } //end overview ?>

	<div class="debug">
		<hr />
		<p>
		DEBUGGING ::<br />
		<?php print($dcreg->foo); ?><br />
		<?php print($_SESSION['loginsession']); ?><br />
		<?php echo '<pre>' . print_r($dcreg->projects, true) . '</pre>'; ?>
		</p>
	</div>
</div>