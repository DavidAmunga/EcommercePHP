<!-- Configuration-->
<?php require_once("config.php"); ?>



<?php

if(isset($_GET['add'])) {

    $query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['add']) . " ");

    confirm($query);


    if(isset($_SESSION['customer_id']))
    {
        $carquery=query("SELECT * FROM cart WHERE user_id={$_SESSION['customer_id']} AND product_id=" . escape_string($_GET['add']). "");
        confirm($carquery);
    if(row_count($carquery)>0)
    {
    while($qua=fetch_array($carquery))
    {
     $_SESSION['cart_product_'.$_GET['add']] += 1;
     $query="UPDATE cart ";
     $query.="SET product_quantity={$qua['product_quantity']}+1 ";
     $query.="WHERE user_id={$_SESSION['customer_id']} ";
     $query.="AND product_id=" . escape_string($_GET['add']). " ";
     $addquery=query($query);
     confirm($addquery);

redirect("../public/viewcart.php");
    }
    }
    }


    while($row = fetch_array($query)) {
        if($row['product_quantity'] > $_SESSION['product_'.$_GET['add']]) {
            $_SESSION['product_'.$_GET['add']] += 1;
            redirect('../public/viewcart.php');

        } else {
            set_message('Sorry, we only have ' . $row['product_quantity'] . ' of ' . $row['product_title'] . ' in stock.');
            redirect('../public/viewcart.php');
        }
    }

//    $_SESSION['product_' . $_GET['add']] += 1;
//
//    redirect("index.php");
}



if(isset($_GET['remove'])) {

    if(isset($_SESSION['customer_id']))
    {
     $removequery=query("SELECT * FROM cart WHERE user_id={$_SESSION['customer_id']} AND product_id=" . escape_string($_GET['remove']). "");
        confirm($removequery);
    if(row_count($removequery)>0)
    {
    while($qua=fetch_array($removequery))
    {
     $_SESSION['cart_product_'.$_GET['remove']] -= 1;
     $query="UPDATE cart ";
     $query.="SET product_quantity={$qua['product_quantity']}-1 ";
     $query.="WHERE user_id={$_SESSION['customer_id']} ";
     $query.="AND product_id=" . escape_string($_GET['remove']). " ";
     $remquery=query($query);
     confirm($remquery);

redirect("../public/viewcart.php");
    }

    }

    }

    $_SESSION['product_'.$_GET['remove']] -= 1;
    if($_SESSION['product_'.$_GET['remove']] < 1) {
        unset($_SESSION['item_total']);
        unset($_SESSION['item_quantity']);
        redirect('../public/viewcart.php');
    } else {
        redirect('../public/viewcart.php');
    }
}

if(isset($_GET['delete'])) {



    if(isset($_SESSION['customer_id']))
    {
    $delquery=query("SELECT * FROM cart WHERE user_id={$_SESSION['customer_id']} AND product_id=" . escape_string($_GET['delete']). "");
    confirm($delquery);

    if(row_count($delquery)>0)
    {

  $_SESSION['cart_product_'.$_GET['delete']] = 0;
     $deletequery=query("DELETE FROM cart WHERE user_id={$_SESSION['customer_id']} AND product_id=" . escape_string($_GET['delete']). " ");
      confirm($deletequery);
redirect("../public/viewcart.php");

    }

    }

    $_SESSION['product_'.$_GET['delete']] = 0;
    unset($_SESSION['item_total']);
    unset($_SESSION['item_quantity']);

    redirect('../public/viewcart.php');
}






function cart() {
$cart_total=0;
$total = 0;
$item_quantity = 0;
$cart_item_quantity=0;
$item_name = 1;
$item_number =1;
$amount = 1;
$quantity =1;

if(isset($_SESSION['customer_id']))
{
$cart_query=query("SELECT*FROM cart WHERE user_id={$_SESSION['customer_id']} ");
   confirm($cart_query);
   if(row_count($cart_query)>0)
  {
   while($row=fetch_array($cart_query))
   {

        $_SESSION['cart_product_' . $row['product_id']]=$row['product_id'];

       $_SESSION['cart_product_' . $row['product_id']]+=1;

   }
       foreach($_SESSION as $name => $value)
       {
        if($value>0)
        {

            if(substr($name,0,13)=="cart_product_")
            {

                $length=strlen($name-13);
                $cart_id=substr($name,13,$length);
                $query=query("SELECT*FROM cart WHERE user_id={$_SESSION['customer_id']} AND product_id=". escape_string($cart_id). " ");
                confirm($query);

                while($row=fetch_array($query))
                {
                    $cart_product_quantity=$row['product_quantity'];

                    $cart_sub=$row['product_price']* $cart_product_quantity;
                    $cart_item_quantity+= $cart_product_quantity;
                    $cart_image=display_cart_image($cart_id);



                    $cart_product= <<<DELIMETER

<tr>
  <td>{$row['product_title']}<br>

  <img width='100' src='../resources/uploads/{$cart_image}'>

  </td>
  <td>&#36;{$row['product_price']}</td>
  <td>{$row['product_quantity']}</td>
  <td>&#36;{$cart_sub}</td>
  <td><a class='btn btn-warning' href="../resources/cart.php?remove={$row['product_id']}"><span class='glyphicon glyphicon-minus'></span></a>   <a class='btn btn-success' href="../resources/cart.php?add={$row['product_id']}"><span class='glyphicon glyphicon-plus'></span></a>
<a class='btn btn-danger' href="../resources/cart.php?delete={$row['product_id']}"><span class='glyphicon glyphicon-remove'></span></a></td>
  </tr>

<input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
<input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
<input type="hidden" name="amount_{$amount}" value="{$row['product_price']}">
<input type="hidden" name="quantity_{$quantity}" value="$cart_product_quantity">


DELIMETER;

echo $cart_product;


                }
                $cartquery = query("SELECT * FROM cart WHERE user_id={$_SESSION['customer_id']} ");
confirm($cartquery);


$_SESSION['cart_item_total'] = $cart_total +=$cart_sub;
$_SESSION['cart_item_quantity'] = $item_quantity+$cart_item_quantity;



            }

        }

       }


   }
}


foreach ($_SESSION as $name => $value) {

if($value > 0 ) {

if(substr($name, 0, 8 ) == "product_") {


$length = strlen($name - 8);

$id = substr($name, 8 , $length);


$query = query("SELECT * FROM products WHERE product_id = " . escape_string($id). " ");
confirm($query);

while($row = fetch_array($query)) {

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
<input type="hidden" name="quantity_{$quantity}" value="$value">


DELIMETER;

echo $product;

$item_name++;
$item_number++;
$amount++;
$quantity++;





}
 if(isset($_SESSION['customer_id']))
{
$cart_query = query("SELECT * FROM cart WHERE user_id={$_SESSION['customer_id']} ");
confirm($cart_query);
if(row_count($cart_query)>0 )
{


$_SESSION['item_total'] = $total +=$sub+$_SESSION['cart_item_total'];
$_SESSION['item_quantity'] = $item_quantity+$_SESSION['cart_item_quantity'];

}
else
{

$_SESSION['item_total'] = $total += $sub;
$_SESSION['item_quantity'] = $item_quantity;
}

}
else
{

$_SESSION['item_total'] = $total += $sub;
$_SESSION['item_quantity'] = $item_quantity;
}






           }

      }

    }



}






function get_cart_stuff()
{



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
