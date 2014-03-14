<?php

$mysqli = @new mysqli('127.0.0.1', 'codeup', 'password', 'codeup_mysqli_test_db');

// check for errors
if ($mysqli->connect_errno) {
    throw new Exception('Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}


// Query to get the parks if GET is not empty
if (!empty($_GET)) {
    $sortCol = $_GET['sort_column'];
    $sortOrder = $_GET['sort_order'];
    $result = $mysqli->query("SELECT * FROM national_parks ORDER BY $sortCol $sortOrder");
} else {
    $result = $mysqli->query("SELECT * FROM national_parks");
}


?>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">



</head>
<body>

<div class="col-md-10 col-md-offset-1">
    <h1>National Parks of the USA <small> a CodeUp project for using MySQLi within PHP</small></h1>
</div>


<div class="col-md-10 col-md-offset-1">
    <table class="table table-striped">
        <thead>
            <tr>
               <!--  <th><a href="?sort_column=name&sort_order=asc">Park Name</th> -->
                <th>Park Name
                <br>
                    <a href="?sort_column=name&sort_order=asc" span class="glyphicon glyphicon-chevron-up"></span></a>
                     <a href="?sort_column=name&sort_order=desc" span class="glyphicon glyphicon-chevron-down"></span></a>
                </th>
                
                <th>Location
                <br>
                    <a href="?sort_column=location&sort_order=asc" span class="glyphicon glyphicon-chevron-up"></span></a>
                     <a href="?sort_column=location&sort_order=desc" span class="glyphicon glyphicon-chevron-down"></span></a>
                </th>
                <th>Description
                <br>
                    <a href="?sort_column=description&sort_order=asc" span class="glyphicon glyphicon-chevron-up"></span></a>
                     <a href="?sort_column=description&sort_order=desc" span class="glyphicon glyphicon-chevron-down"></span></a>
                </th>
                <th>Date Established
                <br>
                    <a href="?sort_column=date_established&sort_order=asc" span class="glyphicon glyphicon-chevron-up"></span></a>
                     <a href="?sort_column=date_established&sort_order=desc" span class="glyphicon glyphicon-chevron-down"></span></a>
                </th>
                <th>Area in Acres
                <br>
                    <a href="?sort_column=area_in_acres&sort_order=asc" span class="glyphicon glyphicon-chevron-up"></span></a>
                     <a href="?sort_column=area_in_acres&sort_order=desc" span class="glyphicon glyphicon-chevron-down"></span></a>
                </th>
            </tr> 
            <tr>
        </thead>
      
            <?php
                while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['location'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";     
                echo "<td>" . $row['date_established'] . "</td>";
                echo "<td>" . $row['area_in_acres'] . "</td>";
                echo "</tr>";
                }
            ?>

    </table>

</div>




</body>
</html>