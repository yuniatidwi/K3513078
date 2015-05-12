
        <header class="header">
            <a href="<?php echo base_url();?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Foss
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $conf_nama ;?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo base_url($conf_avatar);?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $conf_nama ;?> | <?php echo $conf_nim ;?>
                                        <small><?php echo $conf_prodi ;?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <div class="margin text-center">
                                    <a href="<?php echo $conf_facebook ;?>" target="blank"><button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button></a>
                                    <a href="<?php echo $conf_twitter ;?>" target="blank"><button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button></a>
                                    <a href="<?php echo $conf_google_plus ;?>"><button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button></a>
                                </div>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url().'logout';?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>