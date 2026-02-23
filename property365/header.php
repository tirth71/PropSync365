<?php 
    include('config.php');
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">


<head>
    
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--IE Compatibility Meta-->
        <meta name="author" content="zytheme" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Real Estate html5 template">
        <link href="assets/images/favicon/favicon.png" rel="icon">

    
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i%7CPoppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/themes/dark.css">
        <link href="assets/css/external.css" rel="stylesheet">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/style3.css" rel="stylesheet">
        <link href="assets/css/jquery-ui.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/cust.css">
        <link rel="stylesheet" href="assets/css/custom2.css">
        <link rel="stylesheet" href="assets/css/custom3.css">
        <link rel="stylesheet" href="assets/css/logo1.css">
        <link rel="stylesheet" href="assets/css/form.css">
        
        <title>PropSync365</title>

        <style>
                        /* Change Password button + forgot link alignment */
            .action-row{
                display:flex;
                justify-content:space-between;
                align-items:center;
                margin-top:18px;
                width:100%;
            }

            /* button styling */
            .btn-save{
                background:#6c63ff;
                color:#fff;
                padding:12px 28px;
                border:none;
                border-radius:6px;
                font-weight:600;
                cursor:pointer;
            }

            /* forgot password link */
            .forgot-link{
                color:blue;
                font-size:15px;
                text-decoration:none;
            }

            .forgot-link:hover{
                text-decoration:underline;
            }
        </style>
    </head>

    <body>
    <!-- Document Wrapper
       ============================================= -->
       <div id="wrapper" class="wrapper clearfix">
        <header id="navbar-spy" class="header header-1 header-transparent header-fixed z-3">

            <nav id="primary-menu" class="navbar navbar-fixed-top">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="logo" href="index.php">
                           <img class="logo-light" src="assets/images/logo/main.png" alt="Land Logo">
                           <img class="logo-dark" src="assets/images/logo/black.png" alt="Land Logo">
                       </a>
                   </div>

                   <!-- Collect the nav links, forms, and other content for toggling -->
                   <div class="collapse navbar-collapse pull-right" id="navbar-collapse-1">
                    <ul class="nav navbar-nav nav-pos-center navbar-left header-nav-ul headmargin">
                        <!-- Home Menu -->
                        <li>
                            <a href="index.php">home</a>
                        </li>


                            <!-- Profile Menu-->
                            <li>
                                <?php if(@$_SESSION['user_type']==1 && @$_SESSION['email']){?>
                                <a href="user-profile-owner.php" >Profile</a>
                                <?php  }else if(@$_SESSION['user_type']==0 && @$_SESSION['email']){ ?>
                                <a href="user-profile-user.php" >Profile</a>
                                <?php  }?>   
                            </li>
                            <!-- li end -->

                            <!-- Properties Menu-->
                            <?php if(@$_SESSION['email']==""){?>
                            <!-- <li class="has-dropdown active">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item">properties list</a> -->
                                
                                   
                                    <li>
                                        <a href="properties-list.php">properties list</a>
                                    </li>
                            
                            <!-- </li> -->
                        <?php }else{ ?>
                            <li class="has-dropdown active">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item">properties list</a>
                                <ul class="dropdown-menu">
                                    <?php if(@$_SESSION['user_type']==0 && @$_SESSION['email']){?>
                                    <li>
                                        <a href="properties-list.php">properties list</a>
                                    </li>
                                <?php }?>
                                    <li>
                                        <?php if(@$_SESSION['user_type']==1 && @$_SESSION['email']){?>
                                        <a href="my-properties.php">My Properties</a>
                                        <?php  }else if(@$_SESSION['user_type']==0 && @$_SESSION['email']){ ?>
                                        <a href="my-properties-user.php">Purchased Properties</a>
                                        
                                        <?php  }?>
                                    </li>
                                    <!-- <li>
                                        <?php if(@$_SESSION['user_type']==1 && @$_SESSION['email']){?>
                                        <a href="my-rents-user.php">My Properties</a>
                                        <?php  }else if(@$_SESSION['user_type']==0 && @$_SESSION['email']){ ?>
                                        <a href="my-rents-user.php">Ranted Properties</a>
                                        
                                        <?php  }?>
                                    </li> -->
                                </ul>
                            </li>
                        <?php } ?>

                         <?php if(@$_SESSION['email']==""){?>
                            <li>
                                <a href="soldout-visiter.php">Sold Property</a>
                                
                            </li>
                        <?php }else{ ?>
                            <li>
                               <?php if(@$_SESSION['user_type']==0 && @$_SESSION['email']){?>
                                    <li>
                                        <a href="soldout-visiter.php">Sold Property</a>
                                    </li>
                                    <?php }?>
                                    
                                <?php }?>
                            <li><a href="page-contact.php">contact</a></li>

                            <li class="module module-property">
                             <?php
                             if(isset($_SESSION['email']) && @$_SESSION['user_type']==1){?>
                               
                                <a href="add-property.php" class="btn add-property-btn"><i class="fa fa-plus"></i> add property</a><?php } ?> 
                            </li>
                           </ul>

                           
                             <div class="module module-property pul">
                                 <div class="btn-group sign-login-group">          
                                    <ul>
                                        <?php if(@$_SESSION['email']){?>  
                                            <a class="btn btn--primary" href="logout-user.php">Log out</a> 
                                        <?php }else {?>
                                            <a class="btn btn--primary" href="login-user.php">Login</a>
                                        <?php } ?> 
                                    
                                   </ul>
                                   <ul class="sign-up-btn">
                                    <a href="signup-user.php" class="btn btn--primary">sign up</a>
                                   </ul>
                                </div>
                            </div>

                        </div>
                        <!-- /.navbar-collapse -->
                    </div>
                                        
                    <!-- /.container-fluid -->
                </nav>

            </header>
       
