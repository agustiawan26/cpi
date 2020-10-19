<div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                    </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                        <?php if($this->session->userdata('role')==='admin'):?>

                            <!-- <li class="app-sidebar__heading">Akun Saya</li>
                            <img width="60" class="rounded-circle" src="<?php echo base_url('upload/user/'.$this->session->userdata('photo')); ?>" />
                            <p><?php echo $this->session->userdata('username');?></p>
                                        <?php if ($this->session->userdata('role')=='admin'){?>
                                            <p style="font-size: 10px;">&nbsp;Administrator&nbsp;&nbsp;
                                        <?php } else if ($this->session->userdata('hak_akses')==2){?>
                                            <p style="font-size: 10px;">&nbsp;Manager&nbsp;&nbsp;
                                        <?php } else if ($this->session->userdata('hak_akses')==3){?>
                                            <p style="font-size: 10px;">&nbsp;Client&nbsp;&nbsp;
                                        <?php } ?>  
                                    <a href="#" style="font-size: 10px;"><i class="fa fa-circle text-success"></i> Online</a></p>
                            <li>
                                <a href=<?php echo site_url('myprofile') ?> class="<?php echo $this->uri->segment(1) == 'myprofile' ? 'mm-active': '' ?>">
                                
    
                                Profil Saya
                                </a>
                            </li>
                            <div class="widget-content-left mr-3">
                                                                            <img width="42" class="rounded-circle" src="assets/images/avatars/9.jpg" alt="">
                                                                        </div>
                                                                        <div class="widget-content-left">
                                                                            <div class="widget-heading">Ella-Rose Henry</div>
                                                                            <div class="widget-subheading">Web Developer</div>
                                                                        </div>
                            <div class="user-panel">
                                <div class="pull-left image">
                                    <img src="<?php echo base_url();?>assets/dist/img/fix-user.png" class="img-circle" alt="User Image">
                                </div>
                                <div class="pull-left info">
                                    <p><?php echo $this->session->userdata('username');?></p>
                                        <?php if ($this->session->userdata('role')=='admin'){?>
                                            <p style="font-size: 10px;">&nbsp;Administrator&nbsp;&nbsp;
                                        <?php } else if ($this->session->userdata('hak_akses')==2){?>
                                            <p style="font-size: 10px;">&nbsp;Manager&nbsp;&nbsp;
                                        <?php } else if ($this->session->userdata('hak_akses')==3){?>
                                            <p style="font-size: 10px;">&nbsp;Client&nbsp;&nbsp;
                                        <?php } ?>  
                                    <a href="#" style="font-size: 10px;"><i class="fa fa-circle text-success"></i> Online</a></p>
                                </div>
                            </div>

                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                <button type="button" tabindex="0" class="dropdown-item">Profil Saya</button>
                                <div tabindex="-1" class="dropdown-divider"></div>
                                <a type="button" tabindex="0" class="dropdown-item" href="<?php echo site_url('login/logout');?>">Logout</a>

                            </div>    -->

                            <li class="app-sidebar__heading">Beranda</li>
                            <li>
                                <a href=<?php echo site_url('admin') ?> class="<?php echo $this->uri->segment(1) == 'admin' ? 'mm-active': '' ?>">
                                    <i class="metismenu-icon pe-7s-home "></i> Beranda
                                </a>
                            </li>

                            <li class="app-sidebar__heading">Data</li>
                            <li>
                                <a href="<?php echo site_url('user') ?>" class="<?php echo $this->uri->segment(1) == 'user' ? 'mm-active': '' ?>">
                                    <i class="metismenu-icon pe-7s-users"></i> Pengguna
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('kriteria') ?>" class="<?php echo $this->uri->segment(1) == 'kriteria' ? 'mm-active': '' ?>">
                                    <i class="metismenu-icon pe-7s-keypad"></i> Kriteria
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('alternatif') ?>" class="<?php echo $this->uri->segment(1) == 'alternatif' ? 'mm-active': '' ?>">
                                    <i class="metismenu-icon pe-7s-map-marker"></i> Alternatif
                                </a>
                            </li>
                            
                            <!-- <li>
                                <a href="<?php echo site_url('admin/parameterkriteria') ?>" class="<?php echo $this->uri->segment(1) == 'parameterkriteria' ? 'mm-active': '' ?>">
                                    <i class="metismenu-icon pe-7s-display2"></i> Parameter Kriteria
                                </a>
                            </li> -->
                            

                            <li class="app-sidebar__heading">CPI</li>
                    
                            <li>
                                <a href="<?php echo site_url('nilai') ?>" class="<?php echo $this->uri->segment(1) == 'nilai' ? 'mm-active': '' ?>">
                                    <i class="metismenu-icon pe-7s-display2"></i> Nilai Kriteria
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('hitung') ?>" class="<?php echo $this->uri->segment(1) == 'hitung' ? 'mm-active': '' ?>">
                                    <i class="metismenu-icon pe-7s-tools"></i> Perhitungan
                                </a>
                            </li>
                            <li>
                            <a href="<?php echo site_url('peringkat') ?>" class="<?php echo $this->uri->segment(1) == 'peringkat' ? 'mm-active': '' ?>">
                                    <i class="metismenu-icon pe-7s-star">
                                    </i> Hasil Peringkat
                                </a>
                            </li>

                            <!-- <li class="app-sidebar__heading">Data Pengguna</li>
                            <li>
                                <a href="<?php echo site_url('user') ?>" class="<?php echo $this->uri->segment(1) == 'user' ? 'mm-active': '' ?>">
                                    <i class="metismenu-icon pe-7s-users"></i> Daftar Pengguna
                                </a>
                            </li> -->
                        <?php else:?>
                            <li class="app-sidebar__heading">Beranda</li>
                            <li>
                                <a href=<?php echo site_url('manager') ?> class="<?php echo $this->uri->segment(1) == 'manager' ? 'mm-active': '' ?>">
                                    <i class="metismenu-icon pe-7s-rocket "></i> Beranda
                                </a>
                            </li>

                            <li class="app-sidebar__heading">Data</li>
                            <li>
                                <a href="<?php echo site_url('kriteria') ?>" class="<?php echo $this->uri->segment(1) == 'kriteria' ? 'mm-active': '' ?>">
                                    <i class="metismenu-icon pe-7s-keypad"></i> Kriteria
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('alternatif') ?>" class="<?php echo $this->uri->segment(1) == 'alternatif' ? 'mm-active': '' ?>">
                                    <i class="metismenu-icon pe-7s-map-marker"></i> Alternatif
                                </a>
                            </li>
                            
                            <!-- <li>
                                <a href="<?php echo site_url('admin/parameterkriteria') ?>" class="<?php echo $this->uri->segment(1) == 'parameterkriteria' ? 'mm-active': '' ?>">
                                    <i class="metismenu-icon pe-7s-display2"></i> Parameter Kriteria
                                </a>
                            </li> -->
                            

                            <li class="app-sidebar__heading">CPI</li>
                    
                            <li>
                                <a href="<?php echo site_url('nilai') ?>" class="<?php echo $this->uri->segment(1) == 'nilai' ? 'mm-active': '' ?>">
                                    <i class="metismenu-icon pe-7s-display2"></i> Nilai Kriteria
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('hitung') ?>" class="<?php echo $this->uri->segment(1) == 'hitung' ? 'mm-active': '' ?>">
                                    <i class="metismenu-icon pe-7s-tools"></i> Perhitungan
                                </a>
                            </li>
                            <li>
                            <a href="<?php echo site_url('peringkat') ?>" class="<?php echo $this->uri->segment(1) == 'peringkat' ? 'mm-active': '' ?>">
                                    <i class="metismenu-icon pe-7s-star">
                                    </i> Hasil Peringkat
                                </a>
                            </li>
                        <?php endif;?>
                        </ul>
                    </div>
                </div>
            </div>