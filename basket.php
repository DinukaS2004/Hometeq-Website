<?php
session_start(); //start session to be able to use session variables
include("db.php");
$pageName="smart basket"; //Create and populate a variable called $pageName
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pageName."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pageName."</h4>"; //display name of the page on the web page

if(isset($_POST['remove_prodid'])){
    $removeId = intval($_POST['remove_prodid']);
    unset($_SESSION['basket'][$removeId]); // remove item from session
    echo "<p class='updateInfo'><strong>Item removed from basket.</strong></p>";
}

if(isset($_POST['h_prodid'])){
    $newProdId=$_POST['h_prodid']; //get the product id passed from prodbuy.php page using POST method and assign it to a local variable
    $requQuantity=$_POST['prod_quantity']; //get the product quantity passed from 
    $_SESSION['basket'][$newProdId]=$requQuantity; //store the product id and quantity in the session variable called basket
    echo "<p class='updateInfo'><strong>".$requQuantity." item added to the basket.</strong></p>";
}else{
    echo "<p class='updateInfo'><strong>Basket unchanged.</strong></p>";
}

$total = 0; // create a variable to hold the total cost of the items in the basket

echo "<table id='baskettable'>";
echo "<tr>";
echo "<th>Product Name</th>";
echo "<th>Price</th>";
echo "<th>Quantity</th>";
echo "<th>Subtotal</th>";
echo "<td>&nbsp;</td>";
echo "</tr>";

if (isset($_SESSION['basket'])) {

    // iterate through the basket session variable to retrieve product id and quantity
    foreach ($_SESSION['basket'] as $key => $value) {

        $prodId = intval($key);        // product id
        $quantity = intval($value);    // quantity

        // skip any invalid entries
        if ($prodId <= 0 || $quantity <= 0) {
            continue;
        }

        // create SQL query to retrieve details for the selected product
        $SQL = "SELECT prodName, prodPrice FROM Product WHERE prodId = $prodId";

        // execute query and retrieve result
        $exeSQL = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
        $arrayP = mysqli_fetch_assoc($exeSQL);

        // if product not found in DB, skip
        if (!$arrayP) {
            continue;
        }

        // calculate subtotal
        $subtotal = floatval($arrayP['prodPrice']) * $quantity;

        // display one row
        echo "<tr>";
        echo "<td>".$arrayP['prodName']."</td>";
        echo "<td>&pound".number_format($arrayP['prodPrice'], 2)."</td>";
        echo "<td>".$quantity."</td>";
        echo "<td>&pound".number_format($subtotal, 2)."</td>";
        echo "<td>";
        echo "<form method='post' action='basket.php'>";
        echo "<input type='hidden' name='remove_prodid' value='".$prodId."'>";
        echo "<input type='submit' value='REMOVE'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
        
        // add subtotal to total
        $total += $subtotal;
    }

    // display total row
    echo "<tr>";
    echo "<td colspan='3' style='text-align:right;'><strong>Total</strong></td>";
    echo "<td><strong>&pound".number_format($total, 2)."</strong></td>";
    echo "</tr>";

} else {
    echo "<tr><td colspan='4'>Your basket is empty.</td></tr>";
}

echo "</table>";
echo "<br>"; //line break
echo "<p><a href='clearbasket.php'>CLEAR BASKET</a></p>"; //link to clear the basket
echo "<br>"; //line break
echo "<p>New hometeq customers<a href='signup.php'>Sign up</a></p>"; //link to return to index page
echo "<br>"; //line break
echo "<p>Returning hometeq customers<a href='login.php'>Log in</a></p>";
include("footfile.html"); //include head layout
mysqli_close($conn);
echo "</body>";
?>