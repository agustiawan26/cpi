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
                                        <i class="pe-7s-map-marker icon-gradient bg-happy-itmeo">
                                        </i>
                                    </div>
                                    <div>Daftar Alternatif
                                        <div class="page-title-subheading">Alternatif lokasi embung
                                        </div>
                                    </div>
                                </div>
                                <div class="page-title-actions">
                                    <!-- <div class="d-inline-block dropdown">
                                    <button type="button" class="btn btn-success " name="addalternatif" value="addalternatif">Add Al</button>
                                    <button type="button" class="mb-2 mr-2 btn btn-info" data-toggle="modal" data-target="#addNewModal"><i class="fa fa-plus"></i> Tambah Alternatif</button>  
                                    </div> -->
                                    <a class="mb-2 mr-2 btn btn-light" target="_blank" href="<?= base_url('alternatif/print'); ?>">
                                        <i class="fa fa-file-pdf"></i> Ekspor Data
                                    </a>
                                    <a class="mb-2 mr-2 btn btn-info" href="<?= base_url('alternatif/createAlternatif'); ?>">
                                        <i class="fa fa-plus"></i> Tambah Alternatif
                                    </a>
                                </div>    
                            </div>
                        </div>
                        <?= $this->session->flashdata('message'); ?>              
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="mb-0 table table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Lokasi</th>
                                                <th>Kecamatan</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                    $count=0;
                                                    foreach ($alternatif->result() as $row) :
                                                        $count++;
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $count;?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row->alternatif;?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row->kecamatan;?>
                                                            </td>

                                                            <td>
                                                                <a class="mb-2 mr-2 btn btn-info btn-sm" href="<?php echo base_url('alternatif/updateAlternatif/' . $row->alternatif_id); ?>"><i class="fas fa-edit"></i> Edit</a>
                                                                <!-- <a href="#" class="mb-2 mr-2 btn btn-info btn-sm update-record" data-alternatif_id="<?php echo $row->alternatif_id;?>" data-alternatif="<?php echo $row->alternatif;?>" data-kecamatan="<?php echo $row->kecamatan;?>"><i class="fas fa-edit"></i> Edit</a> -->
                                                                <!-- <a href="#" class="mb-2 mr-2 btn btn-danger btn-sm delete-record" data-alternatif_id="<?php echo $row->alternatif_id;?>"><i class="fas fa-trash"></i> Delete</a> -->
                                                                <!-- <a onclick="deleteConfirm('<?php echo site_url('alternatif/delete/'.$row->alternatif_id) ?>')"
											                        href="#!" class="mb-2 mr-2 btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a> -->
                                                                <a href="<?php echo site_url('alternatif/delete/'.$row->alternatif_id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus alternatif <?php echo $row->alternatif;?>?');"
                                                                class="mb-2 mr-2 btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a>
                                                                </a>
                                                                
                                                            </td>
                                                        </tr>
                                                    <?php endforeach;?>
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
        </div>
    </div>
    <!-- ETC HERE -->
    <?php $this->load->view("_partials/modal.php") ?>

    
    
</body>
</html>

<!--Load JavaScript File-->
<script type="text/javascript" src="<?php echo base_url('./assets/scripts/main.js') ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.4.1.min.js');?>"></script>


<script>
	function deleteConfirm(url){
		$('#btn-delete').attr('href', url);
		$('#deleteModal').modal();
	}
</script>
    
