<?php
session_start(); // start session to access session variables
include("db.php"); // include database connection
$pageName="Log Out"; //Create and populate a variable called $pageName
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pageName."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); 
include("detectlogin.php");
//include header layout file
echo "<h4>".$pageName."</h4>"; //display name of the page on the web page
//display good bye message to user using his first name and surname from the session
echo "<p class='updateInfo'> Thank you, ".$_SESSION['fname']." ".$_SESSION['sname']."</p>";
unset($_SESSION); //unset the session see https://www.w3schools.com/php/php_sessions.asp
session_destroy(); //destroy the session see https://www.w3schools.com/php/php_sessions.asp
echo "<p class='updateInfo'>You are now logged out</p>"; //display message "logged out"
include("footfile.html"); //include head layout
echo "</body>";
?>