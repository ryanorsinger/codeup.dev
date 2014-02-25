<?php

	echo "<p>GET:</p>";
	var_dump($_GET);

	echo "<p>POST:</p>";
	var_dump($_POST);

	?>

 

<!DOCTYPE html>

<head>

    <meta charset="utf-8">
    <title>TODO List</title>

</head>

<body>

	<h1>TODO List</h1>

	<h3>Add a new item to the list</h3>
	    <form method="POST" action="todo-list.php">
	        <p>
	            <label for="NewItem">New Item</label>
	            <input id="NewItem" name="NewItem" placeholder="new item here." type="text" >
	        </p>

	        <p>
	        	<input type="submit" value="Add new item">
	        </p>


	<ul>

		<?php 





			function open_file($file){
			    $filename = $file;
			    $handle = fopen($filename, "r");
			    $contents = fread($handle, filesize($filename));
			    fclose($handle);
			    return explode("\n", $contents);
			}

			function write_file ($items, $file){
		        $filename = $file;
		        $handle = fopen($filename, "w");
		        $item = implode("\n", $items);
		        fwrite($handle, $item);
		        fclose($handle);
		    }

			$items = open_file ("Data/todo_list.txt");

				if(isset($_POST['NewItem'])){
				$item = $_POST['NewItem'];
				array_push($items, $item);
				write_file($items, "Data/todo_list.txt");
				header ("Location: todo-list.php");
				}

		?>
	</ul>  

		<ul>
				<?php foreach ($items as $key => $item) { ?>
					<li><?php echo $item?>
					<a href='?remove=<?php echo $key; ?>'> (x) </a>
					</li>
				<?php } ?>
					
					
		</ul>		
   

		<?php 	if(isset($_GET['remove'])){
				$NoItem = $_GET['remove'];
				unset($items[$NoItem]);
				write_file($items, "Data/todo_list.txt");
				header ("Location: todo-list.php");
				exit();
				}

		?>		
	   
	

</body>
