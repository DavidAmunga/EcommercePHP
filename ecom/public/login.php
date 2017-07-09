<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

    <!-- Page Content -->
    <div class="container">



<form class="col-md-6 col-md-offset-3" id="login-form" method="post">
    <?php login_user(); ?>
    <div class="row text-center">
         <h1 class="text-center">Login</h1>
          <h2 class="text-center bg-warning"><?php display_message(); ?></h2>

        <div class="col-md-4 col-sm-12">
            <button type="button" class="btn btn-primary btn-block">Facebook</button>
        </div>
        <div class="col-md-4 col-sm-12">
            <button type="button" class="btn btn-info btn-block">Twitter</button>
        </div>
        <div class="col-md-4 col-sm-12">
            <button type="button" class="btn btn-danger btn-block">Google+</button>
        </div>
    </div>
    <hr />
    <div class="form-group">
        <input type="text" class="form-control input-lg" name="username" placeholder="Username">
    </div>

    <div class="form-group">
        <input type="password" class="form-control input-lg" name="password" placeholder="Enter Password">
    </div>
    <div class="form-group">

        <input class="btn btn-primary btn-lg btn-block" name="submit" type="submit" value="Login">
    </div>
</form>
        </div>

   <?php include(TEMPLATE_FRONT . DS . "footer.php") ?>

<!--
  <script src="../public/js/validation.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>-->
<script>
$(".alert-dismissable").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert-dismissable").alert('close');
});
</script>
