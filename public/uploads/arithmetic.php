<?php

get_input()

function add($a, $b) {
	echo $a + $b;
	echo "\n";
}

function subtract($a, $b) {
	echo $a - $b;
	echo "\n";
}

function multiply($a, $b) {
	$c = $a * $b;
	echo $c . PHP_EOL;
}

function divide($a, $b) {
	$c = $a / $b;
	echo $c . PHP_EOL;
}

function modulus($a, $b) {
	$c = $a % $b;
	echo $c . PHP_EOL;
}

fwrite(STDOUT, "input the first variable \n");
$firstnum = trim(fgets(STDIN));

fwrite(STDOUT, "input the second variable \n");
$secondnum = trim(fgets(STDIN));

fwrite(STDOUT, "input if you want to (a)dd, (s)ubtract, (m)ultiply, (d)ivide, or (m)odulus \n");
$input = trim(fgets(STDIN));
	if ($input == 'a') {
		return add($a, $b); 
	} 