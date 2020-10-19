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
                                        <i class="pe-7s-star icon-gradient bg-happy-itmeo">
                                        </i>
                                    </div>
                                    <div>Peringkat
                                        <div class="page-title-subheading">Prioritas lokasi pembangunan embung
                                        </div>
                                    </div>
                                </div>
                                <div class="page-title-actions">
                                    <a class="mb-2 mr-2 btn btn-light" target="_blank" href="<?= base_url('hitung/printperingkat'); ?>">
                                        <i class="fa fa-file-pdf"></i> Ekspor Data                                    
                                    </a>
                                </div> 
                            </div>
                        </div>
                        
                               
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <table class="mb-0 table table-hover">
                                            <thead>
                                            <tr>
                                            <th class="text-center" width="100">Peringkat</th>
                                            <th class="text-center">Nama Alternatif</th>
                                            <th class="text-center">Nilai CPI</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php $rank = $rank;
                                                foreach ($rank as $key => $val) : ?>
                                                    <tr>
                                                        <td class="text-center"><?= $rank[$key] ?></td>
                                                        <td class="text-center"><?= $alt[$key] ?></td>
                                                        <td class="text-center"><?= number_format(($cpi->nilaicpi[$key]),3,",",".") ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                            
                                            </tbody>
                                        </table>
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
    

    <script>
    function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
    </script>
</body>

</html>
