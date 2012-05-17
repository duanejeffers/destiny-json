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
	 * File: public/index.php
	 * Purpose: Main index file.
	 *
	 * 	- All routes are pointed to ?u= in rewrite.
	 *  -
	 */

// Defining an APP_PATH for the system.
defined('APP_PATH') || define('APP_PATH', realpath(dirname(__FILE__) . '/../application'));

// Defining the ERR_LOG for the system.
defined('ERR_LOG') || define('ERR_LOG', realpath(dirname(__FILE__) . '/../data/logs') . '/error.log');

// Defining the INTER_DB for the system.
defined('INTER_DB') || define('INTER_DB', realpath(dirname(__FILE__) . '/../data/db') . '/destiny.db');

// Setup the include path.
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APP_PATH . '/../library'),
	realpath(APP_PATH),
    get_include_path(),
)));


// Include the configuration.
$cfg = include('../config.php'); // This should be returned as an object.

// Include Library File.
require_once 'Destiny/Application.php';

// Make sure to add the config variables and the REQUEST var
$app = new Destiny_Application($cfg, $_REQUEST);

// Render and Display
$app->run();

