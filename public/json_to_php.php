<?php

$entry = [
	'name' => 'Someone',
	'address' => 'wherever',
	'city' => 'somewhere',
	'state' => 'whatever state you are in'

];

// this produces or encodes the PHP $entry array as a string. 
// It encodes the key=>value pair with JSON. the "object notation" part of the JSON
echo json_encode($entry) . PHP_EOL;

// this is a string converted to a JSON object
$entryJSON = '{"name":"Someone","address":"wherever","city":"somewhere","state":"whatever state you are in"}';

//echo json_encode($entry) . PHP_EOL;

$obj = json_decode($entryJSON, true);

var_dump(json_decode($entryJSON));
