<?php
/*****Validation Functions****/
function validate_user_registration()
{


   $errors=[];


  $min=3;
  $max=20;



if($_SERVER['REQUEST_METHOD']=="POST")
   {
    $username                = escape_string($_POST['username']);
$email                   = escape_string($_POST['user_email']);
$password                = escape_string($_POST['user_password']);
$address                 = escape_string($_POST['user_address']);
$user_first_name         = escape_string($_POST['user_first_name']);
$user_last_name          = escape_string($_POST['user_last_name']);
$user_surname            = escape_string($_POST['user_surname']);
$user_mobile_no          = escape_string($_POST['user_mobile_no']);
$user_age                = escape_string($_POST['user_age']);
$confirm_pass            = escape_string($_POST['confirm_password']);
if(strlen($user_first_name)<$min)
{
    $errors[]="Your First name cannot be less than {$max} characters";
}
if(strlen($user_first_name)<$min)
{
    $errors[]="Your First name cannot be less than {$min} characters";
}
if(strlen($user_last_name)>$max)
{
    $errors[]="Your Last name cannot be more than {$max} characters";
}
if(strlen($user_last_name)<$min)
{
    $errors[]="Your Last name cannot be less than {$min} characters";
}

if(strlen($user_surname)>$max)
{
    $errors[]="Your Surname cannot be more than {$max} characters";
}
if(strlen($user_surname)<$min)
{
    $errors[]="Your Surname cannot be less than {$min} characters";
}
if(strlen($user_mobile_no!=10))
{
    $errors[]="Your Mobile must be 10 digits";
}
if(strlen($username<$max))
{
    $errors[]="Your Username cannot be less than {$max} characters";
}
if(strlen($password<$max))
{
    $errors[]="Your Password cannot be more than {$max} characters";
}




if(!empty($errors))
{
    foreach($errors as $error)
    {
          echo "<div class='alert alert-danger alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <strong>Warning!</strong> {$error}
</div>";
    }
}

   }

}

?>
