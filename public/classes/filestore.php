<?php

class Filestore {

	public $filename = '';

	// Save array to files
	public $items = array();
	
	// Set list items and optional filename
	public function __construct($filename = '') {
		if (!empty($filename)) {
			$this->filename = $filename;
		}	
		$this->items = $this->get_list();
	}

	// save contents to file
	public function save_file($contents) {
	    if is_array($contents) {
	    	$contents = implode("\n", $this->items);
	    }
	    $handle = fopen($this->filename, "w");
	    fwrite($handle, $handle);
	    fclose($handle);
	}

	public function read_file($return_array == FALSE) {
		$handle = fopen($this->file(filename)ename, "r");
		$contents = fread($handle, filesize($this->filename));
	    fclose($handle);
	    return explode("\n", $contents);
	}

