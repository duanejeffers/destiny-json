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
	 * File: library/Destiny/Router.php
	 * Purpose: The Router class for deciding if the route over rides the class call.
	 */

class Destiny_Router
{
	protected $_class;
	protected $_method;
	protected $_url;
	protected $_namespace;
	protected $_req;
	
	// parse() splices the url and determines the Called Object and Method.
	protected function parse()
	{
		
	}
	
	public function getRender()
	{
		
	}
	
	/** the construct
	 * @param Destiny_Request $req The Destiny_Request Object.
	 */
	public function __construct(Destiny_Request $req)
	{
		// First thing's first. - We check to see if there is anything to route.
		if(!($req instanceof Destiny_Request))
		{
			Destiny_Header::call404('Invalid Request Item', 500, __CLASS__);
		}
		$this->_req = $req;
		
	}
}