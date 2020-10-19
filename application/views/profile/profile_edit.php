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
                                    <div>Ubah Profil Saya
                                        <div class="page-title-subheading">Profil Pengguna Sistem Pendukung Keputusan
                                        </div>
                                    </div>
                                </div>
                                 
                            </div>
                        </div>            
                        <div class="row">
                            <!-- <div class="col-md-3">
                                <div class="card-shadow-primary border mb-3 card card-body border-primary">
                                    <img class="rounded-circle" src="<?php echo base_url('upload/user/'.$profile->photo) ?>" alt="Foto Pengguna" style="object-fit: cover; object-position: center; max-width: 100%; display:block; height: auto;">
                                    <br>
                                </div>
                            </div> -->
                            <div class="col-md-6">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <form method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="user_id" value="<?php echo $this->session->userdata("user_id")?>">

                                            <!-- <div class="position-relative form-group">
                                                <label class="">Nama Lengkap</label>
                                                <input name="full_name" placeholder="Masukkan Nama Lengkap" type="text" class="form-control" value="<?php echo $profile->full_name ?>" required>
                                            </div> -->
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Nama Lengkap</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control-round" placeholder="Masukkan Nama Lengkap" name="full_name" value="<?php echo $profile->full_name?>" required
                                                    oninvalid="this.setCustomValidity('Kolom Nama Lengkap harus diisi')"
                                                    oninput="setCustomValidity('')">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Username</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control-round" placeholder="Masukkan Username" name="username" value="<?php echo $profile->full_name?>" required
                                                    oninvalid="this.setCustomValidity('Kolom Username harus diisi')"
                                                    oninput="setCustomValidity('')">
                                                </div>
                                            </div>
                                            <!-- <div class="position-relative form-group">
                                                <label class="">Username</label>
                                                <input name="username" placeholder="Masukkan Username" type="text" class="form-control" value="<?php echo $profile->username ?>" required>
                                            </div> -->

                                            <!-- <div class="position-relative form-group">
                                                <label class="">Email</label>
                                                <input name="email" placeholder="Masukkan Email" type="email" class="form-control" value="<?php echo $profile->email ?>" readonly="readonly">
                                            </div> -->
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Email</label>
                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control form-control-round" placeholder="Masukkan Email" name="email" value="<?php echo $profile->email?>" required readonly
                                                    oninvalid="this.setCustomValidity('Masukkan Email dengan benar')"
                                                    oninput="setCustomValidity('')">
                                                </div>
                                            </div>
                                            <!-- <div class="position-relative form-group">
                                                <label class="">Password</label>
                                                <input name="password" placeholder="Masukkan Password" type="password" class="form-control">
                                                <small class="form-text text-muted">Kosongkan jika Anda tidak ingin mengubah password</small>
                                            </div> -->
                                            <!-- <div class="position-relative form-group">
                                                <label class="">No Telepon</label>
                                                <input name="phone" placeholder="Masukkan No Telepon" type="text" class="form-control" value="<?php echo $profile->phone ?>" required>
                                            </div> -->
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">No Telepon</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control-round" placeholder="Masukkan No Telepon" name="phone" value="<?php echo $profile->phone?>" required
                                                    oninvalid="this.setCustomValidity('Kolom No Telepon harus diisi')"
                                                    oninput="setCustomValidity('')">
                                                </div>
                                            </div>
                                            <!-- <div class="position-relative form-group">
                                                <label class="">Role</label>
                                                <input name="role" placeholder="Masukkan Role" type="text" class="form-control" value="<?php echo $this->session->userdata("role"); ?>" readonly="readonly" required>
                                            </div> -->
                                            
                                            <!-- <div class="position-relative form-group">
                                                <label class="">Foto Profil</label>
                                                <input name="photo" type="file" class="form-control-file">
                                                
                                                <small class="form-text text-muted">Ukuran maks 1 MB</small>
                                                <small class="form-text text-muted">Format JPG/JPEG/PNG</small>
                                                <small class="form-text text-muted">Kosongkan jika Anda tidak ingin mengubah foto profil</small>
                                            </div>
                                            <input type="hidden" name="old_photo" value="<?php echo $profile->photo ?>"/> -->

                                            <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Foto Profil</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" class="form-control-file" name="photo">
                                                        <small class="form-text text-muted">Ukuran maks 1 MB</small>
                                                        <small class="form-text text-muted">Format JPG/JPEG/PNG</small>
                                                        <small class="form-text text-muted">Kosongkan jika Anda tidak ingin mengubah foto profil</small>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="old_photo" value="<?php echo $profile->photo?>" />

                                            <div class="d-block text-center card-footer">
                                                <button class="btn-wide btn-transition btn btn-outline-secondary" name="back" value="back">Kembali</button>
                                                <button type="submit" class="btn-wide btn btn-success" name="updateprofile" value="updateprofile">Simpan Data</button>
                                            </div>
                                            <!-- <button class="mt-1 btn btn-primary">Submit</button> -->
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

