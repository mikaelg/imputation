<? namespace be\imputation; ?>


	<script type="text/javascript">
		
		$(function(){
			$('#startDate').datepicker();
		});
	</script>

<div class="row">
	<div class="span12">
		<div class="page-header">
			<h1>Projecten overzicht</h1>
		</div>
		
		<?php if(isset($this->dcreg->projectsNoResults)){ ?>
			<div class="alert">
		    	<button class="close" data-dismiss="alert">×</button>
		    	<h2><?php echo $this->dcreg->projectsNoResults; ?></h2>
		    </div>		
		<?php }?>
		
		<?php  if($dcreg->showFormOverview){ ?>
		
			<form action="" method="post" name="overiew">
				<label for="startDate">Start datum</label>
				
				<input type="date" class=""  id="startDate" name="startDate" value="<?php echo date("d/m/Y"); ?>" data-date-format="dd/mm/yyyy">
				
				<div class="form-actions">
				<input type="submit" value="Verzenden" class="btn btn-primary"> 
				</div>
				<input type="hidden" name="formGuid" maxlength="100" value="<?php echo $dcreg->formGuid ?>">		
			</form>
		
		<?php } //end form ?>
		
		
		<?php  if(!$dcreg->showFormOverview){ ?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Projectnaam</th>
					</tr>
				</thead>
				<tbody>
	
				<?php
				foreach ($dcreg->projects as $p) {
					echo '<tr><td>' . HTMLHelper::createLink('/project/'.$p->name , $p->name) . '</td></tr>';
				} 
				?>

				</tbody>
			</table>
			<p><a href="/overview" class="btn btn-primary">Zoek opnieuw</a></p>
		<?php } //end overview ?>		
		
		
	</div>
</div>


<div class="row">
	<div class="span12">
		<hr />
		<p>
		DEBUGGING ::<br />
		<?php print($dcreg->foo); ?><br />
		<?php print($_SESSION['loginsession']); ?><br />
		<?php echo '<pre>' . print_r($dcreg->projects, true) . '</pre>'; ?>
		</p>
	</div>
</div>