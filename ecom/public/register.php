 <?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

<form class="col-md-6 col-md-offset-3" id="register-form" method="post">
    <?php add_user(); ?>
    <div class="row text-center">
         <h1 class="text-center">Register</h1>
          <h2 class="text-center bg-warning"><?php display_message(); ?></h2>

    </div>

    <div class="form-group">
        <input type="text" class="form-control input-lg" name="user_first_name" placeholder="First Name">
    </div>
    <div class="form-group">
        <input type="text" class="form-control input-lg" name="user_last_name" placeholder="Last Name">
    </div>
     <div class="form-group">
        <input type="text" class="form-control input-lg" name="user_surname" placeholder="Surname">
    </div>
    <div class="form-group">
        <input type="text" class="form-control input-lg" name="user_email" placeholder="Email">
    </div>
    <div class="form-group">
        <input type="text" class="form-control input-lg" name="user_address" placeholder="Address">
    </div>
    <div class="form-group">
        <input type="text" class="form-control input-lg" name="user_mobile_no" placeholder="Mobile No">
    </div>
       <div class="form-group">
        <input type="text" class="form-control input-lg" name="user_age" placeholder="Age">
    </div>
      <div class="form-group">
        <input type="text" class="form-control input-lg" name="username" placeholder="Username">
    </div>


    <div class="form-group">
        <input type="password" class="form-control input-lg" name="user_password" id="password" placeholder="Enter Password">
    </div>
       <div class="form-group">
        <input type="password" class="form-control input-lg" name="password2" placeholder="Confirm Password">
    </div>
    <div class="form-group">
        <input class="btn btn-primary btn-lg btn-block" name="add_user" type="submit" value="Register" >
    </div>
</form>
<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="../public/js/validation.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>
