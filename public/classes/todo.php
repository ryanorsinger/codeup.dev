<?php
 
require_once('classes/filestore.php');


// Todo list requires everything in filestore.php to run
class TodoList extends Filestore {
 
	// I'm commenting out the line below because these are inherited from the parent filestore.php
	// public $filename = 'data/todo_list.txt';
 
	// Set the defaults items array
	public $items = array();
 
	// Set list items and optional filename
	public function __construct($filename = '') {
		if (!empty($filename)) {
			$this->filename = $filename;
		}	
		$this->items = $this->get_list();
	}
 
	// Save array to files
	public function save_file() {
	    $save_list = implode("\n", $this->items);
	    $handle = fopen($this->filename, "w");
	    fwrite($handle, $save_list);
	    fclose($handle);
	}
 
	// Read a txt file, return an array
	public function read_file() {
	    $handle = fopen($this->filename, "r");
	    $contents = fread($handle, filesize($this->filename));
	    fclose($handle);
	    return explode("\n", $contents);
	}
 
	// Returns an array of todo items
	public function get_list() {
		if (filesize($this->filename) > 0) {
			return $this->read_file($this->filename);
		} else {
			return array();
		}
	}
 
	// Add item to list, return new list
	public function add_item($item) {
		$new_item = htmlspecialchars(strip_tags($item));
		array_push($this->items, $new_item);
		$this->save_file($this->items);
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

 
// Get new instance of TodoList
$todo_list = new TodoList();
 
// Check for removal from list - process if exists
if (isset($_GET['remove'])) {
	$todo_list->remove_item($_GET['remove'], 'todo-list.php');
}
 
// Check for new item - process if exists
if (!empty($_POST['newitem'])) {
	$todo_list->add_item($_POST['newitem']);
}
 
?>