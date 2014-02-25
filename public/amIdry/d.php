<?php 

		function import_data($filename) {
		    if (filesize($filename) == 0) {
		        return FALSE;
		    }
		    else {
			    $handle = fopen($filename, "r");
			    $contents = fread($handle, filesize($filename));
			    $content_array = explode("\n", $contents);
			    fclose($handle);
			    return $content_array;
		    }
		}

		function save_file($filename, $items) {
			$handle = fopen($filename, "w");
			$contents = implode("\n", $items);
			fwrite($handle, $contents);
    		fclose($handle);
		}

		function add_item(&$items) {
			$items[] = $_POST['add'];
		}

		$items = [];

	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TODO List</title>
	<style type="text/css">
	html {
		height: 100%;
	}
	body {
		background-image: url('img/dark-blue-background.jpg');
		background-repeat: no-repeat;
		background-size: cover;
		background-attachment: fixed;
		margin: 20px;
	}
	hr {
		height: 2px;
		border-color: teal !important;
		border-width: 2px !important;
	}
	div {
		padding: 20px;
		border-radius: 20px;

	}

	#main {
		background: -webkit-radial-gradient(left top, lightsteelblue, white);
		margin: 20px auto;
		width: 85%;
		border-style:groove;
		border-width: 3px;
		border-color: teal;
	}

	#main h2{
		color: darkgreen;
	}

	ul {
		font-size: 14pt;
	}

	</style>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>

	<div id="main" >
		<h2>This is the TODO List</h2>

	<?php

		$items = import_data("data/todo-list.txt");

		if(isset($_POST['add'])) {
			add_item($items);
			save_file("data/todo-list.txt", $items);
		}

		if(isset($_GET['remove'])) {
			unset($items[$_GET['remove']]);
			save_file("data/todo-list.txt", $items);
			header("Location: todo-list.php");
			exit;
		}
	?>
		<ul>
			<?php 

			if($items){

				foreach($items as $key => $item) { ?>
				<li><?php echo $item; ?> <small>(<a href="?remove=<?php echo $key; ?>">Remove Item</a>)</small></li>
			<?php }
			} else { ?>
				<li>No Available Items!</li>
				<?php } ?>
		</ul>
		<p><mark>Total Items: <?php echo count($items); ?></mark></p>

	<hr />

		<form method="POST" action="">
			<div class="form-group">
			<p>
				<label for="add">Enter a new list item: </label>
			</p>
			<input id="add" class="form-control" name="add" type="text" placeholder="Enter New List Item.">
			<p>
				<br /><button type="submit" class="btn btn-primary">Add New Item</button>
			</p>
			</div>
		</form>
		
	</div>
</body>
</html>