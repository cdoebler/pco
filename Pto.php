<?php

/**
 * Main class for Pto
 * @author Christian Doebler <info@christian-doebler.net>
 */
class Pto {
	private $funcArgs = array(
		'explode'		=> 1,
//		'implode'		=> NOT NECESSARY
		'str_replace'	=> 2,
	);
	
	/**
	 * last result and first input when starting up
	 * @var mixed
	 */
	private $result = false;
	
	
	/**
	 * initializer for static calls
	 * @param mixed $input
	 * @return Pto 
	 */
	public static function init($input = false)
	{
		return new Pto($input);
	}
	
	/**
	 * class constructor
	 * @param mixed $input 
	 */
	public function __construct($input = false)
	{
		$this->result = $input;
	}
	
	/**
	 * call wrapper
	 * @param string $func function name
	 * @param array $args function arguments
	 */
	public function & __call($func, $args)
	{
		if (function_exists($func)) {
			$args = $this->prepareArgs($func, $args);
			$this->result = call_user_func_array($func, $args);
		} else {
			throw new PtoException('Function \'' . $func . '\' does not exist!');
		}
		
		return $this;
	}
	
	/**
	 * returns current result
	 * @param boolean $dummy not used
	 * @return mixed 
	 */
	public function __get($dummy = false)
	{
		return $this->result;
	}
	
	/**
	 * provides string for echoes
	 * @return string
	 */
	public function __toString()
	{
		return $this->result;
	}
	
	/**
	 * prepares function parameters by injecting input variable and last result
	 * @param string $func function name
	 * @param array $args function args
	 * @return array processed function args 
	 */
	private function prepareArgs($func, $args)
	{
		if (isset($this->funcArgs[$func]) && $this->funcArgs[$func] !== false) {
			$argsTmp = array_chunk($args, $this->funcArgs[$func]);
			$args = array_shift($argsTmp);
			$args[] = $this->result;
			$args = array_merge($args, $argsTmp);
			
		} else {
			$args[] = $this->result;
			
		}
		
		return $args;
	}
}

/**
 * Pto exceptions
 * @author Christian Doebler <info@christian-doebler.net>
 */
class PtoException extends Exception {
}

/**
 * shortcut to Pto initialization
 * @param mixed $input
 * @return Pto 
 */
function pto($input = false) {
	return new Pto($input);
}
