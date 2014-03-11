<?php

class Conversation {

    // Property to hold name
    public $name = '';

    function __construct($name = '')
    {
        $this->name = $name;
    }

    // Method to say hello to name
    function say_hello($new_line = FALSE) 
    {
        // Set the greeting name
        $greeting = "Hello {$this->name}";

        // Return the greeting, checking for newline
        return $new_line == TRUE ? "$greeting\n" : $greeting;
    }

}

class LocationConversation extends Conversation {

    // Property for location
    public $location = '';

    // Method to say hello from location
    function say_hello_from_location($new_line = FALSE) 
    {
        // Set the greeting name
        $greeting = "{$this->say_hello()} from {$this->location}";

        // Return the greeting, checking for newline
        return $new_line == TRUE ? "$greeting\n" : $greeting;
    }

}

// Create a new instance of LocationConversation
$local_chat = new LocationConversation('Codeup');

// Check if we can still run methods from parent
echo $local_chat->say_hello(TRUE);

// Set a location
$local_chat->location = 'San Antonio';

// Use the new new method
echo $local_chat->say_hello_from_location(TRUE);