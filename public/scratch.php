<?

        $completed = $_GET['remove'];
        //completed_items($completed);
        unset($items['remove']);
        unset($_GET);
        save_file($filename, $items);


// check for addition of items






$filename = 'data/todo_list.txt';

// set the items array to the file contents if the file exists, otherwise make it an empty array
$items = (filesize($filename) > 0) ? $items = open_file($filename) : array();
$completed = array();







// reassign $items to equal the old todo list with the new items added merged to the bottom
//$items = (filesize($filename) > 0) ? $items = open_file($filename) : array();

        // check if $_POST['new_todo'] is set
     if (!empty($_POST['new_todo'])) {
            // strip tags and escape user input
            $item = ($_POST['new_todo']);
            $results = array_push($items, $item);
            save_file($filename, $items);
            header("Location: todo-list.php");
    }

    if (!empty($_GET['remove'])) {
        $completed = $_GET['remove'];
        //completed_items($completed);
        unset($items['remove']);
        unset($_GET);
        save_file($filename, $items);
        //header("Location: todo-list.php");
    }



    if (count($_FILES) > 0 && $_FILES['file1']['type'] != 'text/plain') {
        echo "<p>Your file must be a 'text/plain' file type</p>";
        exit(1);
    }
      


    if (count($_FILES) > 0 && $_FILES['file1']['error'] == 0) {
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
