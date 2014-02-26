<?php

$filename = 'address_book.csv';
$address_book = readCSV($filename);

function writeCSV($filename, $rows) {
  $handle = fopen($filename, "w");
  foreach ($rows as $row) {
    fputcsv($handle, $row);
  }
  fclose($handle);
}

readCSV($filename);


function readCSV($filename) {
  $contents = [];
  $handle = fopen($filename, "r");
  while (($data = fgetcsv($handle)) !== FALSE) {
    $contents[] = $data;
  }
  fclose($handle);
  return $contents;
}

// validation time!
if (!empty($_POST)) {

    $name = ($_POST['name']);
    $address = ($_POST['address']);
    $city = ($_POST['city']);
    $state = ($_POST['state']);
    $zip = ($_POST['zip']); 

    $entry = [$name, $address, $city, $state, $zip];
    array_push ($address_book, $entry);
    writeCSV($filename, $address_book);
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

    </tr>
          <? foreach ($address_book as $entries) : ?>
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



<!-- Marilyn Manson saw your address book!
<img src="/img/amused_marilyn_manson.jpg" alt="Manson has your Address Book!"> -->


</body>
</html>