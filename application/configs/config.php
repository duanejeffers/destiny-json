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
	 * File: config.php
	 * Purpose: Main Configuration File.
	 */
	
	// Main Configuation Information.
	$config = array();
	
	// Router Settings.
	// This is where you can set the approved pages for the router.
	// This allows for all the content in the public directory to be called with clean URLs in Destiny.
	//- NOTE Please do not set this to TRUE this unless you don't think your system is going to be compromised.
	$config['router']['approved']['all'] = FALSE;
	
	$config['router']['approved'][] = 'main'; // NOTE: main is the alias for the root of the routing system.
	
	//$config['router']['approved'][] = 'signup'; // - This allows the router to accept /signup and then to include /public/signup.php
	
	// If you know you've been compromised and you want to completely disallow certain calls, use the denied array.
	// This allows for all the content in the public directory to be denied access unless it appears in the approved array.
	// - NOTE this is the ideal function, as it allows you to specifically allow certain files access.
	$config['router']['denied']['all'] = TRUE;
	
	// $config['router']['denied'][] = 'signup'; // - This removed the ability to use signup.
	
	
	
	// Caching Settings
	//$config['cache']['enabled'] = TRUE; // Cache is Enabled.
	//$config['cache']['length'] = '8600'; // How far in the future does the cache last.
	// -- Comment out the below lines and uncomment the lines above.
	$config['cache']['enabled'] = FALSE; // Cache is Disabled.
	
	// Database Settings
	// The Database settings are meant to be PDO database settings.
	//$config['db']['adapter'] = 'PDO';
	//$config['db']['connect'] = ''; // This is the connect string for PDO.
	
	
	
	
	

	// After This Point, PLEASE do not edit. This is meant to allow simple array creation
	return (array) $config;