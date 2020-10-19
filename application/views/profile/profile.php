<!doctype html>
<html lang="en">

<head>
    <!-- HEAD HERE -->
    <?php $this->load->view("_partials/head.php") ?>
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    <!-- NAVBAR HERE -->
    <?php $this->load->view("_partials/navbar.php") ?>

        <div class="app-main">
            <!-- SIDEBAR HERE -->
            <?php $this->load->view("_partials/sidebar.php") ?>
            <div class="app-main__outer">
            
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-user icon-gradient bg-happy-itmeo">
                                        </i>
                                    </div>
                                    <div>Profil Saya
                                        <div class="page-title-subheading">Profil Pengguna Sistem Pendukung Keputusan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <?= $this->session->flashdata('message'); ?>            
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card-shadow-primary border mb-3 card card-body border-primary">
                                    
                                    <img class="rounded-circle" src="<?php echo base_url('upload/user/'.$profile->photo) ?>" alt="Foto Pengguna" style="object-fit: cover; object-position: center; max-width: 100%; display:block; height: auto;">

                                    <br>
                                    
                                    <a class="mb-2 mr-2 btn btn-primary btn-lg btn-block" href="<?php echo site_url('profile/changePassword') ?>"><i class="fa fa-lock"></i> Ubah Password</a>
                                    <a class="mb-2 mr-2 btn btn-primary btn-lg btn-block" href="<?php echo site_url('profile/updateProfile') ?>"><i class="fa fa-user"></i> Ubah Profil</a>


                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-shadow-primary border mb-3 card card-body border-primary">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control form-control-round" placeholder="Masukkan Email" name="username" value="<?php echo $profile->full_name?>" required readonly
                                            oninvalid="this.setCustomValidity('Masukkan Email dengan benar')"
                                            oninput="setCustomValidity('')">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control form-control-round" placeholder="Masukkan Email" name="email" value="<?php echo $profile->email?>" required readonly
                                            oninvalid="this.setCustomValidity('Masukkan Email dengan benar')"
                                            oninput="setCustomValidity('')">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Username</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control form-control-round" placeholder="Masukkan Email" name="username" value="<?php echo $profile->username?>" required readonly
                                            oninvalid="this.setCustomValidity('Masukkan Email dengan benar')"
                                            oninput="setCustomValidity('')">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Role</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control form-control-round" placeholder="Masukkan Email" name="role" value="<?php echo $profile->role?>" required readonly
                                            oninvalid="this.setCustomValidity('Masukkan Email dengan benar')"
                                            oninput="setCustomValidity('')">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">No Telepon</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control form-control-round" placeholder="Masukkan Email" name="phone" value="<?php echo $profile->phone?>" required readonly
                                            oninvalid="this.setCustomValidity('Masukkan Email dengan benar')"
                                            oninput="setCustomValidity('')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                <!-- FOOTER HERE -->
                <?php $this->load->view("_partials/footer.php") ?>
            </div>
        </div>
    </div>
    <!-- ETC HERE -->
    <?php $this->load->view("_partials/modal.php") ?>
    <?php $this->load->view("_partials/js.php") ?>
    
</body>

</html>

