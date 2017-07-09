<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">


 <?php display_message(); ?>




            <div class="col-md-12">

                <div class="row carousel-holder">

                    <div class="col-md-12">

                      <?php include(TEMPLATE_FRONT . DS . "slider.php") ?>

                    </div>

                </div>
               <div class="row">

                <div class="col-md-12 newproduct">
               <h2><span class="label label-primary">New</span> Arrivals</h2>
                <hr>
                    <?php get_new_products(); ?>

                </div>

               </div>
               <hr>
             <div class="row">

                <div class="col-md-12 newproduct">
               <h2><span class="label label-primary">Popular</span> Products</h2>
                <hr>
                    <?php get_popular_products(); ?>

                </div>

               </div>
               <hr>
                <div class="row">


                    <?php get_products(); ?>


                </div><!-- ROw ends here-->

            </div>

        </div>

    </div>
    <!-- /.container -->
      <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
