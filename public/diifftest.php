<?php
	
	// Including file address_data_store.php to access class AddressDataStore
	require_once('address_data_store.php');

	// Create a new instance of AddressDataStore
	$chat = new AddressDataStore('data/address_book.csv');
	
	// Declaring address_book array
	$address_book = array();

	// Declaring entries array
	$entries = array();

	// Setting $address_book to method read_address_book in the $chat object
	$address_book = $chat->read_address_book();	

	// Declaring errors $arrayName = array('' => , )
	$errors = [];

	// If $_POST is not empty
	if (!empty($_POST)) {
		$entry = [];
		$entry['name'] = $_POST['name'];
		$entry['address'] = $_POST['address'];
		$entry['city'] = $_POST['city'];
		$entry['state'] = $_POST['state'];
		$entry['zip'] = $_POST['zip'];
		$entry['phone'] = $_POST['phone'];

		// Each $entry value is temporarily stored in $value
		foreach ($entry as $key => $value) {
			// If $value is empty
			if (empty($value)) {
				// Add $value . "must have a value" to errors array
				$errors[] = "<strong><em>". ucfirst($key) . "</em></strong>" . " must have a value.";
			// If $value is not empty
			} else {
				// Add $value to the entries array
				$entries [] = $value;
			}
		}

		// If $errors is empty
		if (empty($errors)) {
			// Add values from the entries array to $address_book
			array_push($address_book, array_values($entries));
			// Save $address_book to 'data/address_book.csv'
			$chat->write_address_book($address_book);
			// Declaring raw header to prevent entry being added to CSV each time webpage is refreshed
			header('Location: address_book.php');
		}
	}

	// Verify there were uploaded files and no errors and the file being uploaded is in text format
	if (count($_FILES) > 0 && $_FILES['file1']['error'] == 0 && $_FILES['file1']['type'] == 'text/csv') {
		// Set the destination directory for uploads
		$upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
		// Grab the filename from the uploaded file by using basename
		$file_name = basename($_FILES['file1']['name']);
		// Create the saved filename using our upload directory and the file's original name
		$saved_filename = $upload_dir . $file_name;
		// Move the file from the temp location to our uploads directory
		move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);
		// Setting filename in $chat instance of AddressDataStore to $saved_filename
		$chat->filename = $saved_filename;
		// Convert uploaded file to an array
		$uploaded_items = $chat->read_address_book();
		// Setting filename in $chat instance of AddressDataStore to 'data/address_book.csv'
		$chat->filename = 'data/address_book.csv';
		// Merge converted uploaded file to existing array of todos
		$items = array_merge($address_book, $uploaded_items);
		$chat->write_address_book($items);
		header('Location: address_book.php');
		exit(0);
	} elseif (count($_FILES) > 0 && $_FILES['file1']['type'] != 'text/csv') {
		echo "<strong>ERROR! File format is invalid! Please upload a CSV file.</strong>";	
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Address Book</title>
	</head>
	<body>
		<h1>Address Book</h1>
			<table>
						<? foreach ($address_book as $key => $value) { ?>
				<tr>
							<? foreach ($value as $new_row) { ?>
							<td><? echo $new_row; ?></td>
							<? }	?>
							<td><?= " <a href=?remove={$key}>Remove Contact</a>"; ?></td>
							
							<? if (isset($_GET['remove'])) {
								$key = $_GET['remove'];
								unset($address_book[$key]);
								$chat->write_address_book($address_book);
								header('Location: address_book.php');
								exit(0);
							}
							?>
				</tr>
						<? } ?>
			</table>
			<ul>
				<?php
					foreach ($errors as $error) {
						echo "<li>" . $error . "</li>";
					}
				?>
			</ul>
		<h1>New Entry</h1>
			<form method="POST" action="/address_book.php">
				<p>
					<label for="name">Name: </label>
					<input id="name" name="name" type="text">
				</p>
				<p>
					<label for="address">Address: </label>
					<input id="address" name="address" type="text">
				</p>
				<p>
					<label for="city">City: </label>
					<input id="city" name="city" type="text">
				</p>
				<p>
					<label for="state">State: </label>
					<input id="state" name="state" type="text">
				</p>
				<p>
					<label for="zip">Zip: </label>
					<input id="zip" name="zip" type="text">
				</p>
				<p>
					<label for="phone">Phone: </label>
					<input id="phone" name="phone" type="text">
				</p>

				<button type="submit">Submit</button>
			</form>
		<h2>Upload File</h2>
			<form method="POST" enctype="multipart/form-data" action="/address_book.php">
				<p>
					<label for="file1">File to upload: </label>	
					<input type="file" id="file1" name="file1">
				</p>
				<p>
					<input type="submit" value="Upload">
				</p>
			</form>
		
	</body>
</html>