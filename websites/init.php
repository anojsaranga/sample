<?php
/**
*  Created by Anoj
*/
class Init
{
	public static function get($path = null)
	{
		if ($path)
		{
			$config = $GLOBALS['config'];
            $path   = explode('/', $path);

            foreach($path as $bit) 
            {
                if(isset($config[$bit])) 
                {
                    $config = $config[$bit];
                }
            }
            return $config;
		}
		return false;
	}			//public static function get($path = null)
	
}			//class Init
?>