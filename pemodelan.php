<?php
	include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Pemodelan</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html">Data Mining</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-home"></i>
          <span>Home</span>
        </a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="data_asli.php">
          <i class="fas fa-fw fa-database"></i>
          <span>Data Asli</span>
        </a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="dataset.php">
          <i class="fas fa-fw fa-th-list"></i>
          <span>Dataset</span>
        </a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="data_uji_latih.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Data Training & Data Testing</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="pemodelan.php">
          <i class="fas fa-fw fa-cube"></i>
          <span>Pemodelan</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="verifikasi.php">
          <i class="fas fa-fw fa-check-circle"></i>
          <span>Verifikasi</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

		<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pemodelan</h1>
		</div>
		
		<div class="card mb-3">
		  <div class="card-header">
			<i class="fas fa-table"></i>
			Confusion Matrix</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th scope="col"></th>
					<th scope="col">Prediksi Lancar</th>
					<th scope="col">Prediksi Macet</th>
                  </tr>
                </thead>
                <tbody>
					<?php 
					$data = mysql_query("select * from data_testing");
					$total_beda = 0;
					$true_true = 0;
					$true_false = 0;
					$false_true = 0;
					$false_false = 0;
					$presisi = 0;
					$recall = 0;
					$akurasi = 0;
					
					while($d = mysql_fetch_array($data)){
						$aktual = $d['aktual'];
						$prediksi = $d['prediksi'];
						
						if ($aktual=="Lancar" && $prediksi=="Lancar"){
							$true_true++;
						}
						if ($aktual=="Lancar" && $prediksi=="Macet"){
							$true_false++;
							$total_beda++;
						}
						if ($aktual=="Macet" && $prediksi=="Lancar"){
							$false_true++;
							$total_beda++;
						}
						if ($aktual=="Macet" && $prediksi=="Macet"){
							$false_false++;
						}
					}
					
					if($true_true != 0){
						$presisi = (round(($true_true / ($true_true + $false_true)) * 100,5));
						$recall = (round(($true_true / ($true_true + $true_false)) * 100,5));
						$akurasi = (round((($true_true + $false_false) / ($true_true + $true_false + $false_true + $false_false)) * 100,5));
					}
					
					?>
					<tr>
						<td><b>Aktual Lancar</b></td>
						<td class="table-success"><?php echo $true_true; ?></td>
						<td class="table-danger"><?php echo $true_false; ?></td>
					</tr>
					<tr>
						<td><b>Aktual Macet</b></td>
						<td class="table-danger"><?php echo $false_true; ?></td>
						<td class="table-success"><?php echo $false_false; ?></td>
					</tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
		
		<div class="card mb-3">
		  <div class="card-header">
			<i class="fas fa-chart-bar"></i>
			Akurasi, Recall & Presisi</div>
          <div class="card-body">
            <canvas id="myChart" height="50"></canvas>
          </div>
        </div>
		
		<div class="card mb-3">
		  <div class="card-header">
			<i class="fas fa-table"></i>
			Pemodelan Aktual</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm display" id="" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th scope="col">Total Data</th>
					<th scope="col">Total Data Macet</th>
					<th scope="col">Total Data Lancar</th>
					<th scope="col">Probabilitas Macet</th>
					<th scope="col">Probabalitas Lancar</th>
                  </tr>
                </thead>
                <tbody>
					<?php 
					$data = mysql_query("select * from perhitungan where atribut='total'");
					
					$sql_total_data = mysql_query ("SELECT COUNT(*) as aktual FROM data_training");
					$row_total_data = mysql_fetch_array($sql_total_data);
					$get_total_data = $row_total_data['aktual'];
					
					while($d = mysql_fetch_array($data)){
					?>
						<tr>
							<td><?php echo $get_total_data; ?></td>
							<td><?php echo $d['total_macet']; ?></td>
							<td><?php echo $d['total_lancar']; ?></td>
							<td><?php echo $d['probabilitas_macet']; ?></td>
							<td><?php echo $d['probabilitas_lancar']; ?></td>
						</tr>
					<?php 
						}
					?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
		
		<div class="card mb-3">
		  <div class="card-header">
			<i class="fas fa-table"></i>
			Pemodelan Tiap Atribut</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm display" id="" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Atribut</th>
					<th scope="col">Nilai</th>
					<th scope="col">Total Data</th>
					<th scope="col">Total Data Macet</th>
					<th scope="col">Total Data Lancar</th>
					<th scope="col">Probabilitas Macet</th>
					<th scope="col">Probabalitas Lancar</th>
                  </tr>
                </thead>
                <tbody>
					<?php 
					$no = 1;
					$data = mysql_query("select * from perhitungan where not atribut='total'");
					while($d = mysql_fetch_array($data)){
						$total_data = $d['total_macet'] + $d['total_lancar'];
					?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $d['atribut']; ?></td>
							<td><?php echo $d['nilai']; ?></td>
							<td><?php echo $total_data; ?></td>
							<td><?php echo $d['total_macet']; ?></td>
							<td><?php echo $d['total_lancar']; ?></td>
							<td><?php echo $d['probabilitas_macet']; ?></td>
							<td><?php echo $d['probabilitas_lancar']; ?></td>
						</tr>
					<?php
						$no++;
						}
					?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Hengki Cahya Wijaya © 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>
  
  <script type="text/javascript" src="vendor/chartjs/Chart.js"></script>
  <script>
	var ctx = document.getElementById("myChart").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'horizontalBar',
		data: {
			labels: ["Akurasi", "Recall", "Presisi"],
			datasets: [{
				label: "",
				data: [
				<?php 
				echo $akurasi;
				?>, 
				<?php 
				echo $recall;
				?>, 
				<?php 
				echo $presisi;
				?>
				],
				backgroundColor: [
				'rgba(255, 99, 132, 0.2)',
				'rgba(54, 162, 235, 0.2)',
				'rgba(255, 206, 86, 0.2)'
				],
				borderColor: [
				'rgba(255,99,132,1)',
				'rgba(54, 162, 235, 1)',
				'rgba(255, 206, 86, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
			xAxes: [{
					ticks: {
						beginAtZero:true,
						max: 100
					}
				}]
			},
			legend: {
				display: false
			}
		}
	});
	</script>
	<script>		
		$(document).ready(function() {
			$('table.display').DataTable( {
				fixedHeader: {
					header: true,
					footer: true
				}
			} );
		} );
	</script>
</body>

</html>
