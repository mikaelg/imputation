<?php

$testFiles = array();
$path = realpath('.');
	
if($handle = opendir($path)) 
{
    echo "Directory handle: $handle\n";
    echo "Entries:\n";

    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) 
    {
        if(strpos($entry, 'Test.php') !== false)
        {
        	$testFiles[] = $path.'/'.$entry;
        	require_once($path.'/'.$entry);
        }
    }

    closedir($handle);
}

//echo '<pre>' . print_r($testFiles,true) . '</pre>';

$suite  = new PHPUnit_TestSuite("StringTest");
$result = PHPUnit::run($suite);


?>