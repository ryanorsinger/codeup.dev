<?php

class Filestore {

//    public $filename = 'todo.txt';
    public $filename = '';

    private $is_csv = FALSE;

    public $items = array();

    function __construct($filename = 'todo.txt') {
        if(!empty($filename)){
        // Sets $this->filename
                $this->filename = $filename;
            }
        if (substr($filename, -3) == 'csv') {
            $this->is_csv == TRUE;
        }

    }

    public function read() {
        if ($this->is_csv == TRUE) {
            $this->read_csv();
        } else {
        $this->read_lines();
        }
    }

    public function write() {
        if($this->is_csv == TRUE) {
            $this->write_csv($address_book);
        } else { 
            $this->write_lines($items);
        } 
    }

    /**
     * Returns array of lines in $this->filename
     */
    public function read_lines() {
        if(filesize($this->filename) == 0) {
        return array();
            }
            $handle = fopen($this->filename, 'r');
            $contents = fread($handle, filesize($this->filename));
            $items = explode("\n", $contents);
            fclose($handle);
            return $items;
    }

    public function write_lines($items) {
        var_dump($items);
        $string = implode("\n", $items);
        $handle = fopen($this->filename, 'w');
        fwrite($handle, $string);
        fclose($handle);
    }

     /**
     * Writes each element in $array to a new line in $this->filename
     */

    public function get_list() {
        if (filesize($this->filename) > 0) {
            return $this->read_lines($this->filename);
        } else {
            return array();
        }
    }

    /**
     * Reads contents of csv $this->filename, returns an array
     */
    public function read_csv() {
        $contents = [];
        $handle = fopen($this->filename, "r");
        while (($data = fgetcsv($handle)) !== FALSE) {
            $contents[] = $data;
        }
        fclose($handle);
        return $contents;
    }

    /**
     * Writes contents of $array to csv $this->filename
     */
    public function write_csv($address_book) {
            $handle = fopen($this->filename, 'w');
            foreach ($address_book as $row) {
                fputcsv($handle, $row);
                }
            fclose($handle);
        }

}