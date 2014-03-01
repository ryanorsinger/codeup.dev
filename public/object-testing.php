<?php

class Conversation {

	// PROPERTY to hold name 
	public $first_name = '';
	public $last_name = '';

	// METHOD to say hello to name
	function say_hello($newline = FALSE)
	{
		$greeting = "Hello {$this->first_name} {$this->last_name}";
		if ($newline == FALSE) {
			return $greeting;
		} else {
			return $greeting . PHP_EOL;
		}
	}

	function say_goodbye()
	{
		return "Goodbye {$this->first_name} {$this->last_name}";
	}
}

// Create a new instance of Conversation
// this instantiates the class and we create a variable $chat to hold that/THIS particular instance.
$chat = new Conversation();

// Set the $name variable
$chat->first_name = 'Ryan';
$chat->last_name = 'Orsinger';

// echo out the instance of chat with the firstname property
//echo $chat->first_name;


?>

<html>
	<head>
	<title>Title is <?=$chat->say_hello(); ?></title>
</head>
<body>
	<?=$chat->say_hello();?>
	<hr>
	<?=$chat->say_goodbye(); ?>

</body>
</html>