<?php

class AddressDataStore {
    public $filename = '';

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

    public function writeCSV($rows) { 
      $handle = fopen($this->filename, "w");
      foreach ($rows as $row) {
        fputcsv($handle, $row);
      }
      fclose($handle);
    }

    public function save_file($file, $array) {
    $handle = fopen($file, 'w');
    $saveList = implode("\n", $array);
    fwrite($handle, $saveList);
    fclose($handle);
    }


    function read_file($file) {
    $handle = fopen($file, "r");
    $setFile = filesize($file);
    if ($setFile > 0) {
      $contents = fread($handle, filesize($file));
      fclose($handle);
      return explode("\n", $contents);  
    } else {
      echo "You don't have any items on your list!";
      return array();
    }
}
}


// Create an instance of AddressDataStore called $ads
// $ads is my first instance of an Object 
$ads = new AddressDataStore();

// On the $ads object instance, pass the filename property to be the filename variable.
$ads->filename = 'address_book.csv';

// set $records to store the results of running the readCSV() method on the $ads object instance
$records = $ads->readCSV();
$entries = [];
$errorMessage = [];

//delete entries to remove
if (isset($_GET['remove'])) {
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
        <th></th>
        <th>Name</th>
        <th>Address</th>
        <th>City</th>
        <th>State</th>
        <th>Zipcode</th>
        <th>Phone</th>
    </tr>

          <? foreach ($records as $key => $entries) : ?>
          <tr>
              <td><a href='?remove=<?=$key?>'>Delete</a></td>
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

<script>(alert('<? var_dump($errorMessage); ?>'))</script>

<hr>
<br><br><br><br>
<p></p>
<p></p>
<p></p>
Marilyn Manson saw your address book!
<img src="/img/amused_marilyn_manson.jpg" alt="Manson has your Address Book!">


</body>
</html>