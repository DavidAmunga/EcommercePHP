<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>


<?php
//if (!isset($_SESSION['customer_id']))
//{
//redirect("login.php");
//set_message("Please Login to Checkout");
//
//}

?>

    <!-- Page Content -->
    <div class="container">


<!-- /.row -->
<?php
$query=query("SELECT*FROM users WHERE user_id={$_SESSION['customer_id']}");
confirm($query);
while($row=fetch_array($query))
{
    $user_address=$row['user_address'];
    $user_mobile_no=$row['user_mobile_no'];
}

?>
<div class="row">
      <h4 class=""></h4>
      <div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Shipping Details</h3>
  </div>
  <div class="panel-body">
  <div class="row">
    <div class="col-md-12">
     <h2 class="text-center">  Address: <?php echo $user_address;?>  </h2>

    </div>

  </div>

  </div>
</div>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="business" value="david.onyimbo-facilitator@gmail.com">
<input type="hidden" name="currency_code" value="US">
   <div class="panel panel-warning">
  <!-- Default panel contents -->
  <div class="panel-heading text-center">Cart</div>



    <table class="table table-hover">
        <thead>
          <tr>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Sub-total</th>

          </tr>
        </thead>
        <tbody>

          <?php  cart(); ?>
          <?php ?>
        </tbody>
    </table>
  <?php echo show_paypal();  ?>
    </div>



</form>



<!--  ***********CART TOTALS*************-->

<div class="col-xs-4 pull-right ">
<h2>Cart Totals</h2>

<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Products:</th>
<td><span class="amount"><?php
echo isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = "0";?></span></td>
</tr>
<tr class="shipping">
<th>Shipping and Handling</th>
<td>Free Shipping</td>
</tr>

<tr class="order-total">
<th>Order Total Amount</th>
<td><strong><span class="amount">KES <?php
echo isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total'] = "0";?>



</span></strong> </td>
</tr>


</tbody>

</table>

</div><!-- CART TOTALS-->
<?php

?>

 </div><!--Main Content-->


    </div>
    <!-- /.container -->



<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
