<?php

class AddressEntry {

    public $name;
    public $address;
    public $city;
    public $state;
    public $zip;
    public $phone;

    public $errorMessages = array();

   
    // Take in array from CSV or POST & assign values
    public function __construct(array $values = array()) {
      //Take in an array from CSV or POST
      
  
    }

    // Return boolean: is entry valid?
    public function validate() {
        //
    }

    // Return values as an array for CSV output
    public function getArray() {

    }
}

class AddressDataStore {
    public $filename = '';
    public $entries = array();
    
    public function __construct($file = '') {
        $this->filename = $file;
    }

    public function readCSV() {
        // Open $this->filename for reading
        $contents = []; 
        $handle = (fopen($this->filename, "r"));
          while(($data = fgetcsv($handle)) !== FALSE) {
              $contents[] = $data;
            }
          fclose($handle);
          return $contents;
        }

    public function writeCSV() {
      // Open file for write
        // Iterate over $entries
        // Call getArray() on each entry
        // fputcsv() array to file
        // Close file
      $handle = fopen($this->filename, "w");
        foreach ($rows as $row) {
          fputcsv($handle, $row);
        }
      fclose($handle);
    }  

        // Push a new entry onto the $entries array
    public function addEntry(AddressBookEntry $entry) {
        // Push $entry onto $entries
    }

    // Remove a given entry from the $entries array
    public function removeEntry($index) {
        // Unset entry at $index
    }      
}

$addressEntry = new AddressEntry();
$ads = new AddressDataStore();

$ads->filename = 'address_book.csv'
$records = (readCSV($filename));

// Check for removal from list - process if exists
if (isset($_GET['remove'])) {
  $->remove_item($_GET['remove'], '.php');
}


// if the POST is not empty, then we can move on to validate the values.
if (!empty($_POST)) { 
  $formEntry = [];
  $formEntry['name'] = $_POST['name'];
  $formEntry['address'] = $_POST['address'];
  $formEntry['city'] = $_POST['city'];
  $formEntry['state'] = $_POST['state'];
  $formEntry['zip'] = $_POST['zip'];

    foreach ($formEntry as $key => $value) {
      if(empty($value)) {
          array_push($errorMessage, "$key must contain data"); 
        } else {
          $formEntry['phone'] = $_POST['phone'];
          array_push($formEntry, $value);
        }
      }

    if (empty($errorMessage)) {
      // push the entries array onto the records array
      array_push($records, $formEntry);
      // use method on $ads object instance to write $records
      $ads->writeCSV($records);
     
    } 
}


?>


<!DOCTYPE html>
<html>
<head>
  <title>Address Book</title>
</head>
<body>
  <h2> Welcome to the Address Book </h2>
     <table>
    <tr>
        <th>Name</th>
        <th>Address</th>
        <th>City</th>
        <th>State</th>
        <th>Zipcode</th>
        <th>Phone</th>

    </tr>
          <? foreach ($records as $entries) : ?>
          <tr>
            <? foreach ($entries as $fields) : ?>
       
            <td><?=$fields;?></td>
              <? endforeach; ?>
          </tr>
          <? endforeach; ?>

    
      </table>

<br>

</br>
<h2> Enter Folks Into My Address Book </h2>

    <form method="POST" enctype="multipart/form-data" action="">
          <label for="name">Name</label>
          <input id="name" name="name" type="text" placeholder="name goes here">
          <br>
          <label for="address">Address</label>
          <input id="address" name="address" type="text" placeholder="address goes here">
          <br>
          <label for="city">City</label>
          <input id="city" name="city" type="text" placeholder="name goes here">
          <br>
          <label for="state">State</label>
          <input id="state" name="state" type="text"  placeholder="state goes here">
          <br>
          <label for="zip">Zipcode</label>
          <input id="zip" name="zip" type="text" placeholder="zipcode goes here">
          <br>
          <label for="phone">Phone Number</label>
          <input id="phone" name="phone" type="text"  placeholder="phone goes here">

        <br>
            <input type="submit" value="Submit">
        </form>






</body>
</html>