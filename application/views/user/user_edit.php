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
            <?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-users icon-gradient bg-happy-itmeo">
                                        </i>
                                    </div>
                                    <div>Edit Pengguna
                                        <div class="page-title-subheading">Pengguna Sistem Pendukung Keputusan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>            
                        <div class="tab-content">
                            <div class="tab-pane tabs-animation fade show active" id="tab-content-1" role="tabpanel">
                                <div class="col-lg-6">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body">
                                            <form method="post" enctype="multipart/form-data">

                                                <input type="hidden" name="user_id" value="<?php echo $select->user_id?>">
                                                
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Nama Lengkap</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control form-control-round" placeholder="Masukkan Nama Lengkap" name="full_name" value="<?php echo $select->full_name?>">
                                                        <?= form_error('full_name', '<small class="text-danger" pl-3>', '</small>') ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Username</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control form-control-round" placeholder="Masukkan Username" name="username" value="<?php echo $select->username?>">
                                                        <?= form_error('username', '<small class="text-danger" pl-3>', '</small>') ?>
                                                        
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Password</label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control form-control-round" placeholder="Masukkan Password" name="password">
                                                        <?= form_error('password', '<small class="text-danger" pl-3>', '</small>') ?>
                                                        <input type="hidden" name="old_password" value="<?php echo $select->password ?>">
                                                        <small class="form-text text-muted">Kosongkan jika Anda tidak ingin mengubah password</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Email</label>
                                                    <div class="col-sm-8">
                                                        <input type="email" class="form-control form-control-round" placeholder="Masukkan Email" name="email" value="<?php echo $select->email?>" readonly>
                                                        <?= form_error('password', '<small class="text-danger" pl-3>', '</small>') ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">No Telepon</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control form-control-round" placeholder="Masukkan No Telepon" name="phone" value="<?php echo $select->phone?>">
                                                        <?= form_error('password', '<small class="text-danger" pl-3>', '</small>') ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Role</label>
                                                    <div class="col-sm-8">
                                                        <select name="role" id="role" class="form-control">
                                                            <option>admin</option>
                                                            <option value="manager" <? echo $select->role == 'manager' ? 'selected' : '' ?>>manager</option>
                                                        </select>  
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Foto Pengguna</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" class="form-control-file" name="photo">
                                                        <small class="form-text text-muted">Ukuran maks 1 MB</small>
                                                        <small class="form-text text-muted">Format JPG/JPEG/PNG</small>
                                                        <small class="form-text text-muted">Kosongkan jika Anda tidak ingin mengubah foto</small>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="old_photo" value="<?php echo $select->photo?>" />

                                                
                                                
                                                
                                                
                                                <div class="d-block text-center card-footer">
                                                    <a href="<?php echo site_url('user/') ?>" class="btn-wide btn-transition btn btn-outline-secondary" >Kembali</a>
                                                    <button type="submit" class="btn-wide btn btn-success" name="updateuser" value="updateuser">Simpan</button>
                                                </div>
                                                
                                            </form>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                <!-- FOOTER HERE -->
                <?php $this->load->view("_partials/footer.php") ?>
            </div>
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
    <!-- ETC HERE -->
    <?php $this->load->view("_partials/modal.php") ?>
    <?php $this->load->view("_partials/js.php") ?>

</body>

</html>

