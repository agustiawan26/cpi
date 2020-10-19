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
                    <!-- BREADCRUMB HERE -->
                    <!--  -->
                    
                    <div class="row">
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-midnight-bloom">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Jumlah Pengguna</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span><?php echo $jml_user->jumlah_user; ?></span></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-arielle-smile">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Jumlah Kriteria</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span><?php echo $jml_kriteria->jumlah_kriteria; ?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-grow-early">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Jumlah Alternatif</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span><?php echo $jml_alternatif->jumlah_alternatif; ?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="mb-3 card">
                                <div class="card-header-tab card-header">
                                    <div class="card-header-title">
                                        <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>Composite Performance Index (CPI)
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="tab-eg-55">
                                        <div class="widget-chart p-3">
                                            <div style="height: 450px">
                                                <div class="scroll-area-lg">
                                                    <div class="scrollbar-container ps--active-y">
                                                        <p>Composite Performance Index yang merupakan indeks gabungan (Composite Index) yang dapat digunakan untuk menentukan penilaian atau peringkat dari berbagai alternatif (i) berdasarkan beberapa kriteria (j). Metode Composite Performance Index merupakan salah satu metode perhitungan dari pengambilan keputusan berbasis indeks kinerja, metode Composite Performance Index digunakan untuk penilaian dengan kriteria yang tidak seragam.</p>
                                                        <p>Index gabungan (composite index) dapat digunakan untuk menentukan penentuan atau peringkat dari berbagai alternatif berdasarkan beberapa kriteria.</p>
                                                        <p>Prosedur di Composite Performance Index disebutkan sebagai berikut.</p>
                                                        <p>1. Identifikasi kriteria tren yaitu positif (semakin tinggi nilainya semakin baik), dan negatif (semakin rendah nilainya semakin baik).</p>
                                                        <p>2. Untuk kriteria tren positif, nilai minimum pada setiap kriteria ditransformasi ke seratus, sedangkan nilai lainnya ditransformasi secara proporsional lebih tinggi.</p>
                                                        <p>3. Untuk kriteria tren negatif, nilai minimum pada setiap kriteria ditransformasi ke seratus, sedangkan nilai lainnya ditransformasikan lebih rendah.</p>
                                                        <p>4. Perhitungan nilai alternatif merupakan jumlah dari perkalian antara nilai kriteria dengan bobot kriteria.</p>
                                                        <p>Penentuan alternatif menjadi rangking ditentukan berdasarkan perhitungan Bayes.</p>
                                                        <p>Sumber: <link>https://cahyadsn.phpindonesia.id/extra/cpi.php</link></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-6">
                            <div class="mb-3 card">
                                <div class="card-header-tab card-header">
                                    <div class="card-header-title">
                                        <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i> Peta Lokasi
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="tab-eg-55">
                                        <div class="widget-chart p-3">
                                            <div style="height: 450px">
                                                <iframe width="100%" height="400" frameborder="0" src="https://agustiawan26.carto.com/builder/ff6073e9-ee2d-4f3e-a1c6-ca651f69551c/embed" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>
                                            </div>
                                        </div>
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