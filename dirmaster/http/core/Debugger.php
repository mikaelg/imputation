<?php namespace be\imputation;
	class Debugger{
	
		const DEBUG_MODE = 1;
		public static function debug_echo($_msg)
		{
			if(self :: DEBUG_MODE == 1)
			{
				echo $_msg . '<br />';
			}
		}
	
	
	}

?>