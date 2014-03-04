<?php

class UnexpectedTypeException extends Exception {}

class LoginException extends Exception {}

class InvalidUsernameException extends Exception {}



class Conversation {

    // Property to hold name
    private $name = '';

    /**
     * Optional - allows name to be passed 
     * when the class is instantiated
     */
    public function __construct($name = '')
    {
        $this->set_name($name);
    }

    /**
     * Setter for $name
     * Filters and prepares $name
     */
     private function set_name($name) 
     {
         // Check if $name is a string
         if (!is_string($name)) {
            throw new UnexpectedTypeException('$name must be a string');
         }
         // Set the name property
         // Trim all leading and trailing whitespace 
         $this->name = trim($name);

     }

    /**
     * Return the name property in a descriptive string
     */
    public function get_name()
    {
        // return name with some fluff
        return "The name property on this instance of this class is '{$this->name}'";
    }

    /**
     * Method to say hello to name
     */
    public function say_hello($new_line = FALSE) 
    {
        // Set the greeting name
        $greeting = "Hello {$this->name}";

        // Return the greeting, checking for newline
        return $new_line == TRUE ? "$greeting\n" : $greeting;
    }

}

try {
    // try as a float (double)
    $chat = new Conversation(323.32);
} catch (UnexpectedTypeException $e) {
    // Try again as a string if double failed
    $chat = new Conversation(false);
}

echo $chat->say_hello(TRUE);
