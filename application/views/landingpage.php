<!--
=========================================================
Material Kit - v2.0.7
=========================================================

Product Page: https://www.creative-tim.com/product/material-kit
Copyright 2020 Creative Tim (https://www.creative-tim.com/)

Coded by Creative Tim

=========================================================

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    SPK - CPI
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="./assets/css/material-kit.css?v=2.0.7" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="index-page sidebar-collapse">
  <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="#">
          SPK-CPI </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" onclick="scrollToKriteria()">
                <i class="material-icons">layers</i> Kriteria
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" onclick="scrollToAlternatif()">
                <i class="material-icons">location_on</i> Alternatif
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" onclick="scrollToNilai()">
                <i class="material-icons">apps</i> Nilai
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" onclick="scrollToPeringkat()">
                <i class="material-icons">star_outline</i> Peringkat
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" onclick="scrollToPeta()">
                <i class="material-icons">maps</i> Peta
            </a>
          </li>
          <br>
          <li class="nav-item">
            <a class="btn btn-primary btn-round" href="<?php echo site_url('login') ?>">Login</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>
  
  <div class="page-header header-filter clear-filter purple-filter" data-parallax="true" style="background-image: url('./assets/img/bg2.jpg');">
    <div class="container">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <div class="brand">
            <h1>Sistem Pendukung Keputusan</h1>
            <h3>Menggunakan Metode Composite Performance Index (CPI) untuk Penentuan Prioritas Lokasi Pembangunan Embung di Kabupaten Semarang</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="main main-raised">
    <div class="section section-download" id="downloadSection">
      <div class="container">
        <div class="row text-center">
          <div class="col-md-8 mx-auto">
            <h2>Metode Composite Performance Index (CPI)</h2>
            <h4>Composite Performance Index yang merupakan indeks gabungan (Composite Index) yang dapat digunakan <b>untuk menentukan penilaian atau peringkat</b> dari berbagai alternatif (i) berdasarkan beberapa kriteria (j). Metode Composite Performance Index merupakan salah satu metode perhitungan dari pengambilan keputusan <b>berbasis indeks kinerja</b>, metode Composite Performance Index digunakan untuk penilaian dengan kriteria yang tidak seragam.</h4>
            
          </div>
        </div>
      
        <div class="card bg-dark text-white">
          <img class="card-img" src="assets/images/embung-doho.png" rel="nofollow" alt="Card image">
          <div class="card-img-overlay">
            <h4 class="card-title">Embung</h4>
            <p class="card-text">Embung atau cekungan penampung (retention basin) adalah cekungan yang digunakan untuk mengatur dan menampung suplai aliran air hujan serta untuk meningkatkan kualitas air di badan air yang terkait (sungai, danau). Embung digunakan untuk menjaga kualitas air tanah, mencegah banjir, estetika, hingga pengairan. Embung menampung air hujan di musim hujan dan lalu digunakan petani untuk mengairi lahan di musim kemarau.</p>
            <p class="card-text">Sumber gambar: <link>liputan6.com</link></p>

          </div>
        </div>

        <div class="sharing-area text-center">
          <div class="row justify-content-center section-kriteria" id="kriteriaSection">
            <h3>Kriteria</h3>
          </div>
        </div>
        <div class="progress">
          <div class="progress-bar " role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-8 ">
              <div class="main-card mb-3 card ">
                  <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>ID Kriteria</th>
                            <th>Nama Kriteria</th>
                            <th>Bobot</th>
                            <th>Tren</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $count = 0;
                          foreach ($kriteria->result() as $kriteria): 
                          $count++;
                          ?>
                          <tr>
                            <td>
                              <?php echo ("K").$kriteria->kriteria_id ?>
                            </td>
                            <td>
                              <?php echo $kriteria->kriteria ?>
                            </td>
                            <td>
                              <?php echo $kriteria->bobot ?>
                            </td>
                            <td>
                              <?php echo $kriteria->tren ?>
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

        <div class="sharing-area text-center">
          <div class="row justify-content-center section-alternatif" id="alternatifSection">
            <h3>Alternatif</h3>
          </div>
        </div>
        <div class="progress">
          <div class="progress-bar " role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-6 ">
              <div class="main-card mb-3 card ">
                  <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Nama Alternatif</th>
                            <th>Kecamatan</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $count = 0;
                          foreach ($alternatif as $alternatif): 
                          $count++;?>
                          <tr>
                            <td>
                                <?php echo $count;?>
                            </td>
                            <td>
                              <?php echo $alternatif->alternatif ?>
                            </td>
                            <td>
                              <?php echo $alternatif->kecamatan ?>
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

        <div class="sharing-area text-center">
          <div class="row justify-content-center section-nilai" id="nilaiSection">
            <h3>Nilai</h3>
          </div>
        </div>
        <div class="progress">
          <div class="progress-bar " role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-12">
              <div class="main-card mb-3 card ">
                  <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                          <th>Nama Alternatif</th>
                          <?php foreach ($kriteriahead as $kriteriahead) : ?>
                              <th>K<?php echo $kriteriahead->kriteria_id; ?></th>
                          <?php endforeach; ?>
                          </tr>
                          </thead>
                          <tbody>
                          <?php 
                              foreach ($alternatiff as $item) : ?>
                                  <tr>
                                      <td><?php echo $item->alternatif; ?></td> 
                                      <?php foreach ($nilai[$item->alternatif_id] as $k => $v) : ?> 
                                          <td><?= $v; ?></td>
                                      <?php endforeach; ?>
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

        <div class="sharing-area text-center">
          <div class="row justify-content-center section-peringkat" id="peringkatSection">
            <h3>Peringkat</h3>
          </div>
        </div>
        <div class="progress">
          <div class="progress-bar " role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-6 ">
              <div class="main-card mb-3 card ">
                  <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-striped">
                      <thead>
                          <tr>
                          <th width="100">Peringkat</th>
                          <th>Nama Alternatif</th>
                          <th>Nilai CPI</th>
                          </tr>
                          </thead>


                          <tbody>
                          <?php $rank = $rank;
                              foreach ($rank as $key => $val) : ?>
                                  <tr>
                                      <td><?= $rank[$key] ?></td>
                                      <td><?= $alt[$key] ?></td>
                                      <td><?= round(($cpi->nilaicpi[$key]),4) ?></td>
                                  </tr>
                              <?php endforeach; ?>
                                          
                          </tbody>
                      </table>
                  </div>
                  </div>
              </div>
          </div>
        </div>
        

        <div class="sharing-area text-center">
          <div class="row justify-content-center section-peta" id="petaSection">
            <h3>Peta</h3>
          </div>
        </div>
        <div class="progress">
          <div class="progress-bar " role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-body">
              <iframe width="100%" height="550" frameborder="0" src="https://agustiawan26.carto.com/builder/ff6073e9-ee2d-4f3e-a1c6-ca651f69551c/embed" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer" data-background-color="black">
    <div class="container">
      <!-- <nav class="float-left">
        <ul>
          <li>
            <a href="https://www.creative-tim.com/">
              Creative Tim
            </a>
          </li>
          <li>
            <a href="https://www.creative-tim.com/presentation">
              About Us
            </a>
          </li>
          <li>
            <a href="https://www.creative-tim.com/blog">
              Blog
            </a>
          </li>
          <li>
            <a href="https://www.creative-tim.com/license">
              Licenses
            </a>
          </li>
        </ul>
      </nav> -->
      <div class="copyright float-center">
        &copy;
        <script>
          document.write(new Date().getFullYear())
        </script>, made with <i class="material-icons">favorite</i> by
        <a href="https://www.instagram.com/awan_agusti/" target="_blank">Agustiawan</a>
      </div>
    </div>
  </footer>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="./assets/js/plugins/moment.min.js"></script>
  <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="./assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/material-kit.js?v=2.0.7" type="text/javascript"></script>
  <script>
    $(document).ready(function() {
      //init DateTimePickers
      materialKit.initFormExtendedDatetimepickers();

      // Sliders Init
      materialKit.initSliders();
    });


    function scrollToDownload() {
      if ($('.section-download').length != 0) {
        $("html, body").animate({
          scrollTop: $('.section-download').offset().top
        }, 1000);
      }
    }

    function scrollToKriteria() {
      if ($('.section-kriteria').length != 0) {
        $("html, body").animate({
          scrollTop: $('.section-kriteria').offset().top
        }, 1000);
      }
    }

    function scrollToAlternatif() {
      if ($('.section-alternatif').length != 0) {
        $("html, body").animate({
          scrollTop: $('.section-alternatif').offset().top
        }, 1000);
      }
    }

    function scrollToNilai() {
      if ($('.section-nilai').length != 0) {
        $("html, body").animate({
          scrollTop: $('.section-nilai').offset().top
        }, 1000);
      }
    }

    function scrollToPeringkat() {
      if ($('.section-peringkat').length != 0) {
        $("html, body").animate({
          scrollTop: $('.section-peringkat').offset().top
        }, 1000);
      }
    }

    function scrollToPeta() {
      if ($('.section-peta').length != 0) {
        $("html, body").animate({
          scrollTop: $('.section-peta').offset().top
        }, 1000);
      }
    }
  </script>
</body>

</html>