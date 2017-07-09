<?php require_once("../../resources/config.php"); ?>

<?php include(TEMPLATE_BACK . "/header.php"); ?>

<?php

if(!isset($_SESSION['admin'])) {


redirect("../../public");

}


 ?>

        <div id="page-wrapper">

            <div class="container-fluid">




                <?php




                if(isset($_GET['orders'])){


                    include(TEMPLATE_BACK . "/orders.php");


                }

                else if(isset($_GET['categories'])){


                    include(TEMPLATE_BACK . "/categories.php");


                }

                else if(isset($_GET['products'])){


                    include(TEMPLATE_BACK . "/products.php");


                }


                else  if(isset($_GET['add_product'])){


                    include(TEMPLATE_BACK . "/add_product.php");


                }


                 else if(isset($_GET['edit_product'])){


                    include(TEMPLATE_BACK . "/edit_product.php");


                }

               else if(isset($_GET['users'])){


                    include(TEMPLATE_BACK . "/users.php");


                }


                else if(isset($_GET['add_user'])){


                    include(TEMPLATE_BACK . "/add_user.php");


                }


                else  if(isset($_GET['edit_user'])){


                    include(TEMPLATE_BACK . "/edit_user.php");


                }


                 else if(isset($_GET['reports'])){


                    include(TEMPLATE_BACK . "/reports.php");


                }
               else if(isset($_GET['slides'])){


                    include(TEMPLATE_BACK . "/slides.php");


                }
               else if(isset($_GET['delete_slide_id'])){


                    include(TEMPLATE_BACK . "/delete_slide.php");


                }
                else if(isset($_GET['add_edit_cat'])){


                    include(TEMPLATE_BACK . "/add_edit_cat.php");


                }
                else
                {


                    include(TEMPLATE_BACK . "/admin_content.php");

                }











                 ?>



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


<?php include(TEMPLATE_BACK . "/footer.php"); ?>
