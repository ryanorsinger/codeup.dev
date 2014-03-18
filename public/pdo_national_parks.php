<?php

// Instantiates a new connection to the databasse

$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_mysqli_test_db', 'codeup', 'password');

// tell PDO to throw exceptions on error (rather than returning FALSE)
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Gather user input, validate input, and sanitizing
if (!empty($_POST)) {

    // CREATE the preapared statement
    $stmt = $dbc->prepare("INSERT INTO national_parks (name, location, description, date_established, area_in_acres) 
                        VALUES (:name, :location, :description, :date_established, :area_in_acres)");

    // BIND parameters 
    $stmt->bindValue(":name", $_POST['name'], PDO::PARAM_STR);
    $stmt->bindValue(":location", $_POST['location'], PDO::PARAM_STR);
    $stmt->bindValue(":description", $_POST['description'], PDO::PARAM_STR);
    $stmt->bindValue(":date_established", $_POST['date_established'], PDO::PARAM_STR);
    $stmt->bindValue(":area_in_acres", $_POST['area_in_acres'], PDO::PARAM_STR);

    //execute query; return results
    $stmt->execute();

}

// Set default values for Query if GET is not empty
$sortCol = 'name';
$sortOrder = 'asc';

$validCols = ['name', 'location', 'description', 'date_established', 'area_in_acres'];

// this handles the GET links used to sort by which column and which direction asc or desc

if (isset($_GET['sort_column']) && (in_array($_GET['sort_column'], $validCols))) {  
    $sortCol = $_GET['sort_column'];
    
    if ((isset($_GET['sort_order'])) && ($_GET['sort_order'] == 'desc')) {
        $sortOrder = 'desc';
    }
} 

$result = $dbc->query("SELECT name, location, description, date_established, area_in_acres FROM national_parks ORDER BY $sortCol $sortOrder");
    

?>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/datepicker.css">

</head>
<body>

<div class="col-md-10 col-md-offset-1">
    <h1>National Parks of the USA <small> a CodeUp project for using MySQLi within PHP</small></h1>
</div>

<!-- give id, name, type, placeholder -->
<form class="form-horizontal" method="POST" action="national_parks.php" enctype="multipart/form-data">
    <div class="form-group">
        <label for="parkname" class="col-sm-2 control-label">Park Name</label>
            <div class="col-sm-7">
            <input type="text" class="form-control" id="parkname" name="name" placeholder="enter park name">
            </div>
    </div>
    <div class="form-group">
        <label for="location" class="col-sm-2 control-label">Location</label>
            <div class="col-sm-7">
            <input type="text" class="form-control" id="location" name="location" placeholder="Park Location">
            </div>
    </div>
    <div class="form-group">
        <label for="park-description" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-7">
            <input type="text" class="form-control" id="park-description" name="description" placeholder="Park Description">
            </div>
    </div>
    <div class="form-group">
        <label for="date_established" class="col-sm-2 control-label">Date Established</label>
            <div class="col-sm-7">
            <input type="date" class="span2" name="date_established" id="date_established" data-date-format="yyyy-mm-dd" placeholder="pick the date established">
            </div>
    </div>
    <div class="form-group">
        <label for="park_area" class="col-sm-2 control-label">Area in Acres</label>
            <div class="col-sm-7">
            <input type="text" class="form-control" id="park_area" name="area_in_acres" placeholder="area in acres">
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
                    <a href="?sort_column=name&amp;sort_order=asc" span class="glyphicon glyphicon-chevron-up"></span></a>
                    <a href="?sort_column=name&amp;sort_order=desc" span class="glyphicon glyphicon-chevron-down"></span></a>
                </th>
                
                <th>Location
                <br>
                    <a href="?sort_column=location&amp;sort_order=asc" span class="glyphicon glyphicon-chevron-up"></span></a>
                    <a href="?sort_column=location&amp;sort_order=desc" span class="glyphicon glyphicon-chevron-down"></span></a>
                </th>
                <th>Description
                <br>
                    <a href="?sort_column=description&amp;sort_order=asc" span class="glyphicon glyphicon-chevron-up"></span></a>
                    <a href="?sort_column=description&amp;sort_order=desc" span class="glyphicon glyphicon-chevron-down"></span></a>
                </th>
                <th>Date Established
                <br>
                    <a href="?sort_column=date_established&amp;sort_order=asc" span class="glyphicon glyphicon-chevron-up"></span></a>
                    <a href="?sort_column=date_established&amp;sort_order=desc" span class="glyphicon glyphicon-chevron-down"></span></a>
                </th>
                <th>Area in Acres
                <br>
                    <a href="?sort_column=area_in_acres&amp;sort_order=asc" span class="glyphicon glyphicon-chevron-up"></span></a>
                    <a href="?sort_column=area_in_acres&amp;sort_order=desc" span class="glyphicon glyphicon-chevron-down"></span></a>
                </th>
            </tr> 
            <tr>
        </thead>

<?php

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
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


<script src="js/bootstrap-datepicker.js">
  ('.datepicker').datepicker();
</script>

</body>
</html>