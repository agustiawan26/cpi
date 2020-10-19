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
                                        <i class="pe-7s-display2 icon-gradient bg-happy-itmeo">
                                        </i>
                                    </div>
                                    <div>Nilai
                                        <div class="page-title-subheading">Nilai kriteria tiap alternatif
                                        </div>
                                    </div>
                                </div>
                                <div class="page-title-actions">
                                    <a class="mb-2 mr-2 btn btn-light" target="_blank" href="<?= base_url('nilai/print'); ?>">
                                        <i class="fa fa-file-pdf"></i> Ekspor Data                                        
                                    </a>
                                </div> 
                            </div>
                        </div>
                        <?= $this->session->flashdata('message'); ?>              
                        <div class="">
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div id="accordion" class="accordion-wrapper mb-3">
                                        <div class="card">
                                            <div id="headingOne" class="card-header">
                                                <button type="button" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block">
                                                    <h5 class="m-0 p-0">Keterangan Kriteria</h5>
                                                </button>
                                            </div>
                                            <div data-parent="#accordion" id="collapseOne1" aria-labelledby="headingOne" class="collapse show">
                                                <div class="card-body">
                                                <?php foreach ($kriteria as $kriteria) : ?>
                                                    <label class="col-sm-5 col-form-label">K<?php echo $kriteria->kriteria_id; ?>   =>   <?php echo $kriteria->kriteria; ?></label>
                                                <?php endforeach; ?>
                                                </div>
                                            </div>

                                            


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                               
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="mb-0 table table-hover">
                                            <thead>
                                            <tr>
                                            <th class="text-center">Nama Alternatif</th>
                                            <?php foreach ($kriteriahead as $kriteria) : ?>
                                                    <th class="text-center">K<?php echo $kriteria->kriteria_id; ?></th>
                                                <?php endforeach; ?>
                                            <th class="text-center">Aksi</th>
                                            </tr>
                                            </thead>


                                            <tbody>
                                            
                                            <?php 
                                                foreach ($alternatif as $item) : ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $item->alternatif; ?></td> 
                                                        <?php foreach ($nilai[$item->alternatif_id] as $k => $v) : ?> 
                                                            <td class="text-center"><?= $v; ?></td>
                                                        <?php endforeach; ?>
                                                        <td class="text-center"><a class="mb-2 mr-2 btn btn-info" href="<?php echo site_url('nilai/updateNilai/'.$item->alternatif_id) ?>"><i class="fas fa-edit"></i> Edit</a>
                                                        </td>
                                                    </tr>
                                                    <?php 
                                                endforeach; ?>
                                            </tbody>
                                        </table>
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
    <!-- ETC HERE -->
    <?php $this->load->view("_partials/modal.php") ?>
    <?php $this->load->view("_partials/js.php") ?>
    
</body>

</html>
