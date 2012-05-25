<?php namespace be\imputation; ?>
<div class="row">
	<div class="span4">
		<div class="page-header">
			<h1>Input time</h1>
		</div>

		<?php 
			//print($dcreg->foo);
			if(is_array($dcreg->warnings)){
				echo '<div class="alert alert-error">';
				foreach ($dcreg->warnings as $value) {
					print($value.'<br />');
				}
				echo '</div>';
			}
		?>

		<form action="" method="post" name="login">
			
			<label for="projectId">Project</label>

				<?php 
				$projColl = $this->model->getProjects();				
				$projArr = array(0 => '- - Kies - -');
				foreach($projColl as $projObj)
				{
					$projArr[$projObj -> id] = $projObj -> name;
				}				
				echo HTMLHelper::arrayToSelect("projectId", $projArr);
				?>
			
			<br />
			
			
			<label for="costCentre" >Kostendrager</label>
			
				<?php 
				$ccColl = $this->model->getCostCentres();				
				$ccArr = array(0 => '- - Kies - -');
				foreach($ccColl as $ccObj)
				{
					$ccArr[$ccObj -> id] = $ccObj -> shorthand . ' - ' . $ccObj -> description;
				}				
				echo HTMLHelper::arrayToSelect("costCentre", $ccArr);
				?>
			
			<br />
			
			<label for="date" >Datum (dd-mm-yyyy)</label>
			<input type="text" name="date" value="" maxlength="10" />
			
			<label for="numHours" >Aantal uren</label>
			<input type="text" name="numHours" value="" maxlength="2" />
					
			<label for="invoiceable">Factureerbaar?</label>
			<input type="radio" name="invoiceable" value="1" /> Ja &nbsp;&nbsp;
			<input type="radio" name="invoiceable" value="0" CHECKED /> Nee<br />
			
			<br />
			<hr />
			
			<label for="comments">Commentaar</label></label>
			<textarea name="comments" rows="5"></textarea> 
			
			<br />
			
			<div class="form-actions">
			<input type="submit" name="go" value="Verzenden" class="btn btn-primary"> 
			</div>
			
			<input type="hidden" name="formGuid" maxlength="100" value="<?php echo $dcreg->formGuid ?>">
		</form>
	</div>
	<div class="span8">
	</div>
	
</div>
		

