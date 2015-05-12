
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url($conf_avatar);?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo $conf_nama;?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form class="sidebar-form" action="<?php echo base_url().'cari';?>">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..." required>
                            <span class="input-group-btn">
                                <button type='submit' name='cari' value="mahasiswa" id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="<?php echo base_url();?>">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Mahasiswa</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url().'mahasiswa/lihat';?>"><i class="fa fa-angle-double-right"></i> Lihat</a></li>
                                <li><a href="<?php echo base_url().'mahasiswa/input';?>"><i class="fa fa-angle-double-right"></i> Input data</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>