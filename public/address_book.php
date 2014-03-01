<?php

class AddressDataStore {
    public $filename = '';
    public $contents = [];
    public $entry = [];
    public $entries = array();
    public $contacts = [];
    //public $rows = [];

// set construct to get the file
   public function __construct($filename = '') {
        $this->filename = $filename;
    }

// Open $this->filename for reading return contents of the CSV
     public function readCSV() {
        // Open $this->filename for reading 
        $contents = [];
        $handle = fopen($this->filename, "r");
        while (($data = fgetcsv($handle)) !== FALSE) {
          $contents[] = $data;
          }
        fclose($handle);
        return $contents;
    }

// save $rows to $this->filename CSV
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
      array_push($this->contacts, $entry);
      $this->writeCSV($this->contacts);
      }

  // Remove item from list, redirect optional
    public function remove_Entry($key, $redirect = FALSE) {
      unset($this->entries[$key]);
      $this->writeCSV($rows);
        if (is_string($redirect)) {
          header("Location: $redirect");
          exit(0);  
    } 
  //   // Merge a second AddressDataStore into this one
  //   public function mergeAddressBooks(AddressDataStore $book) {

  // }
  }
// end of class
}

// Create an instance of AddressDataStore called $address_book
$address_book = new AddressDataStore();

// On the $address_book instance, pass the filename property to be the filename variable.
$address_book->filename = 'data/address_book.csv';

// perform the readCSV method on address_book instance and save all existing contacts to $contacts
$contacts = $address_book->readCSV();

// set error messages to an empty array. 
$errorMessages = [];

// Check for removal from list - process if exists
if (isset($_GET['remove'])) {
  
  $address_book->remove_Entry($_GET['remove'], 'address_book.php');
}


// if the POST is not empty, then we can move on to validate the values.
if (!empty($_POST)) { 
  $entry['name'] = $_POST['name'];
  $entry['address'] = $_POST['address'];
  $entry['city'] = $_POST['city'];
  $entry['state'] = $_POST['state'];
  $entry['zip'] = $_POST['zip'];

    foreach ($entry as $key => $value) {
      if(empty($value)) {
          array_push($errorMessages, "$key must contain data"); 
        } else {
          $entry['phone'] = $_POST['phone'];
          array_push($entry, $entry['phone']);
        }
      }

    if (empty($errorMessage)) {
      $contacts = array_push($contacts, $entry);
      // push the $entry array onto the $records array
      $address_book->add_Entry($contacts);
    }
}

echo "var_dump of \$contacts";
var_dump($contacts);

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

          <? foreach ($contacts as $key => $contact) :  ?>
          <tr>
              <td><a href='?remove=<?=$key?>'>Delete</a></td>
            
            <? foreach ($contact as $field) : ?>
            
            <td><?=$field;?></td>
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