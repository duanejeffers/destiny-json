<?php
    /* cli.class.php
     * cli.class is meant to be a simple include for the commandline. It provides _autoloading functionality for other classes and options handling.
     * You can extend the class or even pass it as a simple cli object.
     * See cli.func.php for the function version of this class.
     *
     * @package cli.class
     * @author Duane Jeffers <duane@duanejeffers.com>
     * 
     */
    
    class cliException extends Exception {
        
    }
    
    class cli {
        
        /* Constants */
        /* Animation Constants */
        const AnimTypeCycle      = 1;
        const AnimTypeElipsis    = 2;
        const AnimCycleDefault   = 4;
        const AnimCycleEighthSec = 1;
        const AnimCycleFourthSec = 2;
        const AnimCycleThree8Sec = 3;
        const AnimCycleHalfSec   = 4;
        const AnimCycleFive8Sec  = 5;
        const AnimCycleThree4Sec = 6;
        const AnimCycleSeven8Sec = 7;
        const AnimCycleOneSec    = 8;
        
        /* Output Color Constants */
        const ColorFgBlack    = '0;30';
        const ColorFgRed      = '0;31';
        const ColorFgGreen    = '0;32';
        const ColorFgBrown    = '0;33';
        const ColorFgBlue     = '0;34';
        const ColorFgPurple   = '0;35';
        const ColorFgCyan     = '0;36';
        const ColorFgLtGray   = '0;37';
        const ColorFgDkGray   = '1;30';
        const ColorFgLtRed    = '1;31';
        const ColorFgLtGreen  = '1;32';
        const ColorFgYellow   = '1;33';
        const ColorFgLtBlue   = '1;34';
        const ColorFgLtPurple = '1;35';
        const ColorFgLtCyan   = '1;36';
        const ColorFgWhite    = '1;37';
        
        const ColorBgBlack   = '40';
        const ColorBgRed     = '41';
        const ColorBgGreen   = '42';
        const ColorBgYellow  = '43';
        const ColorBgBlue    = '44';
        const ColorBgMagenta = '45';
        const ColorBgCyan    = '46';
        const ColorBgLtGray  = '47';
        
        /* Public Static Functions */
        
        /* color_str() is a static function that returns a formatted string to echo to STDOUT
         *
         * @param string $string The string to be colorized.
         * @param string $fore The foreground color. Must be a const ColorFg*
         * @param string $back The background color. Must be a const ColorBg*
         * @return string The color encapsulated string.
         */
        public static function color_str($string, $fore = self::ColorFgRed, $back = NULL) {
            $ret_string = '';
            if(is_string($fore)) {
                $ret_string .= "\033[" . $fore . "m";
            }
            
            if(is_string($back)) {
                $ret_string .= "\033[" . $back . "m";
            }
            
            $ret_string .= $string . "\033[0m";
            return $ret_string;
        }
        
        /* Private Variables */
        
        /* Protected Variables */
        protected $_options      = array();
        protected $_autoloadOpts = array('pre' => NULL, 'post' => '.class', 'ext' => '.php');
        protected $_verbose      = FALSE; // Defaults to false. This will add a 'verbose' and 'v' option to the extended options. - IF v or verbose is one of the list of options, then the code will not over ride that.
        protected $_help         = array(); 
        protected $_process      = FALSE; // Process is the variable that is used to enable startProcess and endProcess.
        protected $_script;
        protected $_argv;
        
        /* Public Variables */
        
        /* Private Functions */
        
        /* Protected Functions */
        
        /* _autoload is the main autoloading class.
         *
         * @param string $class The class name to pass to the include.
         */
        protected function _autoload($class) {
            $inc_file = $this->_autoloadOpts['pre'] . $class . $this->_autoloadOpts['post'] . $this->_autoloadOpts['ext'];
            include $inc_file;
        }
        
        protected function argv_process() {
            global $argv;
            $this->_script = $argv[0];
            $this->_argv = array_shift($argv);
        }
        
        /* Public Functions */
        
        /* opt() will check to see if the option was called.
         *
         * @param string $option This is the option being called.
         * @param bool $return If true, this will return the value of the option
         * @return mixed Will return TRUE or FALSE if the return is FALSE, else it will return the value if it exists.
         */
        public function opt($option, $return = FALSE) {
            if(array_key_exists($option, $this->_options) && $return) {
                return $this->_options[$option];
            } elseif(array_key_exists($option, $this->_options)) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
        
        public function print_line($msg) {
            echo $msg . "\n";
        }
        
        public function print_dump($msg) {
            echo var_export($msg, true) . "\n";
        }
        
        /* print_help prints out a nicely formatted help message with the description in the options array. 
         *
         * @param string $opt The option that the application is expecting.
         * @param string $msg Any message to send as a prepend before displaying the options.
         * @param bool $quit Will exit out of the cli program.
         */
        public function print_help($opt, $msg = NULL, $quit = FALSE) {
            if(!$this->opt($opt)) {
                return;
            }
            $this->print_line($msg);
            
            $dash = function($key) {
                if(strlen($key) > 1)
                    return '--' . $key;
                else return '-' . $key;
            };
            
            $switch = array();
            foreach($this->_help as $key => $val) {
                if(substr($key, -2) == '::') {
                    // Not a required value
                    $key = trim($key, '::');
                    $key = $dash($key) . '(=<optional_value>)';
                } elseif(substr($key, -1) == ':') {
                    // A required value
                    $key = trim($key, ':');
                    $key = $dash($key) . '=<required_value>';
                } else {
                    $key = $dash($key);
                }
                $switch[$key] = $val;
            }
            
            $white_space = max(array_map('strlen', array_keys($switch)));
            $this->print_line(NULL);
            
            array_walk($switch, function($desc, $key) use ($white_space) {
                echo str_pad($key, $white_space) . ' | ' . $desc . "\n";
            });
            
            if($quit) {
                $this->print_line(NULL);
                die();
            }
        }
        
        /* include_path allows for setting include paths for the application.
         *
         * @param array $paths an array with the path locations to set the include paths. */
        public function include_path(array $paths) {
            $inc_paths = '';
            foreach($paths as $path) {
                $inc_paths .= PATH_SEPARATOR . $path;
            }
            
            set_include_path(get_include_path() . PATH_SEPARATOR . $inc_paths);
            
            return $this;
        }
        
        /* autoload sets up the cli object as an autoloader.
         *
         * @param string $post The postfix for the class file name. DEFAULT: '.class'
         * @param string $pre The prefix for the class file name. DEFAULT: NULL
         * @param string $ext The include extension. Useful for adding: '.inc.php' DEFAULT: '.php'
         */
        public function autoload($post = '.class', $pre = NULL, $ext = '.php') {
            $this->autoload = array('post' => $post, 'pre' => $pre, 'ext' => $ext);
            spl_autoload_register(array($this, '_autoload'));
            
            return $this;
        }
        
        /* verbose() is an alias of print_line, with the added function to check if the -v or --verbose switch is sent.
         *
         * @param string $msg The message to send to STDOUT
         */
        public function verbose($msg) {
            if($this->_verbose) {
                $this->print_line($msg);
            }
        }
        
        /* anim() will only animate once, based on they animation type.
         * Current Animation Types:
         *  - cycle
         *  - elipsis
         *
         * @param string $msg Message to display before the animation.
         * @param int $anim The Animation Type. (See: Contstants.)
         * @param int $cycle Animation Speed (1/8 of a second * $cycle). Default is 4 - Half a Second.
         * @param bool $newline Keeps the last line on screen, instead of disappearing on the next output.
         */
        public function anim($msg = NULL, $anim = self::AnimTypeCycle, $cycle = self::AnimCycleDefault, $newline = FALSE) {
            switch($anim) {
                case self::AnimTypeCycle:
                    // Animation Array:
                    foreach(array("\\", "-", "/", "|") as $char) {
                        echo $msg ." " . $char;
                        usleep((125000 * $cycle)); // One eighth of a second.
                        echo ($newline ? "\n" : "\r");
                    }
                    break;
                
                case self::AnimTypeElipsis:
                    echo $msg;
                    for($i = 0; $i < 3; $i++) {
                        echo '.';
                        usleep((125000 * $cycle));
                    }
                    echo ($newline ? "\n" : "\r");
                    break;
            }
        }
        
        /* startProcess() uses pcntl_fork to create a child process that executes the animation, while code is still executing.
         * To stop the process, stopProcess() must be called.
         *
         *
         */
        public function startProcess($msg = NULL, $anim = self::AnimTypeCycle, $cycle = self::AnimCycleDefault, $newline = FALSE) {
            if($this->_verbose) { return; } // return to allow for verbose output.
            
            if(!function_exists('pcntl_fork'))
            {
                // exit gracefully and do not run the fork code.
                $this->anim($msg, $anim, $cycle, $newline);
                return;
            }
            
            // First we create the fork ...
            $this->_process = pcntl_fork(); // This is the PID. Will return 0 if child, else, we assume the rest is the parent.
            
            if($this->_process == 0) {
                // This is the child process. We execute the animation.
                do {
                    $this->anim($msg, $anim, $cycle, $newline);
                } while(pcntl_sigwaitinfo(array(SIGSTOP)));
            } elseif($this->_process == -1) {
                throw new cliException('Could Not Start Child Process');
            } else {
                // Now this is the parent.
                ob_start(); // Turn off all output.
                return;
            }
        }
        
        /* stopProcess() kills the child process and returns the view to the parent
         */
        public function stopProcess() {
            if($this->_verbose || !function_exists('pcntl_fork')) { return; }
            ob_end_clean();
            
            posix_kill($this->_process, SIGSTOP);
            
            return;
        }
        
        /* argv() allows you to return the captured information from argv
         *
         * @param int $id The key for the argv value requested.
         * @return mixed The value of argv[$id];
         */
        public function argv($id) {
            return $this->argv[$id];
        }
        
        
        
        /* __construct sets up the cli object for running.
         * The options array is setup as such: array('<option>' => '<description>'); - <description> can be NULL
         *
         * @param array $options sets up a list of switches that the cli application is expecting.
         * @param bool $v Defaults to TRUE, this enables the -v switch.
         * @param bool $verbose Defaults to FALSE, this enables the --verbose switch.
         * @return object The instanciated class.
         */
        public function __construct(array $options, $v = TRUE, $verbose = FALSE) {
            $long_opts = $opts = array();
            $this->_help = $options;
            // Cycle through the array and add the options.
            foreach(array_keys($options) as $opt) {
                if((strlen($opt) > 3)) { // short opts can have up to three characters. If your longopt is 3 characters, rethink it ...
                    // This is an extended option. - add to the longOpt arr.
                    $long_opts[] = $opt;
                } else {
                    // This is a simple option.
                    $opts[] = $opt;
                }
            }
            
            // Check if overriding the verbosity.
            if($v) {
                $opts[] = 'v';
                $this->_help['v'] = 'Allow Application to Print Output to the Screen.';
            }
            
            if($verbose) {
                $long_opts[] = 'verbose';
                $this->_help['verbose'] = 'Allow Application to Print Output to the Screen.';
            }
            
            $this->_options = getopt(implode($opts), $long_opts); // Set the options.
            
            if(($v && $this->opt('v'))) {
                $this->_verbose = TRUE;
            } elseif(($verbose && $this->opt('verbose'))) {
                $this->_verbose = TRUE;
            }
            
            $this->argv_process();
            return $this;
        }
    }