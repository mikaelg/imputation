<?php namespace Common;

class AddressType extends \SplEnum
{
	const __default 			= 1;
	
    const MAIL_ADDRESS			= 1;
	const VISITING_ADDRESS		= 2;
	const INVOICING_ADDRESS		= 3;
}

?>