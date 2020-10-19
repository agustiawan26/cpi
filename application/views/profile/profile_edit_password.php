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
                                        <i class="pe-7s-lock icon-gradient bg-happy-itmeo">
                                        </i>
                                    </div>
                                    <div>Ubah Password Saya
                                        <div class="page-title-subheading">Password Sistem Pendukung Keputusan
                                        </div>
                                    </div>
                                </div>
                                 
                            </div>
                        </div>    
                        <?= $this->session->flashdata('message'); ?>        
                        <div class="row">
                            <!-- <div class="col-md-3">
                                <div class="card-shadow-primary border mb-3 card card-body border-primary">
                                    <img class="rounded-circle" src="<?php echo base_url('upload/user/'.$profile->photo) ?>" alt="Foto Pengguna" style="object-fit: cover; object-position: center; max-width: 100%; display:block; height: auto;">
                                    <br>
                                </div>
                            </div> -->
                            <div class="col-md-4">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <form method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="user_id" value="<?php echo $this->session->userdata("user_id")?>">

                                            <div class="position-relative form-group">
                                                <label class="">Password Lama</label>
                                                <input name="password" placeholder="Masukkan Password Lama" type="password" class="form-control" minlength="5"
                                                    oninvalid="this.setCustomValidity('Kolom Password Lama harus diisi')"
                                                    oninput="setCustomValidity('')">
                                            </div>
                                            <div class="position-relative form-group">
                                                <label class="">Password Baru</label>
                                                <input name="password_new" placeholder="Masukkan Password Baru" type="password" class="form-control" minlength="5"
                                                    oninvalid="this.setCustomValidity('Password minimal 5 karakter')"
                                                    oninput="setCustomValidity('')">
                                            </div>
                                            <div class="position-relative form-group">
                                                <label class="">Konfirmasi Password Baru</label>
                                                <input name="password_new_confirm" placeholder="Masukkan Password Baru" type="password" class="form-control" minlength="5"
                                                    oninvalid="this.setCustomValidity('Password minimal 5 karakter')"
                                                    oninput="setCustomValidity('')">
                                            </div>

                                            <div class="d-block text-center card-footer">
                                                <button class="btn-wide btn-transition btn btn-outline-secondary" name="back" value="back">Kembali</button>
                                                <button type="submit" class="btn-wide btn btn-success" name="changepassword" value="changepassword">Simpan</button>
                                            </div>
                                        </form>
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

