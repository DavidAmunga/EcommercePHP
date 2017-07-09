

<?php include("validation.php"); ?>
<?php

$upload_directory = "uploads";

// helper functions

function row_count($result)
{
    return mysqli_num_rows($result);
}

function clean($string)
{
    return htmlentities($string);
}

function token_generator()
{
 $token=$_SESSION['token']=md5(uniqid(mt_rand(),true));
 return $token;
}




function last_id(){

global $connection;

return mysqli_insert_id($connection);


}


function set_message($msg){

if(!empty($msg)) {

$_SESSION['message'] = $msg;

} else {

$msg = "";


    }


}


function display_message() {

    if(isset($_SESSION['message'])) {

        echo $_SESSION['message'];
        unset($_SESSION['message']);

    }



}


function redirect($location){

return header("Location: $location ");


}



// function redirect($location, $sec=0)
// {
//     if (!headers_sent())
//     {
//         header( "refresh: $sec;url=$location" );
//     }
//     elseif (headers_sent())
//     {
//         echo '<noscript>';
//         echo '<meta http-equiv="refresh" content="'.$sec.';url='.$location.'" />';
//         echo '</noscript>';
//     }
//     else
//     {
//         echo '<script type="text/javascript">';
//         echo 'window.location.href="'.$location.'";';
//         echo '</script>';
//     }
// }



function query($sql) {

global $connection;

return mysqli_query($connection, $sql);


}


function confirm($result){

global $connection;

if(!$result) {

die("QUERY FAILED " . mysqli_error($connection));


	}


}


function escape_string($string){

global $connection;

return mysqli_real_escape_string($connection, $string);


}



function fetch_array($result){

return mysqli_fetch_array($result);


}


/****************************FRONT END FUNCTIONS************************/





// get products

//Pagination
function get_product_count()
{
    $find_count=query("SELECT*FROM products");
    $count=mysqli_num_rows($find_count);

   echo $count;
}
function get_products()
{



$query = query(" SELECT * FROM products");
confirm($query);

while($row = fetch_array($query)) {

$product_image = display_image($row['product_image']);

$product = <<<DELIMETER

<div class="col-sm-3 col-lg-3 col-md-3 ">
    <div class="thumbnail">
        <a href="item.php?  qd={$row['product_id']}"><img src="../resources/{$product_image}" alt=""></a>
        <div class="caption">
            <h4 class="pull-right">&#36;{$row['product_price']}</h4>
            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
            </h4>

             <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add to cart</a>
        </div>



    </div>
</div>

DELIMETER;

echo $product;


		}


}

function get_new_products()
{



$query = query(" SELECT * FROM products WHERE DateAdded>(DATE_SUB(NOW(), INTERVAL 1 MONTH)) ORDER BY DateAdded DESC LIMIT 4 ");
confirm($query);

while($row = fetch_array($query)) {

$product_image = display_image($row['product_image']);

$newproduct = <<<DELIMETER

<div class="col-sm-3 col-lg-3 col-md-3  ">
    <div class="thumbnail">
        <a href="item.php?id={$row['product_id']}"><img src="../resources/{$product_image}" alt=""></a>
        <div class="caption">
            <h4 class="pull-right">&#36;{$row['product_price']}</h4>
            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
            </h4>

             <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add to cart</a>
        </div>



    </div>
</div>

DELIMETER;

echo $newproduct;


		}


}

function get_popular_products()
{



$query = query(" SELECT * FROM products ORDER BY buycount DESC LIMIT 4 ");
confirm($query);

while($row = fetch_array($query)) {

$product_image = display_image($row['product_image']);

$newproduct = <<<DELIMETER

<div class="col-sm-3 col-lg-3 col-md-3 ">
    <div class="thumbnail">
        <a href="item.php?id={$row['product_id']}"><img src="../resources/{$product_image}" alt=""></a>
        <div class="caption">
            <h4 class="pull-right">&#36;{$row['product_price']}</h4>
            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
            </h4>

             <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add to cart</a>
        </div>



    </div>
</div>

DELIMETER;

echo $newproduct;


		}


}


