<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>
<?php
$user_id=$_SESSION['customer_id'];
$query=query("SELECT*FROM users WHERE user_id=$user_id");
while($row=fetch_array($query))
{
$username           = escape_string($row['username']);
$email              = escape_string($row['user_email']);
$password           = escape_string($row['user_password']);
$email              = escape_string($row['user_email']);
$address            = escape_string($row['user_address']);
$first_name         = escape_string($row['user_first_name']);
$last_name          = escape_string($row['user_last_name']);
$surname            = escape_string($row['user_surname']);
$mobile_no          = escape_string($row['user_mobile_no']);
$age                = escape_string($row['user_age']);
}

?>

    <!-- Page Content -->
    <div class="container">

      <div class="account-wall">
               <h1 class="text-center">Your Details</h1>
                <img class="profile-img" src="uploads/200px-Flag_of_the_Kenya_Defence_Forces.svg.png"
                    alt="">

            <form class="form-horizontal" method="post">
            <?php  update_user();?>
  <div class="form-group">
    <label for="first_name"   class="col-sm-2 control-label">First Name</label>
    <div class="col-md-4">
      <input type="text" class="form-control" name="user_first_name" value="<?php echo $first_name; ?>"  placeholder="First Name" >
    </div>
  </div>
  <div class="form-group">
    <label for="last_name" class="col-sm-2 control-label">Last Name</label>
    <div class="col-md-4">
      <input type="text" class="form-control" name="user_last_name" value="<?php echo $last_name; ?>"  placeholder="Last Name" >
    </div>
  </div>
   <div class="form-group">
    <label for="surname" class="col-sm-2 control-label">Surname</label>
    <div class="col-md-4">
      <input type="text"  class="form-control" name="user_surname" value="<?php echo $surname; ?>"  placeholder="Surname">
    </div>
  </div>
   <div class="form-group">
    <label for="age" class="col-sm-2 control-label">Age</label>
    <div class="col-md-4">
      <input type="text" class="form-control" name="user_age" value="<?php echo $age; ?>" placeholder="Age" >
    </div>
  </div>

    <div class="form-group">
    <label for="Address" class="col-sm-2 control-label">Address</label>
    <div class="col-md-4">
      <input type="text" class="form-control" name="user_address" value="<?php echo $address; ?>"  placeholder="Address" >
    </div>
  </div>
   <div class="form-group">
    <label for="Email" class="col-sm-2 control-label">Email</label>
    <div class="col-md-4">
      <input type="email" class="form-control" name="user_email" value="<?php echo $email; ?>"  placeholder="Email" >
    </div>
  </div>
  <div class="form-group">
    <label for="mobile_no" class="col-sm-2 control-label">Mobile No</label>
    <div class="col-md-4">
      <input type="text" class="form-control" name="user_mobile_no" value="<?php echo $mobile_no; ?>"  placeholder="MobileNo" >
    </div>
  </div>

  <div class="form-group">
    <label for="mobile_no" class="col-sm-2 control-label">Username</label>
    <div class="col-md-4">
      <input type="text" class="form-control" name="username" value="<?php echo $username; ?>"  placeholder="Username">
    </div>
  </div><div class="form-group">
    <label for="mobile_no" class="col-sm-2 control-label">Password</label>
    <div class="col-md-4">
      <input type="password" class="form-control" name="user_password" value="<?php echo $password; ?>" placeholder="Password">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="save" class="btn btn-primary">Save</button>
    </div>
  </div>
</form>
            </div>


    </div>
    <!-- /.container -->
<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
