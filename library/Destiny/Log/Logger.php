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
	 * File: library/Destiny/Log/Logger.php
	 * Purpose: This is the main Destiny log writer.
	 */

// This class is a static class.
class Destiny_Log_Logger
{
	protected static $_lines = array(); // These are the lines to be written for the session.
	
	public static function write($message, $class_name = NULL)
	{
		if(is_null($message))
		{
			throw new Exception('Message Required');
			return FALSE;
		}
		
		$db;
	}
	
	/* static writeErrLog
	  This is an immediate write. It does not have a "session" basis.
	  @param string $message The Log Message (required)
	  @param string $class_name Class Name that is calling the error
	  @param int|string $line Line Number the error occurs. */
	public static function writeErrLog($message, $class_name = NULL, $line = NULL)
	{
		if(is_null($message))
		{
			throw new Exception('Message Required');
			return FALSE;
		}
		
		$msg = array();
		$msg[] = date('r', time());
		
		if(!is_null($class_name))
			$msg[] = $class_name;
		
		if(!is_null($line))
			$msg[] = 'Line: ' . $line;
		
		$msg[] = $message;
		
		return file_put_contents(ERR_LOG, implode(' ', $msg) . "\n", FILE_APPEND);
	}
}