function get_categories(){


$query = query("SELECT * FROM categories");
confirm($query);

while($row = fetch_array($query)) {


$categories_links = <<<DELIMETER

<a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>


DELIMETER;

echo $categories_links;

     }



}
function get_category_details()
{

            $query= query("SELECT*FROM categories WHERE cat_id={$_GET['id']}");
            confirm($query);
            while($row=fetch_array($query))
            {
                $cat_title=$row['cat_title'];
                $cat_description=$row['cat_description'];

              echo "<h1>{$cat_title}</h1>
                  <p>{$cat_description}</a>
            </p> ";

            }



}







function get_products_in_cat_page() {


$query = query(" SELECT * FROM products WHERE product_category_id = " . escape_string($_GET['id']) . " ");
confirm($query);

while($row = fetch_array($query)) {

$product_image = display_image($row['product_image']);

$product = <<<DELIMETER


            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img height="260.5" src="../resources/{$product_image}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>


                        <p>
                            <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Add to Cart</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

DELIMETER;

echo $product;


		}


}







function get_products_in_shop_page() {


$query = query(" SELECT * FROM products");
confirm($query);

while($row = fetch_array($query)) {

$product_image = display_image($row['product_image']);

$product = <<<DELIMETER


            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="../resources/{$product_image}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

DELIMETER;

echo $product;


        }


}



function login_user(){

if(isset($_POST['submit'])){

$username = escape_string($_POST['username']);
$password = escape_string($_POST['password']);

$query = query("SELECT * FROM users WHERE username = '{$username}' AND user_password = '{$password }' ");
confirm($query);
while($row=fetch_array($query))
{
 $db_username=$row['username'];
 $db_user_id=$row['user_id'];
 $db_password=$row['user_password'];
 $db_user_role=$row['user_role'];
 $db_user_status=$row['user_status'];

}

if(mysqli_num_rows($query) == 0)
{

set_message("Your Password or Username are wrong");
redirect("login.php");


} else if($username==$db_username && $password==$db_password && $db_user_role=='admin')
{

$_SESSION['admin'] = $username;
redirect("admin");

}
else if($username==$db_username && $password==$db_password && $db_user_role=='customer'  && $db_user_status=='Active')
{
  $_SESSION['customer'] = $username;
  $_SESSION['customer_id'] = $db_user_id;
redirect("index.php");

}
else if($username==$db_username && $password==$db_password && $db_user_role=='customer'  && $db_user_status=='Blocked')
{

set_message("Your Account is blocked");
redirect("login.php");

}




}



}



function send_message() {

    if(isset($_POST['submit'])){

        $to          = "david.onyimbo@gmail.com";
        $from_name   =   $_POST['name'];
        $subject     =   $_POST['subject'];
        $email       =   $_POST['email'];
        $message     =   $_POST['message'];


        $headers = "From: {$from_name} {$email}";


        $result = mail($to, $subject, $message,$headers);

        if(!$result) {

            set_message("Sorry we could not send your message");
            redirect("contact.php");
        } else {

            set_message("Your Message has been sent");
            redirect("contact.php");
        }




    }




}



/****************************BACK END FUNCTIONS************************/



/*****CART FUNCTIONS******/
function add_to_cart()
{
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
        redirect("../public/index.php");


      } else {


        set_message("We only have " . $row['product_quantity'] . " " . "{$row['product_title']}" . " available");
        redirect("../public/viewcart.php");



      }



    }


    }
}
}
function remove_from_cart()
{
    if(isset($_GET['remove'])) {

    $_SESSION['product_' . $_GET['remove']]--;

    if($_SESSION['product_' . $_GET['remove']] < 1) {

      unset($_SESSION['item_total']);
      unset($_SESSION['item_quantity']);
      redirect("../public/viewcart.php");

    } else {

      redirect("../public/viewcart.php");

     }


  }
}


function delete_from_cart()
{
    if(isset($_GET['delete'])) {

  $_SESSION['product_' . $_GET['delete']] = '0';
  unset($_SESSION['item_total']);
  unset($_SESSION['item_quantity']);

  redirect("../public/viewcart.php");


 }

}



