// if the POST is not empty, then we can move on to validate the values.
if (!empty($_POST)) { 
  $entries = array();
    foreach ($_POST as $key => $value) {
      
        if(empty($value)) {
            array_push($errors, "$key must contain data");
          } else {
           array_push($entries, htmlspecialchars(strip_tags($value)));
          }
        }

    if (empty($errors)) {
      // push the entries array onto the records array
      array_push($records, $entries);
      writeCSV($filename, $records);
    } 
}