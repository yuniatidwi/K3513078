<!DOCTYPE html>
<html>
    <head>
    <?php $this->load->view('template/head');?>
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
            <?php $this->load->view('template/header');?>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <?php $this->load->view('template/sidebar');?>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <?php $this->load->view('template/page_header');?>

                <!-- Main content , place your code here -->
                <section class="content">
                    <?php $this->load->view('template/alert');?>
                    <?php $this->load->view($content);?>               
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <?php $this->load->view('template/footer')?>

    </body>
</html>