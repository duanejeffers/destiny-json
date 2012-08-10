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
	 * File: library/Destiny/Request.php
	 * Purpose: The Request Object.
	 * Features: The map parser.
	 */

class Destiny_Request
{
	protected $_post;
	protected $_get;
	protected $_request;
	//protected $_map = array();
	
	/* map_query - Deprecating?
	  This function splices apart the query to determine the appropriate class to call.
	private function map_query()
	{
		$q = $this->_get['q']; 
		
		$this->_map['q_prop']['arr'] = explode('/', $q);
		$this->_map['q_prop']['method'] = array_pop($this->_map['q_prop']['arr']);
		$this->_map['q_prop']['class'] = implode('_', $this->_map['q_prop']['arr']);
		
		// Now we check to see if this class exists. 
		if(!class_exists($this->_map['q_prop']['class']) || !method_exists($this->_map['q_prop']['class'], $this->_map['q_prop']['method']))
		{
			$this->_map['q_prop']['class']  = 'Destiny_Error';
			$this->_map['q_prop']['method'] = 'throw404';
		}
	}
	*/
	
	public function __construct()
	{
		// Grab Server variables.
		
		$this->_get     = $_GET;
		$this->_post    = $_POST;
		$this->_request = $_REQUEST;
		
		// Next map the q request variable.
		
		//$this->map_query();
		return $this;
	}
	
	public function __get($name)
	{
		switch($name)
		{
			case 'post':
				return $this->_post;
			
			case 'get':
				return $this->_get;
			
			case 'request':
				return $this->_request;
		}
	}
}