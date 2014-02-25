<?php

echo "<p>POST:</p>";
var_dump($_POST);

echo "<p>GET:<p>";
var_dump($_GET);

?>

<!DOCTYPE html>
<html>
<head>
	<title> CodeUp Arches Cohort Survey </title>
</head>
<body>
	<h1> CodeUp Arches Cohort Survey </h1>
	
	 <h2> User Login </h2>
        <form method="POST" action="">
            <p>
                <label for="username">Username</label>
                <input id="username" name="username" type="text" placeholder="enter your username">
            </p>
                <label for="password">Password</label>
                <input id="username" name="username" type="text" placeholder="enter your password">
            </p>
  
            <p>What operating systems have you used?</p>
            <label for="os1"><input type="checkbox" id="os1" name="os[]" value="linux"> Linux</label>
            <label for="os2"><input type="checkbox" id="os2" name="os[]" value="osx"> OS X</label>
            <label for="os3"><input type="checkbox" id="os3" name="os[]" value="windows"> Windows</label>

            
   

        <br>
        <h2> Compose an Email: </h2> 
    
            <p>
                <label for="text">Send email to:</label>
                <input type="text" id="recipient" name="to" placeholder="Enter Recipients">
                
                <label for="text">From:</label>
                <input type="text" id="from" value="" name="from" placeholder="Enter sender name">
                
                <br><br>
                
                <label for="subject">Subject</label>
                <br>
                <textarea placeholder="type subject here" name="subject" id="subject" value="" rows="1" cols="20"></textarea>
                <br>
                <label for"email_body">Body of Email:</label>
                <br>
                <textarea id="email_body" name="email_body" rows="5" cols="40" placeholder="Type your comments here"></textarea>
            </p>
            <p>
              
        
    
        <h2> What is the Capital of Texas? </h2>
            <p>Select the Capital of Texas</p>
            <label for="q1a">
                <input type="radio" id="q1a" name="q1" value="houston">
                Houston
            </label>
            <label for="q1b">
                <input type="radio" id="q1b" name="q1" value="dallas">
                Dallas
            </label>
            <label for="q1c">
                <input type="radio" id="q1c" name="q1" value="austin">
                Austin
            </label>
            <label for="q1d">
                <input type="radio" id="q1d" name="q1" value="san antonio">
                San Antonio
                </label>
            <label for="q1">
                <input type="radio" id="q1" name="q" value="washington">
                Washington on the Brazos
            </label>
            <br><br>
            <button type"submit">Send</button>
            <br><br>
            </form>


</body>
</html>
