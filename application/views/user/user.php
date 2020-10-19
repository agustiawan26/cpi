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
                                        <i class="pe-7s-users icon-gradient bg-happy-itmeo">
                                        </i>
                                    </div>
                                    <div>Daftar Pengguna
                                        <div class="page-title-subheading">Pengguna Sistem Pendukung Keputusan
                                        </div>
                                    </div>
                                </div>
                                <div class="page-title-actions">
                                    <div class="d-inline-block dropdown">
                                    <!-- <a href="<?php echo site_url('admin/user/add/')?>"
                                                        class="mb-2 mr-2 btn btn-info"><i class="fa fa-plus"></i>  Tambah Pengguna</a> -->
                                        <!-- <button type="button" class="mb-2 mr-2 btn btn-info" data-toggle="modal" data-target="#addNewModal"><i class="fa fa-plus"></i> Tambah Pengguna</button>   -->
                                        <a class="mb-2 mr-2 btn btn-info" href="<?= base_url('user/createUser'); ?>"><i class="fas fa-plus"></i> Tambah Pengguna</a>
                                    </div>
                                </div>    
                            </div>
                        </div>            
                        <?= $this->session->flashdata('message'); ?>  
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    
                                    <div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Pengguna</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Username</th>
                                                <th class="text-center">No Telepon</th>
                                                <th class="text-center">Tanggal Daftar</th>
                                                <th class="text-center">Terakhir Login</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                            </thead>
                                            
                                            <tbody>

                                            <?php
                                                $count=0;
                                                foreach ($user->result() as $row) :
                                                $count++;
                                            ?>
                                            <tr>
                                                <td class="text-center text-muted"><?php echo $count;?></td>
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <div class="widget-content-left">
                                                                <img width="45" height="45" class="rounded-circle" src="<?php echo base_url('upload/user/'.$row->photo) ?>" alt="Foto Pengguna" style="object-fit: cover; object-position: center;">
                                                                </div>
                                                            </div>
                                                            <div class="widget-content-left flex2">
                                                                <div class="widget-heading"><?php echo $row->full_name;?></div>
                                                                <div class="widget-subheading opacity-7">Role : <?php echo $row->role;?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center"><?php echo $row->email;?></td>
                                                <td class="text-center"><?php echo $row->username;?></td>
                                                <td class="text-center"><?php echo $row->phone;?></td>
                                                <td class="text-center"><?php echo $row->created_at;?></td>
                                                <td class="text-center"><?php echo $row->last_login;?></td>
                                                <td class="text-center">
                                                    <?php if ($row->is_active == 1){ ?>
                                                        <div class="badge badge-success">Online</div>
                                                    <?php } else { ?>
                                                        <div class="badge badge-warning">Offline</div>
                                                    <?php } ?>
                                                    
                                                </td>
                                                <td class="text-center">
                                                    <?php if($row->user_id != $this->session->userdata("user_id")) { ?>
                                                        <a class="mb-2 mr-2 btn btn-info btn-sm" href="<?php echo base_url('user/updateUser/' . $row->user_id); ?>"><i class="fas fa-edit"></i> Edit</a>
                                                        <!-- <a onclick="deleteConfirm('<?php echo site_url('user/delete/'.$row->user_id) ?>')"
                                                        href="#!" class="mb-2 mr-2 btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a> -->
                                                        <a href="<?php echo site_url('user/delete/'.$row->user_id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna <?php echo $row->full_name;?>?');"
                                                        class="mb-2 mr-2 btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a>
                                                        </a>
                                                    <?php } ?>
                                                </td>
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
        </div>
    </div>
    <!-- ETC HERE -->
    <?php $this->load->view("_partials/modal.php") ?>    
    
    <!-- <script>
	function deleteConfirm(url){
		$('#btn-delete').attr('href', url);
		$('#deleteModal').modal();
	}
	</script>     -->
</body>

</html>

<!--Load JavaScript File-->

<script type="text/javascript" src="<?php echo base_url('./assets/scripts/main.js') ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.4.1.min.js');?>"></script>