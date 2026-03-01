<?php
session_start(); // start session to access session variables
include("db.php"); // include database connection
$pageName="Login Outcome"; //Create and populate a variable called $pageName
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pageName."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pageName."</h4>"; //display name of the page on the web page

$email = $_POST['login_email']; //see https://www.w3schools.com/php/php_superglobals_post.asp
$password = $_POST['login_pwd'];


if (empty($email) or empty($password)) //if either $email or $password is empty
{
echo "<p class='updateInfo'><b>Login failed!</b></p>"; //display message "login failed"
echo "<p class='updateInfo'>Login form incomplete</p>";
echo "<p class='updateInfo'>Make sure you provide all the required details</p>";
echo "<p class='updateInfo'>Go back to <a href=login.php>login</a></p>"; //display anchor back to login
}
else //else, that is if both $email and £password contain values
{
//SQL query to retrive details of users for which email in the lohin form matches email in the DB table Users
$SQL = "SELECT * FROM users WHERE userEmail = '".$email."'"; //use single quotes as email is varchar
$exeSQL = mysqli_query($conn, $SQL) or die (mysqli_error($conn)); //run SQL query
//obtain the nb of records retrived by query
$nbrecs = mysqli_num_rows($exeSQL); //see https://www.w3schools.com/php/func_mysqli_num_rows.asp
if ($nbrecs ==0) //if nb of records is 0 i.e. if no records were located for which form email matches DB email
{
echo "<p class='updateInfo'><b>Login failed!</b></p>"; //display message "login failed"
echo "<p class='updateInfo'>Email not recognised</p>";
echo "<p class='updateInfo'>Go back to <a href=login.php>login</a></p>"; //display anchor back to login
}
else //else, that is if nb records is not 0, it has to be one since email is unique
{
//create an associative array $arrayU, assign to it the result of the exec of the SQL query
$arrayU = mysqli_fetch_assoc($exeSQL);
if ($password != $arrayU['userPassword']) //if pwd in the login form does not match pwd in arrayU
{
echo "<p class='updateInfo'><b>Login failed!</b></p>"; //display message "login failed"
echo "<p class='updateInfo'>Password not valid</p>";
echo "<p class='updateInfo'>Go back to <a href=login.php>login</a></p>"; //display anchor back to login
}
else //else, that is if password in the login form matches password in associative array arrayU
{
echo "<p class='updateInfo'><b>Login success!</b></p>"; //display message "login success"
$_SESSION['userid'] = $arrayU['userId']; //create session array to store the user id
$_SESSION['fname'] = $arrayU['userFName']; //create session array to store the user first name
$_SESSION['sname'] = $arrayU['userSName']; //create session array to store the user surname
$_SESSION['usertype'] = $arrayU['userType']; //create session array to store the user type
//display welcome greeting with user first name & surname
echo "<p class='updateInfo'>Welcome, ". $_SESSION['fname']." ".$_SESSION['sname']."</p>";
//display the user type: customer or admin
echo "<p class='updateInfo'>User Type: homteq ".$_SESSION['usertype']."</p>";
if ($_SESSION['usertype']=='Customer') //if user type is Customer
{
//display message "continue shopping for home tech"
echo "<p class='updateInfo'>Please continue shopping for &nbsp;";
}
if ($_SESSION['usertype']=='Admin') //if user type is Admin
{
//display message "access index & dashboard"
echo "<p class='updateInfo'>Access index page and dashboard, go to &nbsp;";
}
echo "<a href=index.php>Home Tech</a></p>"; //display anchor back to index
}
}
}
mysqli_close($conn); //close database connection
include("footfile.html"); //include head layout
echo "</body>";
?>