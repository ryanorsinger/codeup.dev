<?php

// select which table to use on the 'codeup_mysqli_test_db' database
$useTable = 'USE TABLE national_parks';

// Run query, if there are errors then display them
if (!$mysqli->query($useTable)) {
    throw new Exception("table does not exist or there is a problem (" . $mysqli->errno . ") " . $mysqli->error);
}

// this gives us back the key=>value pairs of everything from the national_parks table
$result = $mysqli->query("SELECT * FROM national_parks");

?>