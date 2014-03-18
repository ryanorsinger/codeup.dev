<?php

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