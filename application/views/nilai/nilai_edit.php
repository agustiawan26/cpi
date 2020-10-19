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
                                        <i class="pe-7s-display2 icon-gradient bg-happy-itmeo">
                                        </i>
                                    </div>
                                    <div>Edit Nilai
                                        <div class="page-title-subheading">Nilai kriteria alternatif <?= $selectalt->alternatif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>            
                        <div class="tab-content">
                            
                            <div class="tab-pane tabs-animation fade show active" id="tab-content-1" role="tabpanel">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                    <form method="post">
                                        <label class="col-sm-12 col-form-label font-weight-bold">Kriteria Tanpa Parameter</label>
                                        <div class="divider">
                                        </div>
                                        <div class="form-group row">
                                            <?php foreach ($form as $row) : ?>
                                            <label class="col-sm-3 col-form-label">[K<?= $row->kriteria_id ?>] <?= $row->kriteria ?></label>
                                            <div class="col-sm-3">
                                                <?php  foreach($nilai_tbl as $item): if($item->nilai_kriteria_id != $row->nilai_kriteria_id){continue;} ?>
                                                <input name="<?= $row->nilai_kriteria_id ?>" id="<?= $row->nilai_kriteria_id ?>" placeholder="masukkan nilai" class="form-control" type="number" step="0.000000000000001" min="0" value="<?php echo $item->nilai; ?>" required
                                                    oninvalid="this.setCustomValidity('Masukkan nilai yang valid')"
                                                    oninput="setCustomValidity('')"></br>
                                                <?php endforeach;?>
                                            </div>
                                            <?php endforeach ?>
                                        </div>
                                        <div class="divider">
                                        </div>
                                        <label class="col-sm-12 col-form-label font-weight-bold">Kriteria Dengan Parameter</label>
                                        <div class="divider">
                                        </div>
                                        <div class="form-group row">
                                            <?php foreach ($formwp as $row) : ?>
                                            <label class="col-sm-3 col-form-label">[K<?= $row->kriteria_id ?>] <?= $row->kriteria ?></label>
                                            <div class="col-sm-3">
                                                <select class="form-control form-control" name="<?= $row->nilai_kriteria_id ?>" required></br>
                                                    <?php foreach ($parameter as $int) : if ($int->kriteria_id != $row->nilai_kriteria_id) {continue;} ?>
                                                        <option value="<?php echo $int->nilai_parameter; ?>" <?php if ($row->nama_parameter == $int->nama_parameter) {
                                                            echo 'selected'; } ?>>
                                                            [<?php echo $int->nilai_parameter; ?>] <?php echo $int->nama_parameter; ?></option>
                                                        </option>
                                                    <?php endforeach; ?>    
                                                </select>
                                            </div>
                                            <?php endforeach ?>
                                        </div>

                                        <div class="d-block text-center card-footer">
                                            <button class="btn-wide btn-transition btn btn-outline-secondary" name="back" value="back">Kembali</button>
                                            <button type="submit" class="btn-wide btn btn-success" name="updatenilai" value="updatenilai">Simpan Nilai</button>
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
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
    <!-- ETC HERE -->
    <?php $this->load->view("_partials/modal.php") ?>
    <?php $this->load->view("_partials/js.php") ?>

</body>

</html>