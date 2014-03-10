<?php

require_once('address_data_store.php');

class InvalidInputException extends Exception{}
class InputTooLongException extends Exception{}
class InputEmptyException extends Exception{}

$book = new AddressDataStore('address_book.csv');

$address_book = $book->read();
 
$book->write($address_book);

$errorMessage =[];
try {
	if (!empty($_POST)) {
		$entry =[];
		$entry['name'] = $_POST['name'];
		$entry['address'] = $_POST['address'];
		$entry['city'] = $_POST['city'];
		$entry['state'] = $_POST['state'];
		$entry['zip'] = $_POST['zip'];

		foreach ($entry as $key => $value) {
			if (strlen($value) >= 125) {
				throw new InputTooLongException ("The $key attribute has maximum length of 125 characters");
			}

			if (empty($value)) {
				array_push($errorMessage, "$key must have value.");
				throw new InputEmptyException ("Please try again. $key input must not be blank");
			}
		}

		if(empty($errorMessage)) {
		array_push($address_book, array_values($entry));
		$book->write($address_book);
		}
	}
} 

catch (InputEmptyException $e) {
	echo "Please try again. $key input must not be blank";
}

catch (InputTooLongException $e) {
	echo "Please try again. The $key attribute has maximum length of 125 characters";
}


// remote item from address book
if (isset($_GET['remove'])){
	unset($address_book[$_GET['remove']]);
	$book->write($address_book);
	header('Location: addressbook.php');	
}

if (count($_FILES) > 0 && $_FILES['file1']['error'] == 0){
	if ($_FILES['file1']['type'] != 'text/csv') {
		$errorMsg = 'Invalid File type';
		echo $errorMsg;
	} else {
		$upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
		$new_file = basename($_FILES['file1']['name']);
		$saved_filename = $upload_dir . $new_file;
		move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);

	    $newfile = new AddressDataStoreLower($saved_filename);

	    $addFile = $newfile->read();

	    if (isset($_POST['over1']) && $_POST['over1'] == TRUE){
	    	$address_book = $addFile;
	    }else{
			foreach ($addFile as $key => $item) {
	        	array_push($address_book, $addFile[$key]);
	    	}
		} 
    $book->write($address_book);    
    }
}


?>

<!DOCTYPE html>

<html>
<head>
	<title>Address Book</title>
</head>
<body>

	<h2>Address Book</h2>

	<table>
			<? foreach ($address_book as $key => $row) { ?> 
				<tr>
				<? foreach ($row as $entry) { ?>
					 <?= "<td>" . htmlspecialchars(strip_tags($entry))  .  "</td>"; } ?>
					<td> <a href='?remove=<?=$key ?>'>Remove Item</a></td>
				<? } ?>

				</tr>
	</table>
	
	<form method="POST" enctype="multipart/form-data" action="/addressbook.php" id="add-address">
		<p>
			<label>Name: </label>
			<input type="text" name="name" id="name" placeholder="Enter Name">
		</p>
		<p>
			<label>Address: </label>
			<input type="text" name="address" id="address" placeholder="Enter Address">
		</p>
		<p>
			<label>City: </label>
			<input type="text" name="city" id="city" placeholder="Enter City">
		</p>
		<p>
			<label>State: </label>
			<input type="text" name="state" id="state" placeholder="Enter State">
		</p>
		<p>
			<label>Zip: </label>
			<input type="text" name="zip" id="zip" placeholder="Enter Zip">
		</p>
		<p>
			<input type="submit" value="add new address" >
		</p>
		<p>
	</form>
	<br>
	<hr>
	<form method="POST" enctype="multipart/form-data" action="/addressbook.php" id="add-file">
		
			<label for="file1">add file:</label>
			<input type="file" id="file1" name="file1" >
		</p>
		<P>
			<input type="submit" value="Upload">
			<label><input type="checkbox" id="over1" name="over1" value="checked">Over Write</label>
		</p>
	</form>

</body>
</html>