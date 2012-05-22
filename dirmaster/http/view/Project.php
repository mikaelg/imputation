<? namespace be\imputation; ?>

<div id="wrapper">

	<h2><?php echo $dcreg->project->name;?></h2>
	

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
			
			<div>
			<? 
			if($dcreg->project->numberOfProjectTeamMembers() > 0)
			{
				$first = true;
				foreach($this -> teamMembersList as $tmArray)
				{
					echo '<span style="display:inline-block;width:200px">';
					echo $first ? "Project team" : '&nbsp;';
					echo '</span>';
					
					echo HTMLHelper::createLink($tmArray[0], $tmArray[1], $tmArray[2]) . "<br />";
					
					$first = false;
				}

			}
			else
			{
				echo '<span style="display:inline-block;width:200px;font-style: italic;font-weight:bolder">Project team niet gedefini&euml;erd!</span>';
			}
			?>
			</div> 

	
	<?php //echo '<pre>' . print_r($dcreg->project, true) . '</pre>'; ?>

	<ul>
		<li><a href="/overview">Overview</a></li>
	</ul>
</div>