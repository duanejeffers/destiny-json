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
	 * File: library/Destiny/Header.php
	 * Purpose: The Header object is for calling header related items.
	 */

class Destiny_Header
{
	public static function call404($errMsg = NULL, $errCode = NULL, $errClass = NULL)
	{
		$arg = func_get_args();
		
		$err_message = '';
		foreach($arg as $id => $val)
		{
			if(!is_null($val))
			{
				switch($id)
				{
					case  0:
						$err_message .= 'Error Message';
						break;
					
					case 1:
						$err_message .= 'Error Code';
						break;
					
					case 2:
						$err_message .= 'Calling Class';
						break;
				}
				$err_message .= ' :' . $val;
			}
			$err_message .= "<br />\n";
		}
		
		header("HTTP/1.0 404 Not Found");
		echo '<h1>Error Getting Method.</h1><br />' . "\n\n";
		echo $err_message;
		echo "Destiny v" . DEST_VER;
		die();
	}
}