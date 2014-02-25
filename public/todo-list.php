<?php

$filename = 'data/todo_list.txt';

// set the items array to the file contents if the file exists, otherwise PDF_makespotcolor(p, spotname) it an empty array
$items = (filesize($filename) > 0) ? $items = open_file($filename) : array();
$completed = array();

// this reads a file and returns the contents as an array
        function open_file($filename) {
            $handle = fopen($filename, "r");
            $contents = fread($handle, filesize($filename));
            fclose($handle);
            $contents_array = explode("\n", $contents);
            $items = $contents_array;
            return $items;
        }

// save an array to file as a flat file with items delimited by a newline
        function save_file($filename, $items) {
            $itemStr = implode("\n", $items);
            $handle = fopen($filename, "w");
            fwrite($handle, $itemStr);
            fclose($handle);
        }

// save completed items to a new file called completed.txt
        function completed_items($completed) {
            $handle = fopen('data/completed.txt', "a");
            fwrite($handle, $completed);
            fclose($handle);
        }


// reassign $items to equal the old todo list with the new items added merged to the bottom
//$items = (filesize($filename) > 0) ? $items = open_file($filename) : array();

        // check if $_POST['new_todo'] is set
        if (!empty($_POST['new_todo'])) {
            // echo "WE HAVE A NEW ITEM!";
            $item = ($_POST['new_todo']);
            $results = array_push($items, $item);
            save_file($filename, $items);
            header("Location: todo-list.php");
        }


        // It would be really really awesome to have the 'remove' set to 
        // move the removed array element onto a new array called completed!
        // We use the GET[remove] to get the element of the arry
        // then I pass the $items[completed] element over to the completed items function

        if(!empty($_GET['remove'])) {
            $completed = ($_GET['remove']);
            completed_items($items[$completed] . "\n");
            array_splice($items, $_GET['remove'], 1);
            save_file($filename, $items);
            header("Location: todo-list.php");
            die();   
        }

    if (count($_FILES) > 0 && $_FILES['file1']['type'] != 'text/plain') {
        echo "<p>Your file must be a 'text/plain' file type</p>";
        exit(1);
    }
      


    if (count($_FILES) > 0 && $_FILES['file1']['error'] == 0)  {
        // Set the destination directory for uploads
        $upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
        // Grab the filename from the uploaded file by using basename
        $newfile = basename($_FILES['file1']['name']);
        // Create the saved filename using the file's original name and our upload directory
        $saved_filename = $upload_dir . $newfile;
        // This concatenates the directory with the filename and gives us a saved filename and path.
        // Move the file from the temp location to our uploads directory
        move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);

        // explode items from new filename into an array. set the array equal to results;
        // merge the results array onto the items array

        $results = open_file($saved_filename);
        //var_dump($results);
        //var_dump($items);
        $items = array_merge($items, $results);
        //var_dump($items); 
        save_file($filename, $items);
    }


    ?>


<!DOCTYPE html>
<html>
    <head>
        <title>To Do List </title>
        <meta name="description" content="Ryan Orsinger's To Do list">
        <meta name="author" content="Ryan Orsinger">
    </head>
    <body>


<h1> TODO List: </h1>
<h2> The Awesome To Do List of My Great Agenda! </h2>
        
 
    <ul>        
        <?php
            foreach($items as $key => $item) {
                 echo "<li>$item <a href='?remove=$key'>Mark Item as Done</a></li>";
            }
        ?>
    </ul>


    <h3> Enter New To Do Items </h3>

    <form method="POST" enctype="multipart/form-data" action="">
         <p>
          <label for="new_todo">New To Do</label>
          <input id="new_todo" name="new_todo" type="text" autofocus="autofocus" placeholder="type new todo here">
        <br>
            <input type="submit" value="Add Item">
        </form>

<h3> Upload a Text File </h3>

        <form method="POST" enctype="multipart/form-data">
        <p>
            <label for="file1">File to upload: </label>
            <br>
            <input type="file" id="file1" name="file1">
            <br>
            <input type="submit" value="Upload (Append)">
           
        </p>
    </form>

<img src="/img/pirate-todo" alt="YARRRR">

    

    </body>
    
</html>