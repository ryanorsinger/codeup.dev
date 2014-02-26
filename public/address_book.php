<?php

$address_book = [
    ['The White House', '1600 Pennsylvania Avenue NW', 'Washington', 'DC', '20500'],
    ['Marvel Comics', 'P.O. Box 1527', 'Long Island City', 'NY', '11101'],
    ['LucasArts', 'P.O. Box 29901', 'San Francisco', 'CA', '94129-0901']
];

$address_book = [];
$address_book[0] = ['name'];
$address_book[1] = ['email'];
$address_book[2] = ['github'];
$address_book[3] = [''];



$handle = fopen('address_book.csv', 'w');

foreach ($address_book as $fields) {
    fputcsv($handle, $fields);
}
fclose($handle);

?>


<h2> Enter New To Do Items </h2>

    <form method="POST" enctype="multipart/form-data" action="">
         <p>
          <label for="new_todo">New To Do</label>
          <input id="new_todo" name="new_todo" type="text" autofocus="autofocus" placeholder="type new todo here">
        <br>
            <input type="submit" value="Add Item">
        </form>