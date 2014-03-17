<?php

require_once 'mysqli_call.php';


// Set default values for Query if GET is not empty
$sortCol = 'name';
$sortOrder = 'asc';

// this handles the GET links used to sort by which column and which direction asc or desc
if (!empty($_GET)) {
    $sortCol = $_GET['sort_column'];
    $sortOrder = $_GET['sort_order'];
    
    //$result = $mysqli->query("SELECT name, location, description, date_established, area_in_acres FROM national_parks ORDER BY $sortCol $sortOrder");
    
    // Step 1 is prepare the parameters
    $stmt = $mysqli->prepare("SELECT name, location, description, date_established, area_in_acres FROM national_parks ORDER BY $sortCol = ?, $sortOrder = ?");

    //Step 2 is to bind parameters
    $stmt->bind_param("ss", $_GET["sortCol"], $_GET["sortOrder"]);

    // Execute the query and return result
    $stmt->execute();

    // Bind results to variables
    $stmt->bind_result($sortCol, $sortOrder);


} else {
    $result = $mysqli->query("SELECT name, location, description, date_established, area_in_acres FROM national_parks");
}


// Gather user input
// if (!empty($_POST)) {

//   //CREATE the preapared statement
//   $stmt = $mysqli->prepare("INSERT INTO national_parks (name, description, location, date_established, area_in_acres") 
//     VALUES (?, ?, ?, ?, ?);

//   // BIND parameters
//   $stmt->bind_param("sssss", $_POST['name'], $_POST['description'], $_POST['location'], $_POST['date_established'], $_POST['area_in_acres']);

//     //execute query; return results
//     $stmt->execute();
// }








?>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">


</head>
<body>

<div class="col-md-10 col-md-offset-1">
    <br>
    <h1>National Parks of the USA <small> a CodeUp project for using MySQLi within PHP</small></h1>
</div>

<!-- give id, name, type, placeholder -->
<form class="form-horizontal" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="input-name" class="col-sm-2 control-label">Park Name</label>
    <div class="col-sm-7">
      <input type="name" class="form-control" id="parkname" placeholder="Enter National Park Name">
    </div>
  </div>
  <div class="form-group">
    <label for="input-location" class="col-sm-2 control-label">Park Name</label>
    <div class="col-sm-7">
      <input type="location" class="form-control" id="location" placeholder="Park Location">
    </div>
  </div>
   <div class="form-group">
    <label for="input-description" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-7">
      <input type="description" class="form-control" id="park-description" placeholder="Park Description">
    </div>
  </div>
   <div class="form-group">
    <label for="input-location" class="col-sm-2 control-label">Date Established</label>
    <div class="col-sm-7">
      <input type="date-for-sql" class="form-control" id="location" placeholder="yyyy-mm-dd">
    </div>
  </div>

 <div class="form-group">
    <label for="input-location" class="col-sm-2 control-label">Area in Acres</label>
    <div class="col-sm-7">
      <input type="area" class="form-control" id="park_area" placeholder="area in acres">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Add Park to Database</button>
    </div>
  </div>
</form>



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