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
				$projArr = array();
				foreach($projColl as $projObj)
				{
					$projArr[$projObj -> id] = $projObj -> name;
				}				
				echo HTMLHelper::arrayToSelect("projectId", $projArr); ?>
			
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
		

