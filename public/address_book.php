<?php

$address_book = [
    ['The White House', '1600 Pennsylvania Avenue NW', 'Washington', 'DC', '20500'],
    ['Marvel Comics', 'P.O. Box 1527', 'Long Island City', 'NY', '11101'],
    ['LucasArts', 'P.O. Box 29901', 'San Francisco', 'CA', '94129-0901']
];

// $address_book['input'][0] = 'name';
// $address_book['input'][1] = 'address';
// $address_book['input'][2] = 'city';
// $address_book['input'][3] = 'state';
// $address_book['input'][4] = 'zip';

// $handle = fopen('address_book.csv', 'w');

// foreach ($address_book as $fields) {
//     fputcsv($handle, $fields);
// }
// fclose($handle);

var_dump($_POST);

// // check if $_POST['new_todo'] is set
//         if (!empty($_POST['field'])) {
//             // strip tags and escape user input
//             $item = htmlspecialchars(strip_tags($_POST['field']));
//             $results = array_push($items, $item);
//             save_file($filename, $items);
//             header("Location: address_book.php");
//         }


?>


<!DOCTYPE html>
<html>
<head>
	<title>Address Book</title>
</head>
<body>
	<h2> Welcome to the Address Book </h2>
	<br>
	<p>
	</p>


<table>
    <tr>
        <th>Name</th>
        <th>Address</th>
        <th>City/th>
        <th>State</th>
        <th>Zipcode</th>
    </tr>
    <tr>
        <td>Row 1, Column 1</td>
        <td>Row 1, Column 2</td>
        <td>Row 1, Column 3</td>
        <td>Row 1, Column 4</td>
    </tr>
    <tr>
        <td>Row 2, Column 1</td>
        <td>Row 2, Column 2</td>
        <td>Row 2, Column 3</td>
        <td>Row 2, Column 4</td>
    </tr>
</table>
    
<h2> Enter Folks Into My Address Book </h2>

    <form method="POST" enctype="multipart/form-data" action="">

         <p>
          <label for="new_todo">New To Do</label>
          <input id="new_todo" name="new_todo" type="text" autofocus="autofocus" placeholder="type new todo here">
        <br>
            <input type="submit" value="Add Item">
        </form>


<!-- Marilyn Manson saw your address book!
<img src="/img/amused_marilyn_manson.jpg" alt="Manson has your Address Book!"> -->


</body>
</html>
