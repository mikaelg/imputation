<div id="wrapper">

	<?php if($dcreg->employeeSpecified)
	{?>
	<h2><?php echo $dcreg->employee->firstname . ' ' . $dcreg->employee->lastname;?></h2>

	<div>
	<span style="display:inline-block;width:200px">In dienst sinds: </span><span><?php echo $dcreg->employee->employedSince->format("d-m-Y"); ?></span>
	</div>
	<?php 
	}
	else
	{
		echo "<h2>Please provide an employee name</h2>";
	}
	?>
	
</div>