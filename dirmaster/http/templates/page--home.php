<!DOCTYPE html>
<html lang="nl">
<?php include $r_head?>
<body>
<?php include $r_regions['header']?>

<div class="container">

<?php foreach ($r_regions as $k=>$v) {
	if($k != 'header')
	include $v;
}?>
</div> <!-- /container -->

</body>
</html>
