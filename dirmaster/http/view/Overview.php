<?php namespace be\imputation; ?>


	<script type="text/javascript">
		
		$(function(){
			$('#startDate').datepicker();
		});
	</script>

<div class="row">
	<div class="span12">
		<div class="page-header">
			<h1><?php echo $dcreg->xml->location->title; ?></h1>
		</div>
		
		<?php if(isset($this->dcreg->projectsNoResults)){ ?>
			<div class="alert">
		    	<button class="close" data-dismiss="alert">×</button>
		    	<h2><?php echo $this->dcreg->projectsNoResults; ?></h2>
		    </div>		
		<?php }?>
		
		<?php  if($dcreg->showFormOverview){ ?>
		
			<form action="" method="post" name="overiew">
				<label for="startDate"><?php echo $dcreg->xml->location->startdate; ?></label>
				
				<input type="date" class=""  id="startDate" name="startDate" value="<?php echo date("d/m/Y"); ?>" data-date-format="dd/mm/yyyy">
				
				<div class="form-actions">
				<input type="submit" value="<?php echo $dcreg->xml->location->send; ?>" class="btn btn-primary"> 
				</div>
				<input type="hidden" name="formGuid" maxlength="100" value="<?php echo $dcreg->formGuid ?>">		
			</form>
		
		<?php } //end form ?>
		
		
		<?php  if(!$dcreg->showFormOverview){ ?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th><?php echo $dcreg->xml->location->projectname; ?></th>
					</tr>
				</thead>
				<tbody>
	
				<?php
				foreach ($dcreg->projects as $p) {
					echo '<tr><td>' . HTMLHelper::mig_createLink(array('href'=>'/project/'.$p->name , 'text'=>$p->name, )) . '</td></tr>';
				} 
				?>

				</tbody>
			</table>
			<p><?php echo HTMLHelper::mig_createLink(array('href'=>'/overview/', 
					'text'=>$dcreg->xml->location->newsearch,
					'class'=>"btn btn-primary", 
					'id'=>'backlink',
					)) ?></p>
		<?php } //end overview ?>		
		
		<?php echo session_id(); ?>
		
	</div>
</div>