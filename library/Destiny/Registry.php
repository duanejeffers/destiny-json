<?php
	/**
	 * Destiny JSON Server
	 * Written By Duane Jeffers <duane@duanejeffers.com>
	 * Copyright (c) 2012 Duane Jeffers
	 * Permission is hereby granted, free of charge, to any person obtaining a copy
	 * of this software and associated documentation files (the "Software"), to deal
	 * in the Software without restriction, including without limitation the rights
	 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	 * copies of the Software, and to permit persons to whom the Software is furnished
	 * to do so, subject to the following conditions:
	 *
	 * The above copyright notice and this permission notice shall be included in
	 * all copies or substantial portions of the Software.
	 *
	 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
	 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
	 * IN THE SOFTWARE.
	 *
	 * File: library/Destiny/Registry.php
	 * Purpose: The main output of the application.
	 * Features: It's own autoloader.
	 */

class Destiny_Registry
{
	protected static $_registry = array();
	
	/* static set
	  @param string $reg_name The Registry Key
	  @param object $val_obj The Registering Object */
	public static function set($reg_name, $val_obj)
	{
		if(!array_key_exists($reg_name, self::$_registry)) // We want to register this ASAP.
		{
			return self::$_registry[$reg_name] = $val_obj;
		} else // The key existed before.
		{
			unset(self::$_registry[$reg_name]); // This is to allow any destructors to run.
			
			return self::$_registry[$reg_name] = $val_obj;
		}
	}
	
	/* static get
	  @param string $reg_name The Registry Key.
	  @return object The Registered Object. */
	public static function get($reg_name)
	{
		return self::$_registry[$reg_name];
	}
	
	/* static init
	  This has the option to have one array argument or two string arguments.
	  Array:
	  @param array $init_list An Array with RegKey => RegObjName. The Registered Object must not have any required args in the __constructor
	  String:
	  @param string $reg_name The Registry Key
	  @param string $reg_obj_name The New Registered Object. */
	public static function init()
	{
		switch(func_num_args())
		{
			case 1:
				foreach(func_get_arg(0) as $reg_name => $reg_obj_name)
				{
					$reg = new $reg_obj_name();
					self::set($reg_name, $reg);
					unset($reg);
				}
				return TRUE;
			
			case 2:
				return self::set(func_get_arg(0), func_get_arg(1));
				
			default:
				// Throw Error;
				return FALSE;
		}
	}
}