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
	 * File: library/Destiny/Config.php
	 * Purpose: The main Configuration object.
	 */

class Destiny_Config
{
	protected $_cfg = array();
	
	/* map
	  This will make sure that config options are adherant to the key options.
	  PLEASE NOTE: These are system level config options, so, you 
	  @param array $cfg The Configuration Array */
	protected function map($cfg = array())
	{
		foreach($cfg as $key => $val)
		{
			switch($key)
			{
				/* approved list */
				case 'project_vars': // This is for the project's variables. Basically, a personal array for your project.
				case 'registry':
				case 'cache':
					$this->_cfg[$key] = $val;
					break;
				
				/* unapproved */
				default:
					Destiny_Log_Logger::writeErrLog('Configuration Key: ' . $key . ' is not allowed.', __CLASS__);
					break;
			}
		}
		
		return TRUE;
	}
	
	public function addRegistry($reg_arr, $position = -1)
	{
		$reg = $this->_cfg['registry'];
		switch((int) $position)
		{
			case -1:
				$reg = array_merge($reg, $reg_arr);
				break;
			
			case 0:
				$reg = array_merge($reg_arr, $reg);
				break;
			
			default:
				$reg = array_merge(array_slice($reg, 0, ($position - 1)), $reg_arr, array_slice($reg, $position));
				break;
		}
		
		return $this->map(array('registry', $reg));
	}
	
	public function __set($name, $val)
	{
		$this->map(array($name, $val));
	}
	
	public function __get($name)
	{
		if(array_key_exists($name, $this->_cfg))
		{
			return $this->_cfg[$name];
		}
	}
	
	public function __construct($cfg = array())
	{
		if(!is_array($cfg))
		{
			Destiny_Log_Logger::writeErrLog('__construct arg is not an Array', __CLASS__, 34);
			throw new Exception('Config not an array');
		}
		
		$this->map($cfg);
		return $this;
	}
}