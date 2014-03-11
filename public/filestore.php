<?php

class Filestore {

    public $filename = 'todo.txt';

    private $is_csv = FALSE;

    public $items = array();

    public function __construct($filename = '') {
        if(!empty($filename)){
                $this->filename = $filename;

                if (strtolower(substr($filename, -3)) == 'csv') {
                    $this->is_csv = TRUE;
                }
            }
    }


    public function read(){
        if ($this->is_csv == TRUE){
            return $this->read_csv();
        } else {
            return $this->read_lines();

        }

    }

    public function write($array){
        if ($this->is_csv == FALSE){
            $this->write_lines($array);
        } else {
            $this->write_csv($array);
        }
    }
    /**
     * Returns array of lines in $this->filename
     */
    private function read_lines() {
        if(filesize($this->filename) == 0) {
        return array();
            }
            $handle = fopen($this->filename, 'r');
            $contents = fread($handle, filesize($this->filename));
            $items = explode("\n", $contents);
            fclose($handle);
            return $items;
    }

    private function write_lines($items) {
        //var_dump($items);
        $string = implode("\n", $items);
        $handle = fopen($this->filename, 'w');
        fwrite($handle, $string);
        fclose($handle);
    }

    

    // public function get_list() {
    //     if (filesize($this->filename) > 0) {
    //         return $this->read_lines($this->filename);
    //     } else {
    //         return array();
    //     }
    // }

   
    private function read_csv() {
        $contents = [];
        $handle = fopen($this->filename, 'r');
        while (($data = fgetcsv($handle)) !== FALSE) {
            $contents[] = $data;
        }
        fclose($handle);
        return $contents;
    }

    /**
     * Writes contents of $array to csv $this->filename
     */
    private function write_csv($array) {
            $handle = fopen($this->filename, 'w');
            foreach ($array as $row) {
                fputcsv($handle, $row);
                }
            fclose($handle);
        }

}