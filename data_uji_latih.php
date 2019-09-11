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

  <title>Data Training & Data Testing</title>

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
	  <li class="nav-item active">
        <a class="nav-link" href="data_uji_latih.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Data Training & Data Testing</span>
        </a>
      </li>
      <li class="nav-item">
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
            <h1 class="h3 mb-0 text-gray-800">Data Training & Data Testing</h1>
		</div>
		
		<div class="card mb-3">
		  <div class="card-header">
			<i class="fas fa-table"></i>
			Data Training</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm display" id="" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th scope="col">No</th>
					<th scope="col">Pinjaman Ke-</th>
					<th scope="col">Usia</th>
					<th scope="col">Usaha</th>
					<th scope="col">Anggota Sejak</th>
					<th scope="col">Total Pinjaman Keseluruhan</th>
					<th scope="col">Besar Pinjaman</th>
					<th scope="col">Angsuran</th>
					<th scope="col">Lama Pinjaman</th>
					<th scope="col">Aktual</th>
					<th scope="col">Prediksi</th>
                  </tr>
                </thead>
                <tbody>
					<?php 
					$no = 1;
					$data = mysql_query("select * from data_training");
					while($d = mysql_fetch_array($data)){
					?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $d['pinjaman_ke']; ?></td>
						<td><?php echo $d['usia']; ?></td>
						<td><?php echo $d['usaha']; ?></td>
						<td><?php echo $d['anggota_sejak']; ?></td>
						<td><?php echo $d['total_pinjaman']; ?></td>
						<td><?php echo $d['besar_pinjaman']; ?></td>
						<td><?php echo $d['angsuran']; ?></td>
						<td><?php echo $d['lama_pinjaman']; ?></td>
						<td><?php echo $d['aktual']; ?></td>
						<td><?php echo $d['prediksi']; ?></td>
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
		
		<div class="card mb-3">
		  <div class="card-header">
			<i class="fas fa-table"></i>
			Data Testing</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm display" id="" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th scope="col">No</th>
					<th scope="col">Pinjaman Ke-</th>
					<th scope="col">Usia</th>
					<th scope="col">Usaha</th>
					<th scope="col">Anggota Sejak</th>
					<th scope="col">Total Pinjaman Keseluruhan</th>
					<th scope="col">Besar Pinjaman</th>
					<th scope="col">Angsuran</th>
					<th scope="col">Lama Pinjaman</th>
					<th scope="col">Aktual</th>
					<th scope="col">Prediksi</th>
                  </tr>
                </thead>
                <tbody>
					<?php 
					$no = 1;
					$data = mysql_query("select * from data_testing");
					while($d = mysql_fetch_array($data)){
					?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $d['pinjaman_ke']; ?></td>
						<td><?php echo $d['usia']; ?></td>
						<td><?php echo $d['usaha']; ?></td>
						<td><?php echo $d['anggota_sejak']; ?></td>
						<td><?php echo $d['total_pinjaman']; ?></td>
						<td><?php echo $d['besar_pinjaman']; ?></td>
						<td><?php echo $d['angsuran']; ?></td>
						<td><?php echo $d['lama_pinjaman']; ?></td>
						<td><?php echo $d['aktual']; ?></td>
						<td><?php echo $d['prediksi']; ?></td>
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
	<script>		
		$('#customFile').on('change',function(){
			//get the file name
			var fileName = $(this).val().split('\\').pop();
			//replace the "Choose a file" label
			$(this).next('.custom-file-label').addClass("selected").html(fileName);
		})
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
