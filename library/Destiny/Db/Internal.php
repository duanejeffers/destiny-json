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
	 * File: library/Destiny/Db/Internal.php
	 * Purpose: The main output of the application.
	 * Features: It's own autoloader.
	 */

// This is the default
class Destiny_Db_Internal
{
	protected $_dbAdapter;
	
	public function writeLog($message, $classname)
	{
		
	}
	
	// __construct will connect to the internal database system and then pass it to the system.
	public function __construct()
	{
		if(is_file(INTER_DB))
		{
			$skipQuery = TRUE;
		}
		$this->_dbAdapter = new PDO('sqlite:'.INTER_DB);
		
		if(!$skipQuery)
		{
			// path to schema:
			$schema = file_get_contents(realpath(APP_PATH . '/../data/db') . '/schema.sql');
			$this->_dbAdapter->query($schema);
		}
		return $this;
	}
}