<div id="wrapper">

	<p>
	<h2><?php echo $dcreg->employee->firstname . ' ' . $dcreg->employee->lastname;?></h2>
	</p>
	<div><span style="display:inline-block;width:200px">In dienst sinds: </span><span><?php echo $dcreg->employee->employedSince->format("d-m-Y"); ?></span>
	
</div>