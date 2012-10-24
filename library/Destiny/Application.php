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
	 * File: library/Destiny/Application.php
	 * Purpose: The main output of the application.
	 * Features: It's own autoloader.
	 */
	
defined(DEST_VER) || define("DEST_VER", "v0.1");

class Destiny_Application
{
	protected $_config;
	
	/* _autoload
	  @param string $class Autoloaded class. */
	private function _autoload($class)
	{
		// Split off the name to see if the file exists.
		$filename = implode('/', explode('_', $class)) . '.php';
		
		if(is_file($filename))
		{
			include $filename; // include the file for the class.
		} else
		{
			// Write issue to log.
			Destiny_Log_Logger::writeErrLog('Class File Does Not Exist', __CLASS__, 42);
		}
	}
	
	/* __construct
	  @param object|array $cfg The Configuration Options. */
	public function __construct($cfg)
	{
		spl_autoload_register(array($this, '_autoload')); // Register the Autoloader.
		
		// Load the Config.
		$config = new Destiny_Config($cfg);
		
		//$config->addRegistry(array('request' => 'Destiny_Request'), 0);
		//$config->addRegistry(array('router' => 'Destiny_Router'), 1);
		
		// Register the Registry. - Remove the registry??
		//Destiny_Registry::set('config', $config); // Set the config first, for the including registry items.
		//Destiny_Registry::init($config->registry);
		
		
		
		return $this;
	}
	
	/* run
	  This is the factory function to the default code. */
	public function run()
	{
		// First things first, we need to check the request to see if it's a routed obj or called.
		//$route = Destiny_Registry::get('router');
	}
}