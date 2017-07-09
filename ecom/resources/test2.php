<!-- Configuration-->
<?php require_once("config.php"); ?>


<?php


  if(isset($_GET['add'])) {
    if(!isset($_SESSION['customer']))
    {
        redirect("../public/login.php");
    }

    else
    {


    $query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['add']). " ");
    confirm($query);

    while($row = fetch_array($query)) {


      if($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]) {

        $_SESSION['product_' . $_GET['add']]+=1;
        redirect("../public/checkout.php");


      } else {


        set_message("We only have " . $row['product_quantity'] . " " . "{$row['product_title']}" . " available");
        redirect("../public/checkout.php");



      }



    }


    }



  // $_SESSION['product_' . $_GET['add']] +=1;

  // redirect("index.php");


  }


  if(isset($_GET['remove'])) {

    $_SESSION['product_' . $_GET['remove']]--;

    if($_SESSION['product_' . $_GET['remove']] < 1) {

      unset($_SESSION['item_total']);
      unset($_SESSION['item_quantity']);
      redirect("../public/checkout.php");

    } else {

      redirect("../public/checkout.php");

     }


  }


 if(isset($_GET['delete'])) {

  $_SESSION['product_' . $_GET['delete']] = '0';
  unset($_SESSION['item_total']);
  unset($_SESSION['item_quantity']);

  redirect("../public/checkout.php");


 }




function cart() {
//init value of cart total
$total = 0;
//init total item quantity
$item_quantity = 0;
//paypal vars
$item_name = 1;
$item_number =1;
$amount = 1;
$quantity =1;

//Check if User has Pending Cart
$user_query=query("SELECT*FROM users WHERE user_id={$_SESSION['customer_id']}");
confirm($user_query);
//Check if the user has pending items in the cart table
if(row_count($user_query)==1)
{
  get_cart_stuff();
}

foreach ($_SESSION as $name => $value) {
//get only the products that have a quantity > 0 (they have been added to cart)
if($value > 0 ) {
//get only the "product_" $_SESSION key
if(substr($name, 0, 8 ) == "product_") {

//extract the product id number
$length = strlen($name - 8);

$id = substr($name, 8 , $length);


}



$query = query("SELECT * FROM products WHERE product_id = " . escape_string($id). " ");
confirm($query);

while($row = fetch_array($query)) {
 //each product will have its own respective subtotal
$sub = $row['product_price']*$value;
$item_quantity +=$value;

$product_image = display_image($row['product_image']);

$product = <<<DELIMETER

<tr>
  <td>{$row['product_title']}<br>

  <img width='100' src='../resources/{$product_image}'>

  </td>
  <td>&#36;{$row['product_price']}</td>
  <td>{$value}</td>
  <td>&#36;{$sub}</td>
  <td><a class='btn btn-warning' href="../resources/cart.php?remove={$row['product_id']}"><span class='glyphicon glyphicon-minus'></span></a>   <a class='btn btn-success' href="../resources/cart.php?add={$row['product_id']}"><span class='glyphicon glyphicon-plus'></span></a>
<a class='btn btn-danger' href="../resources/cart.php?delete={$row['product_id']}"><span class='glyphicon glyphicon-remove'></span></a></td>
  </tr>

<input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
<input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
<input type="hidden" name="amount_{$amount}" value="{$row['product_price']}">
<input type="hidden" name="quantity_{$quantity}" value="{$value}">


DELIMETER;

echo $product;

$item_name++;
$item_number++;
$amount++;
$quantity++;



}
//with each iteration of foreach, increase the cart total by the current iteration's subtotal and set it to the $_SESSION['item_total']

$_SESSION['item_total'] = $total += $sub;
$_SESSION['item_quantity'] = $item_quantity;
 //echo the current iteration's grand total
//                    echo $counter.' '.$_SESSION['item_total'];


           }

      }

    }



}
if(row_count($user_query)==1)
{
   $cart_query=query("SELECT*FROM cart WHERE user_id={$_SESSION['customer_id']} ");
   confirm($cart_query);
   while($row=fetch_array($cart_query))
   {
       $_SESSION['product_' . $row['product_id']]=$row['product_id'];
   }
}
function get_cart_stuff()
{

$cart_query = query("SELECT * FROM cart WHERE cart.product_id = " . escape_string($id). " ");
confirm($cart_query);

while($row = fetch_array($cart_query)) {
 //each product will have its own respective subtotal
$cart_quantity=$row['product_quantity'];
$cartsub = $row['product_price']*$cart_quantity;
$item_quantity +=$cart_quantity;

$product_image = display_cart_image($id);

$product = <<<DELIMETER

<tr>
  <td>{$row['product_title']}<br>

  <img width='100' src='../resources/{$product_image}'>

  </td>
  <td>&#36;{$row['product_price']}</td>
  <td>{$cart_quantity}</td>
  <td>&#36;{$cartsub}</td>
  <td><a class='btn btn-warning' href="../resources/cart.php?remove={$row['product_id']}"><span class='glyphicon glyphicon-minus'></span></a>   <a class='btn btn-success' href="../resources/cart.php?add={$row['product_id']}"><span class='glyphicon glyphicon-plus'></span></a>
<a class='btn btn-danger' href="../resources/cart.php?delete={$row['product_id']}"><span class='glyphicon glyphicon-remove'></span></a></td>
  </tr>

<input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
<input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
<input type="hidden" name="amount_{$amount}" value="{$row['product_price']}">
<input type="hidden" name="quantity_{$quantity}" value="{$cart_quantity}">


DELIMETER;

echo $product;

$item_name++;
$item_number++;
$amount++;
$quantity++;



}
}

function show_paypal() {


if(isset($_SESSION['item_quantity']) && $_SESSION['item_quantity'] >= 1) {


$paypal_button = <<<DELIMETER

    <input type="image" name="upload" border="0"
src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
alt="PayPal - The safer, easier way to pay online">


DELIMETER;

return $paypal_button;

  }


}



function process_transaction() {



if(isset($_GET['tx'])) {

$amount = $_GET['amt'];//amount
$currency = $_GET['cc'];//currency
$transaction = $_GET['tx'];//transaction id
$status = $_GET['st'];//status
$total = 0;//init value of cart total
$item_quantity = 0; //init total item quantity
 //loop through all products
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
$send_order = query("INSERT INTO orders (user_id,order_amount, order_transaction, order_currency, order_status ) VALUES('{$user_id}','{$amount}', '{$transaction}','{$currency}','{$status}')");
$last_id =last_id();
confirm($send_order);



$query = query("SELECT * FROM products WHERE product_id = " . escape_string($id). " ");
confirm($query);

while($row = fetch_array($query)) {
 //each product will have its own respective subtotal
$product_price = $row['product_price'];
$product_id    = $row['product_id'];
$product_title = $row['product_title'];
$sub = $row['product_price']*$value;
$item_quantity +=$value;


$insert_report = query("INSERT INTO reports (product_id, order_id,user_id, product_title, product_price, product_quantity) VALUES('{$id}','{$last_id}','{$user_id}','{$product_title}','{$product_price}','{$value}')");
confirm($insert_report);

$insert_product = query("UPDATE products SET buycount='{$item_quantity}' WHERE product_id ={$product_id}");
confirm($insert_product);





}


$total += $sub;
echo $item_quantity;


           }

      }

    }

session_destroy();
  } else {


redirect("index.php");


}



}




















 ?>
