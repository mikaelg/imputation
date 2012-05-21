<div id="wrapper">

	<p>
	
	<h2><?php echo $dcreg->project->name;?></h2>
	
	<table>
	

			<div><span style="display:inline-block;width:200px">Projecttype</span>
			<?php echo $dcreg->project->type;?></div>


			<div><span style="display:inline-block;width:200px">Gestart op </span>
			<?php echo $dcreg->project->startDate->format("d-m-Y");?></div>


			<?php 
			//logica in de view, mag eig niet...
		
			if($dcreg->project->status  == "Closed"){?>
			
			<div><span style="display:inline-block;width:200px">Be&euml;indigd op </span>
			<?php echo $dcreg->project->endDate->format("d-m-Y");?></div>
			
			<?php 
			}else{
			?>
		
			<div><span style="display:inline-block;width:200px">Projectstatus</span>
			<?php echo $dcreg->project->status;?></div>
			<?php 
			} 
			?>


			<div><span style="display:inline-block;width:200px">Klant</span>
			<?php echo $dcreg->project->customerCompany->name;?></div>

			<div><span style="display:inline-block;width:200px">Project team</span>
			<?php echo $this -> teamAsCSV; ?></div>

		

	
	<?php //echo '<pre>' . print_r($dcreg->project, true) . '</pre>'; ?>
	</p>
	<ul>
		<li><a href="/overview">Overview</a></li>
	</ul>
</div>