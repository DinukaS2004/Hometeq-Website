<?php
session_start(); //start session to be able to use session variables
$pageName="Clear Smart Basket"; //Create and populate a variable called $pageName
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pageName."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pageName."</h4>"; //display name of the page on the web page
unset($_SESSION['basket']); //clear the basket session variable
echo "<p class='updateInfo'><strong>Your basket has been cleared.</strong></p>";
include("footfile.html"); //include head layout
echo "</body>";
?>