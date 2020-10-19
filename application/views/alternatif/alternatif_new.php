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
                                    <i class="pe-7s-map-marker icon-gradient bg-happy-itmeo">
                                        </i>
                                    </div>
                                    <div>Tambah Alternatif
                                        <div class="page-title-subheading">Alternatif lokasi embung
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
                                            <form method="post">

                                                <input type="hidden" name="alternatif_id" value="<?php echo $gen->max_id ?>">
                                                <!-- <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Kode Kriteria</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control form-control-round" readonly="readonly" name="alternatif_id" value="<?php echo $gen->max_id; ?>">
                                                    </div>
                                                </div> -->
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Nama Alternatif</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control form-control-round" placeholder="Masukkan Nama Alternatif" name="alternatif" required
                                                        oninvalid="this.setCustomValidity('Kolom Nama Alternatif harus diisi')"
                                                        oninput="setCustomValidity('')">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Kecamatan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control form-control-round" placeholder="Masukkan Kecamatan" name="kecamatan" required
                                                        oninvalid="this.setCustomValidity('Kolom Kecamatan harus diisi')"
                                                        oninput="setCustomValidity('')">
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="d-block text-center card-footer">
                                                    <a href="<?php echo site_url('alternatif/') ?>" class="btn-wide btn-transition btn btn-outline-secondary" >Kembali</a>
                                                    <button type="submit" class="btn-wide btn btn-success" name="tambahalternatif" value="tambahalternatif">Simpan</button>
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