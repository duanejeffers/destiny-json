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
	 * File: library/Destiny/Json.php
	 * Purpose: The simple object that helps return a JSON-formatted string or parses a JSON-formatted string.
	 * 		Additionally, the object can proceedurally generate new items for the resulting JSON string.
	 */
	
class Destiny_Json
{
	protected $_json = ''; // JSON-Formatted String
	protected $_method; // Encode or Decode
	protected $_data = array(); // The encoding or decoded data
	protected $_last; // Last array element that was added
	
	protected function jsonError()
	{
		switch(json_last_error())
		{
			case JSON_ERROR_NONE:
				return;
			
			
		}
	}
	
	public function addJSON($json)
	{
		$this->_json .= $json . "\n";
		
		return $this;
	}
	
	public function output()
	{
		switch($this->_method)
		{
			case 'decode':
				return $this->_data;
			
			case 'encode':
				return $this->_json;
		}
	}
	
	public function decode($arr = FALSE)
	{
		$this->_data = json_decode($this->_json, $arr);
		
		$this->jsonError();
		
		return $this;
	}
	
	public function encode($type = 'object')
	{
		if($type === 'object')
		{
			$this->_data = (object)$this->_data;
		}
		
		$this->_json = json_encode($this->_data);
		
		$this->jsonError();
		
		return $this;
	}
	
	/* __construct requires either decode or encode to set the object up.
	 * @param string $method A string of either (encode|decode). Default is 'encode'
	 */
	public function __construct($method = 'encode')
	{
		switch($method)
		{
			case 'decode':
				$this->_method = 'decode';
				break;
			
			case 'encode':
			default:
				$this->_method = 'encode';
				break;
		}
		return $this;
	}
}