function display_orders(){



$query = query("SELECT * FROM orders");
confirm($query);


while($row = fetch_array($query)) {


$orders = <<<DELIMETER

<tr>
    <td>{$row['order_id']}</td>
    <td>{$row['order_amount']}</td>
    <td>{$row['order_transaction']}</td>
    <td>{$row['order_currency']}</td>
    <td>{$row['order_status']}</td>
    <td><a class="btn btn-danger" href="../../resources/templates/back/delete_order.php?id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>




DELIMETER;

echo $orders;



    }



}




/************************ Admin Products Page ********************/

function display_image($picture) {

global $upload_directory;

return $upload_directory  . DS . $picture;



}
function display_cart_image($id)
{
    global $connection;
    $query=query("SELECT product_image FROM products WHERE product_id={$id}");
    confirm($query);
    while($pc=fetch_array($query))
    {
        $product_img=$pc['product_image'];
    }
    return $product_img;
}







function show_product_category_title($product_category_id){


$category_query = query("SELECT * FROM categories WHERE cat_id = '{$product_category_id}' ");
confirm($category_query);

while($category_row = fetch_array($category_query)) {

return $category_row['cat_title'];

}
}






/***************************Add Products in admin********************/


function add_product() {


if(isset($_POST['add'])) {


$product_title          = escape_string($_POST['product_title']);
$product_category_id    = escape_string($_POST['product_category_id']);
$product_price          = escape_string($_POST['product_price']);
$product_description    = escape_string($_POST['product_description']);
$short_desc             = escape_string($_POST['short_desc']);
$product_quantity       = escape_string($_POST['product_quantity']);
$product_image          = $_FILES['file']['name'];
$image_temp_location    = $_FILES['file']['tmp_name'];

move_uploaded_file($image_temp_location  , UPLOAD_DIRECTORY . DS . $product_image);


$query = query("INSERT INTO products(product_title, product_category_id, product_price, product_description, short_desc, product_quantity, product_image) VALUES('{$product_title}', '{$product_category_id}', '{$product_price}', '{$product_description}', '{$short_desc}', '{$product_quantity}', '{$product_image}')");
$last_id = last_id();
confirm($query);
set_message("New Product with id {$last_id} was Added");
redirect("index.php?products");


        }


}

function show_categories_add_product_page(){


$query = query("SELECT * FROM categories");
confirm($query);

while($row = fetch_array($query)) {


$categories_options = <<<DELIMETER

 <option value="{$row['cat_id']}">{$row['cat_title']}</option>


DELIMETER;

echo $categories_options;

     }



}



/***************************updating product code ***********************/

function update_product() {


if(isset($_POST['update'])) {


$product_title          = escape_string($_POST['product_title']);
$product_category_id    = escape_string($_POST['product_category_id']);
$product_price          = escape_string($_POST['product_price']);
$product_description    = escape_string($_POST['product_description']);
$short_desc             = escape_string($_POST['short_desc']);
$product_quantity       = escape_string($_POST['product_quantity']);
$product_image          = escape_string($_FILES['file']['name']);
$image_temp_location    = escape_string($_FILES['file']['tmp_name']);


if(empty($product_image)) {

$get_pic = query("SELECT product_image FROM products WHERE product_id =" .escape_string($_GET['id']). " ");
confirm($get_pic);

while($pic = fetch_array($get_pic)) {

$product_image = $pic['product_image'];

    }

}



move_uploaded_file($image_temp_location  , UPLOAD_DIRECTORY . DS . $product_image);


$query = "UPDATE products SET ";
$query .= "product_title            = '{$product_title}'        , ";
$query .= "product_category_id      = '{$product_category_id}'  , ";
$query .= "product_price            = '{$product_price}'        , ";
$query .= "product_description      = '{$product_description}'  , ";
$query .= "short_desc               = '{$short_desc}'           , ";
$query .= "product_quantity         = '{$product_quantity}'     , ";
$query .= "product_image            = '{$product_image}'          ";
$query .= "WHERE product_id=" . escape_string($_GET['id']);





$send_update_query = query($query);
confirm($send_update_query);
set_message("Product has been updated");
redirect("index.php?products");


        }


}

