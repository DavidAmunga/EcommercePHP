<?php require_once("../../resources/config.php"); ?>
<?php
foreach ($_SESSION as $name => $value) {
 //get only the products that have a quantity > 0 (they have been added to cart)
if($value > 0 )
{

 //get only the "product_" $_SESSION key
if(substr($name, 0, 8 ) == "product_") {

$length = strlen($name - 8);
//extract the product id number
$id = substr($name, 8 , $length);

$user_id=$_SESSION['customer_id'];

$query = query("SELECT * FROM products WHERE product_id = " . escape_string($id). " ");
confirm($query);

while($row = fetch_array($query)) {
 //each product will have its own respective subtotal
$product_price = $row['product_price'];
$product_id    = $row['product_id'];
$product_title = $row['product_title'];
$sub = $row['product_price']*$value;
$item_quantity +=$value;



$insert_cart = query("INSERT INTO cart (user_id,product_id,order_id, product_title, product_price, product_quantity,DateAdded) VALUES('{$user_id}','{$id}','0','{$product_title}','{$product_price}','{$value}',now())");
confirm($insert_cart);


}
$total += $sub;
         }
                }
                    }


session_start();
session_destroy();

header("Location: ../../public");



 ?>
