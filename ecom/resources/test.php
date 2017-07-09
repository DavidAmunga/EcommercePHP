 <div class="container">
              <div class="account-wall">
               <h1 class="text-center">Sign Up</h1>
                <img class="profile-img" src="uploads/200px-Flag_of_the_Kenya_Defence_Forces.svg.png"
                    alt="">

            <form class="form-horizontal" method="post">
            <?php add_user();
            validate_user_registration();
            ?>

  <div class="form-group">
    <label for="first_name"   class="col-sm-2 control-label">First Name*</label>
    <div class="col-md-4">
      <input type="text" class="form-control" name="user_first_name"  placeholder="First Name" >
    </div>
  </div>
  <div class="form-group">
    <label for="last_name" class="col-sm-2 control-label">Last Name*</label>
    <div class="col-md-4">
      <input type="text" class="form-control" name="user_last_name"  placeholder="Last Name" >
    </div>
  </div>
   <div class="form-group">
    <label for="surname" class="col-sm-2 control-label">Surname*</label>
    <div class="col-md-4">
      <input type="text"  class="form-control" name="user_surname"  placeholder="Surname">
    </div>
  </div>
   <div class="form-group">
    <label for="age" class="col-sm-2 control-label">Age*</label>
    <div class="col-md-4">
      <input type="text" class="form-control" name="user_age" placeholder="Age" >
    </div>
  </div>

    <div class="form-group">
    <label for="Address" class="col-sm-2 control-label">Address*</label>
    <div class="col-md-4">
      <input type="text" class="form-control" name="user_address"  placeholder="Address" >
    </div>
  </div>
   <div class="form-group">
    <label for="Email" class="col-sm-2 control-label">Email*</label>
    <div class="col-md-4">
      <input type="email" class="form-control" name="user_email"  placeholder="Email" >
    </div>
  </div>
  <div class="form-group">
    <label for="mobile_no" class="col-sm-2 control-label">Mobile No*</label>
    <div class="col-md-4">
      <input type="text" class="form-control" name="user_mobile_no"  placeholder="MobileNo" >
    </div>
  </div>

   <div class="form-group">
    <label for="mobile_no" class="col-sm-2 control-label">Username *</label>
    <div class="col-md-4">
      <input type="text" class="form-control" name="username"  placeholder="Username">
    </div>
  </div>
   <div class="form-group">
    <label for="mobile_no" class="col-sm-2 control-label">Password *</label>
    <div class="col-md-4">
      <input type="password" class="form-control" name="user_password" placeholder="Password">
    </div>
  </div>
   <div class="form-group">
    <label for="mobile_no" class="col-sm-2 control-label">Confirm Password *</label>
    <div class="col-md-4">
      <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="add_user" class="btn btn-primary">Sign Up!</button>
    </div>
  </div>
  <?php
  require_once('recaptchalib.php');
  $publickey = "6LcYyh8TAAAAABm8JNX5u_PmFQLjQfavlUrhw9TN"; // you got this from the signup page
  echo recaptcha_get_html($publickey);
  ?>
</form>
             <div class="g-recaptcha" data-sitekey="6LcYyh8TAAAAABm8JNX5u_PmFQLjQfavlUrhw9TN"></div>

            </div>
</div>





<?php
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
?>


























