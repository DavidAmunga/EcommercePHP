<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>




    <!-- Page Content -->
    <div class="container">


<!-- /.row -->

<div class="row">
      <h4 class="text-center bg-danger"><?php display_message(); ?></h4>
       <a class="btn btn-success pull-right" href="index.php" role="button"><span><i class="glyphicon glyphicon-shopping-cart"></i></span> Continue Shopping</a>
      <h1>View Cart</h1>


<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="business" value="david.onyimbo-facilitator@gmail.com">
<input type="hidden" name="currency_code" value="US">
    <table class="table table-striped">
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

  <a class="btn btn-primary pull-right" href="checkout.php" role="button">Proceed To Checkout</a>



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
