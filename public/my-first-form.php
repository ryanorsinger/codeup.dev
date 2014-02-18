<?php

// If we're blending php into html then we want to put things in HTML view

echo "<p>POST:</p>";
var_dump($_POST);

echo "<p>GET:</p>";
var_dump($_GET);

?>

<!DOCTYPE html>
<html>
<head>
        <title>Awesome Page Awesome Page! </title>
</head>

<body>
  <!--   <h2> Checkbox test </h2>
        <label for="mailing_list">
            <input type="checkbox" id="mailing_list" name="mailing_list" value="yes">Sign me up for the mailing list</label> -->

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
            <label for="os1"><input type="checkbox" id="os1" name="os1" value="linux"> Linux</label>
            <label for="os2"><input type="checkbox" id="os2" name="os2" value="osx"> OS X</label>
            <label for="os3"><input type="checkbox" id="os3" name="os3" value="windows"> Windows</label>

            
      

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
            <label for="q1">
                <input type="radio" id="q1" name="q" value="washington">
                Washington on the Brazos
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
            <br><br>
            <button type"submit">Send</button>
            <br><br>
            </form>


</body>



<!-- 
Add inputs to the form that would allow a user to compose an email (to, from, subject, body, and a send button). Make sure to use the appropriate input types for each form element.

Put headings above the forms. Label the first form as "User Login", and the second form as "Compose an Email".
 -->
<!--  Type Attribute
There are many types of form inputs in HTML. Since most HTML inputs use the same HTML element, <input>, the browser needs a way to distinguish the input type. This is achieved by specifying a type attribute as part of the <input> element. The types we will be covering in this unit are:

submit
text
password
checkbox
radio -->