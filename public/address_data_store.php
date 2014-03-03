<?php

require_once('filestore.php');

class AddressDataStore extends Filestore {


	public $filename = '';

	function __construct ($filename = 'address_book.csv'){
		$this->filename = $filename;
	}

	function read_csv() {
		$contents = [];
		$handle = fopen($this->filename, "r");
		while (($data = fgetcsv($handle)) !== FALSE) {
			$contents[] = $data;
		}
		fclose($handle);
		return $contents;
	}

	function write_csv($address_book){
			$handle = fopen($this->filename, 'w');
			foreach ($address_book as $row) {
				fputcsv($handle, $row);
				}
			fclose($handle);
		}


}

class AddressDataStoreLower extends AddressDataStore {

	function __construct ($filename = 'address_book.csv') {
		$this->filename = strtolower($filename);
	}

	function read_csv() {
		$contents = [];
		$handle = fopen($this->filename, "r");
		while (($data = fgetcsv($handle)) !== FALSE) {
			$contents[] = $data;
		}
		fclose($handle);
		return $contents;
	}

	function write_csv($address_book){
			$handle = fopen($this->filename, 'w');
			foreach ($address_book as $row) {
				fputcsv($handle, $row);
				}
			fclose($handle);
		}	

}