function update_user() {


if(isset($_POST['save'])) {


$username           = escape_string($_POST['username']);
$email              = escape_string($_POST['user_email']);
$password           = escape_string($_POST['user_password']);
$email              = escape_string($_POST['user_email']);
$address            = escape_string($_POST['user_address']);
$first_name         = escape_string($_POST['user_first_name']);
$last_name          = escape_string($_POST['user_last_name']);
$surname            = escape_string($_POST['user_surname']);
$age                = escape_string($_POST['user_age']);
$mobile_no          = escape_string($_POST['user_mobile_no']);



$query = "UPDATE users SET ";
$query .= "username             = '{$username}'    , ";
$query .= "user_first_name      = '{$first_name}'  , ";
$query .= "user_last_name       = '{$last_name}'   , ";
$query .= "user_surname         = '{$surname}'     , ";
$query .= "user_mobile_no       = '{$mobile_no}'   , ";
$query .= "user_address         = '{$address}'     , ";
$query .= "user_age             = '{$age}'         , ";
$query .= "user_email           = '{$email}'       , ";
$query .= "user_password        = '{$password}'      ";
$query .= "WHERE user_id        =" . escape_string($_SESSION['customer_id']);





$send_update_query = query($query);
confirm($send_update_query);
set_message("User Details Changed");
redirect("profile.php");


        }


}

/*************************Categories in admin ********************/


function show_categories_in_admin() {


$category_query = query("SELECT * FROM categories");
confirm($category_query);


while($row = fetch_array($category_query)) {

$cat_id = $row['cat_id'];
$cat_title = $row['cat_title'];


$category = <<<DELIMETER


<tr>

    <td>{$cat_title}</td>
    <td><a class="btn btn-info" href="index.php?add_edit_cat&id={$row['cat_id']}"><span class="glyphicon glyphicon-pencil"></span></a></td>
</tr>



DELIMETER;

echo $category;



    }



}



function add_category() {

if(isset($_POST['add_category'])) {
$cat_title = escape_string($_POST['cat_title']);
$cat_description = escape_string($_POST['cat_description']);

if(empty($cat_title) || $cat_title == " " || empty($cat_description) || $cat_description == " ") {

echo "<div class='alert alert-warning' role='alert'>ust Write a Short Description</div>";


} else {


$insert_cat = query("INSERT INTO categories(cat_title,cat_description) VALUES('{$cat_title}','{$cat_description}') ");
confirm($insert_cat);
set_message("Category Created");



    }


    }




}
function update_category()
{

if(isset($_POST['update_category'])) {
$cat_title =$_POST['cat_title'];
$cat_description = $_POST['cat_description'];


$query ="UPDATE categories ";
$query.="SET cat_title='{$cat_title}' , ";
$query.="cat_description='{$cat_description}'  ";
$query.="WHERE cat_id={$_GET['id']} ";


 $update_cat=query($query);

confirm($update_cat);
set_message("Category Updated!");
redirect("index.php?categories");


    }


}






 /************************admin users***********************/



function display_users() {


$category_query = query("SELECT * FROM users WHERE user_role!='admin'");
confirm($category_query);


while($row = fetch_array($category_query)) {

$user_id = $row['user_id'];
$username = $row['username'];
$email = $row['user_email'];
$status = $row['user_status'];


$user = <<<DELIMETER


<tr>

    <td>{$username}</td>
     <td>{$email}</td>
     <td>{$status}</td>
    <?php
    if($status=='Active')
    {
    ?>
    <td><a class="btn btn-warning" href="../../resources/templates/back/block_user.php?id={$row['user_id']}">Block</a></td>
    <?php }
    else if($status=='Blocked')
    {
    ?>
    <td><a class="btn btn-info" href="../../resources/templates/back/activate_user.php?id={$row['user_id']}">Activate</a></td>

    <?php } ?>
</tr>



DELIMETER;

echo $user;



    }



}


