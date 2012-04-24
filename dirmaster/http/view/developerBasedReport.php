
	<h1>Persoonlijk tijdsrapport van {naam_developer}</h1>
	<?php
	foreach($projects as $prj)
	{
	?>
	<table>
		<tr><th>Datum<th>Costcentre<th>Aantal uren</tr>
		<?php
		foreach($imputatiedagen as $dg)
		{
			?>
			
			<?php
			$dagteller = 0;
			foreach($costcentres_used as $cc)
			{
			?>
				<tr>
					<td><?php echo $dagteller == 0 ? $datum : '&nbsp;';?></td>
					<td>{cc}</td>
					<td>{totaal_uren_vandaag_op_cc}</td>
				</tr>
			<?php
			}
			
		}
		?>
		<tr>
			<td colspan="2"><h3>Totaal:</h3></td>
			<td>{totaal_uren_op_project}</td>
		</tr>	
	</table>
	
	<?php	
	}
	?>
