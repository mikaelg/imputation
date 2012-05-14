<?php namespace Common;

/**
* This class is used to contain Address objects. the SPL class SplObjectStorage provides this functionality
* by default, so we can extend that. The need for a separate getMembers method is not necessary since the
* SplObjectStorage object implements Iterable, so you can use it directly in a foreach loop. Chances are 
* (so I've read on the internet) that you have to issue a rewind() call before you can iterate it, but we'll 
* see what happens soon enough :).
* 
* 
*/
class AddressCollection extends Collection
{
	protected static $myExceptionClass = 'Common\AddressCollectionException';
}

?>