function add_user() {


if(isset($_POST['add_user'])) {


$username                = escape_string($_POST['username']);
$email                   = escape_string($_POST['user_email']);
$password                = escape_string($_POST['user_password']);

$address                 = escape_string($_POST['user_address']);
$user_first_name         = escape_string($_POST['user_first_name']);
$user_last_name          = escape_string($_POST['user_last_name']);
$user_surname            = escape_string($_POST['user_surname']);
$user_mobile_no          = escape_string($_POST['user_mobile_no']);
$user_age                = escape_string($_POST['user_age']);



$query = query("INSERT INTO users(username,user_email,user_password,user_first_name,user_last_name,user_surname,user_mobile_no,user_address,user_age,user_order_count) VALUES('{$username}','{$email}','{$password}','{$user_first_name}','{$user_last_name}','{$user_surname}','{$user_mobile_no}','{$user_address}','{$user_age}','0')");
confirm($query);



redirect("login.php");



}



}





function get_reports(){


$query = query(" SELECT * FROM reports");
confirm($query);

while($row = fetch_array($query)) {

$customer=query("SELECT*FROM users WHERE user_id={$row['user_id']}");
while($cust=fetch_array($customer))
{
    $customer_name=$cust['username'];
}

$report = <<<DELIMETER

        <tr>
             <td>{$row['report_id']}</td>


            <td>{$row['order_id']}</td>
            <td>$customer_name</td>
            <td>{$row['product_title']}</td>
            <td>{$row['product_price']}</td>

            <td>{$row['product_quantity']}</td>
            <td><a class="btn btn-danger" href="../../resources/templates/back/delete_report.php?id={$row['report_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>

DELIMETER;

echo $report;


        }





}




/****************Get Slides Functions*****/
function add_slides()
{
  if(isset($_POST['add_slide']))
  {
      $slide_title=escape_string($_POST['slide_title']);
      $slide_image=escape_string($_FILES['file']['name']);
       $slide_image_loc=$_FILES['file']['tmp_name'];

      if(empty($slide_title) || empty($slide_image))
      {
          echo"<p class='bg-danger'>This Field cannot be empty</p>";
      }
      else
      {


move_uploaded_file($slide_image_loc  , UPLOAD_DIRECTORY . DS . $slide_image);
          $query=query("INSERT INTO slides(slide_title,slide_image) VALUES('{$slide_title}','{$slide_image}')");
          confirm($query);
          set_message("Slide Added");
          redirect("index.php?slides");
      }

  }
}

function get_current_slide_in_admin()
{
   $query=query("SELECT*FROM slides ORDER BY slide_id DESC  LIMIT 1");
  confirm($query);
    while($row=fetch_array($query))
  {
    $slide_image = display_image($row['slide_image']);
    $slide_active_admin= <<<DELIMETER


    <img class="img-responsive"   src="../../resources/{$slide_image}" alt="">


DELIMETER;




      echo $slide_active_admin;

}

}
function get_active()
{
 $query=query("SELECT*FROM slides ORDER BY slide_id DESC  LIMIT 1");
  confirm($query);

  while($row=fetch_array($query))
  {
    $slide_image = display_image($row['slide_image']);
    $slide_active= <<<DELIMETER

<div class="item active">
    <img class="slide-image" src="../resources/{$slide_image}" alt="">
    </div>

DELIMETER;




      echo $slide_active;

}
}
function get_slides()
{
  $query=query("SELECT*FROM slides");
  confirm($query);

  while($row=fetch_array($query))
  {
    $slide_image = display_image($row['slide_image']);
    $slides= <<<DELIMETER

<div class="item">
    <img class="slide-image" src="../resources/{$slide_image}" alt="">
    </div>

DELIMETER;




      echo $slides;
  }



}
function get_slide_thumbnails()
{
  $query=query("SELECT*FROM slides ORDER BY slide_id ASC  ");
  confirm($query);
    while($row=fetch_array($query))
  {
    $slide_image = display_image($row['slide_image']);
    $slide_thumb_admin= <<<DELIMETER


  <div class="col-xs-6 col-md-3">
        <a href="index.php?delete_slide_id={$row['slide_id']}">
            <img  class="img-responsive slide_image" src="../../resources/{$slide_image}" alt="">
        </a>
    </div>


DELIMETER;




      echo $slide_thumb_admin;

}
}


/*****Dashboard Results*****/
function get_no_orders()
{
    $query=query("SELECT*FROM orders");
    $orders=row_count($query);
    echo $orders;

}
function get_no_categories()
{
    $query=query("SELECT*FROM categories");
    $cat=row_count($query);
    echo $cat;

}






 ?>
