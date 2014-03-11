<?php

require_once('filestore.php');

class AddressDataStore extends Filestore {

}

class AddressDataStoreLower extends AddressDataStore {

	function __construct ($filename = 'address_book.csv') {
		$this->filename = strtolower($filename);
		parent::__construct($filename);
	}

}