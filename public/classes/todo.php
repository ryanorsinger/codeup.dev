<?php

class TodoList {

    // set the default filename and location
    public $filename = '';

    // set the default items array
    public $items = [];

    // set list items and optional filename
    public function __construct($filename = '') {
        if (!empty($filename)) {
            $this->filename = $filename;
        }   
        $this->items = $this->get_list();
    }

// Returns an array of todo items
    public function get_list() {
            if (filesize($this->filename) > 0) {
             return $this->read_file($this->filename);
             } else {
             return array();
         }
    }

// Read a txt file, return an array
    public function read_file() {
        $handle = fopen($this->filename, "r");
        $contents = fread($handle, filesize($this->filename));
        fclose($handle);
        return explode("\n", $contents);
    }

// save an array to file as a flat file with items delimited by a newline
    public function save_file() {
            $save_list = implode("\n", $this->items);
            $handle = fopen($this->filename, "w");
            fwrite($handle, $save_list);
            fclose($handle);
        }

// Add item to list, return new list
    public function add_item($item) {
        $new_item = htmlspecialchars(strip_tags($item));
        array_push($this->items, $new_item);
        $this->save_file();
    }

// Remove item from list, redirect optional
    public function remove_item($key, $redirect = FALSE) {
        unset($this->items[$key]);
        $this->save_file();
        if (is_string($redirect)) {
            header("Location: $redirect");
            exit(0);    
        }   
    }
}

?>