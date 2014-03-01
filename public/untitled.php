<?php

class A {
	public $a_message = "hello from a";


	function __construct() {
		$this->echoLine('class A __construct');
	}

	function sayHello() {
		$this->echoLine($this->a_message);
	}

	function echoLine($message) {
		echo $message . PHP_EOL;
	}
}

// 
class B extends A {
	public $b_message = "hello from b";

	function __construct() {
		$this->echoLine('Class B __costruct');
	}
}

$b = new B();
$b->sayHello();

