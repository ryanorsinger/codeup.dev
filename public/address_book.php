<?php
class AddressDataStore {
    public $filename = '';
    public $contents = [];
    public $entry = [];
    public $entries = array();
    public $records = [];

// set construct to get the file
   public function __construct($filename = '') {
        $this->filename = $filename;
    }

// Open $this->filename for reading return contents of the CSV
    public function readCSV() {
        $handle = fopen($this->filename, "r");
        $contents = fread($handle, filesize($this->filename));
        fclose($handle);
        return $contents;
    }

// write contents of $rows array to $this->filename 
    public function writeCSV($rows) { 
      $handle = fopen($this->filename, "w");
      foreach ($rows as $row) {
        fputcsv($handle, $row);
      }
      fclose($handle);
    }
    
  // Push a new address entry onto the the $entries array
    public function add_Entry($entry) {
      //push $entry onto $entries
      array_push($this->records, $entry);
      writeCSV($this->records);
      }

  // Remove item from list, redirect optional
    public function remove_Entry($key, $redirect = FALSE) {
      unset($this->entries[$key]);
      $this->writeCSV();
        if (is_string($redirect)) {
          header("Location: $redirect");
          exit(0);  
    } 
  //   // Merge a second AddressDataStore into this one
  //   public function mergeAddressBooks(AddressDataStore $book) {

  // }
  }
}

// class AddressEntry {
//     public $name;
//     public $address;
//     public $city;
//     public $state;
//     public $zip;
//     public $phone;

//     public $errorMessages = array();

//     // Take in array from POST & assign values
//     public function __construct(array $values = array()) {
//         //
//     }

//     // Return boolean: is entry valid?
//     public function validate() {
//         //
//     }

//     // Return values as an array for CSV output
//     public function getArray() {

//     }
// }

// Create an instance of AddressDataStore called $ads
$ads = new AddressDataStore();

// On the $ads object instance, pass the filename property to be the filename variable.
$ads->filename = 'address_book.csv';

// set $records to store the results of running the readCSV() method on the $ads object instance
$records = $ads->readCSV();

//$entries = [];
$errorMessage = [];
$entry = [];


// Check for removal from list - process if exists
if (isset($_GET['remove'])) {
  $records->remove_Entry($_GET['remove'], 'address_book.php');
}

// if the POST is not empty, then we can move on to validate the values.
if (!empty($_POST)) { 
  $entry = [];
  $entry['name'] = $_POST['name'];
  $entry['address'] = $_POST['address'];
  $entry['city'] = $_POST['city'];
  $entry['state'] = $_POST['state'];
  $entry['zip'] = $_POST['zip'];

    foreach ($entry as $key => $value) {
      if(empty($value)) {
          array_push($errorMessage, "$key must contain data"); 
        } else {
          $entry['phone'] = $_POST['phone'];
          array_push($entry, $entry['phone']);
        }
      }

    if (empty($errorMessage)) {
      // push the $entry array onto the $records array
      array_push($records, $entry);
      // use method on $ads object instance to write $records
      $ads->writeCSV($records);
    } 
}

 

echo "\n var_dump \$records\n";
var_dump($records);

echo "\n var_dump of \$entry\n";
var_dump($entry);



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
        <th></th>
        <th>Name</th>
        <th>Address</th>
        <th>City</th>
        <th>State</th>
        <th>Zipcode</th>
        <th>Phone</th>
    </tr>

          <? foreach ($records as $key => $record) : ?>
          <tr>
              <td><a href='?remove=<?=$key?>'>Delete</a></td>
            
            <? foreach ($record as $value) : ?>
            
            <td><?=$value;?></td>
              <? endforeach; ?>
          </tr>
          <? endforeach; ?>

    
      </table>

<br>

</br>
<h2> Enter Folks Into My Address Book </h2>


    <form method="POST" enctype="multipart/form-data" action="">
          <label for="name">Name*</label>
          <input id="name" name="name" type="text" placeholder="name goes here">
          <br>
          <label for="address">Address*</label>
          <input id="address" name="address" type="text" placeholder="address goes here">
          <br>
          <label for="city">City*</label>
          <input id="city" name="city" type="text" placeholder="name goes here">
          <br>
          <label for="state">State*</label>
          <input id="state" name="state" type="text"  placeholder="state goes here">
          <br>
          <label for="zip">Zipcode*</label>
          <input id="zip" name="zip" type="text" placeholder="zipcode goes here">
          <br>
          <label for="phone">Phone Number (optional)</label>
          <input id="phone" name="phone" type="text"  placeholder=" phone goes here">

        <br>
            <input type="submit" value="Submit">
        </form>



<hr>
<br>

<p></p>
<p></p>
<p></p>
<p></p>
<p></p>
<p></p>
<p></p>
<!-- Marilyn Manson discovered a special correlation 
<br>between your completed "Todo Items" and your address book.
<br>
<p></p>
<img src="/img/amused_marilyn_manson.jpg" alt="Manson has your Address Book!">
 -->

</body>
</html>