<?php
include("db.php");
$pageName="make your home smart"; //Create and populate a variable called $pageName
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pageName."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pageName."</h4>"; //display name of the page on the web page


//create a $SQL variable and assign to it a SQL statement that retrieves product details
$SQL="select prodId, prodName, prodPicNameSmall, prodDescripShort, prodPrice from Product";
//run SQL query for connected DB or exit and display error message
//see https://www.w3schools.com/php/func_mysqli_query.asp
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));

echo "<table style='border: 0px'>"; //create HTML table
//create an associative array $arrayP i.e. a type of array where each key is associated with a specific value.
//populate it with the result set i.e. the records retrieved by the executed SQL query.
//iterate through the array. For every iteration each column name in the result set becomes a key in the array
while ($arrayP=mysqli_fetch_assoc($exeSQL))
{
echo "<tr>";
echo "<td style='border: 0px'>";
echo "<a href=prodbuy.php?u_prod_id=".$arrayP['prodId'].">";  //make the image a link to prodbuy.php and pass the product
echo "<img src=images/".$arrayP['prodPicNameSmall']." height=200 width=200>";
echo "</a>"; //display small image
echo "</td>";
echo "<td style='border: 0px'>";
echo "<p><h5>".$arrayP['prodName']."</h5></p>";
echo "<p class='updateInfo'>
        ".$arrayP['prodDescripShort']." </p>";
echo "<p class='updateInfo'>
        <strong>£".$arrayP['prodPrice']." </strong></p>";
echo "</td>";
echo "</tr>";
}
echo "</table>"; //close HTML table
mysqli_close($conn);
include("footfile.html"); //include head layout
echo "</body>";
?>