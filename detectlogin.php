<?php
//if the user id in the session associative array is set i.e. if the user has successfully logged in
if (isset($_SESSION['userid']))
{
echo "<br><br>"; //insert a couple of breaking lines
echo "<p style='float: right'>";
echo "<img src=loggedinuser.png>";//display an image to show that they are logged in
//display the first name, surname and user type from the session associative array, align it right
echo "<b>&nbsp;".$_SESSION['fname']." ".$_SESSION['sname']." - ".$_SESSION['usertype']."</b></p>";
echo "<br>"; //insert a breaking line
}
?>