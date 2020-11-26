<?php
$info = $this->session->userdata('business_info');
if(!empty($info->currency))
{
    $currency = $info->currency ;
}else
{
    $currency = '$';
}
?>
        <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>" class="logo"><b>Bedford</b>Engineering</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->


            <div class="navbar-custom-menu pull-right">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <?php
                    if(!empty($_SESSION["notify_product"]))
                    {
                        $notify_product = $_SESSION["notify_product"];
                        $notify_product_count = count($notify_product);
                    }
                    ?>



                    <!-- Notifications: style can be found in dropdown.less -->

                    

                    <li>
                        <a href="<?php echo base_url()?>login/logout" >
                            <span class="glyphicon glyphicon-off"></span> Logout
                        </a>

                    </li>


                </ul>
            </div>


        </nav>
      </header>