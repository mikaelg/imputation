<?php namespace Common;


class ProjectStatus extends \SplEnum
{
	const __default 	= 1; 

	const RUNNING		= 1;
	const FROZEN		= 2;
	const FINISHED		= 3;
}

?>