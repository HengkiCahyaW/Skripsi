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

  <title>Dataset</title>

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
	  <li class="nav-item active">
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
            <h1 class="h3 mb-0 text-gray-800">Dataset</h1>
		</div>
		
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<button class="btn btn-secondary" data-toggle="modal" data-target="#myModal"><i class="fas fa-download fa-sm text-white-50"></i> Tambah Data</button>
			<button class="btn btn-secondary" onclick="window.location.href='proses_uji_dataset.php'"><i class="fas fa-adjust fa-sm text-white-50"></i> Uji Dataset</button>
			<button class="btn btn-secondary" data-toggle="modal" data-target="#myModal2"><i class="fas fa-trash fa-sm text-white-50"></i> Hapus Semua Data</button>
		</div>
		
		<!-- Modal Tambah Data -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Form Tambah Data</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form role="form" action="tambah_dataset.php" method="post">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="masukkanNama">Pinjaman Ke-</label>
										<select class="form-control" name="pinjaman">
											<option>- Pilih Pinjaman -</option>
											<?php
									$sql = mysql_query("SELECT * FROM atribut where atribut='pinjaman_ke'");
									if(mysql_num_rows($sql) != 0){
										while($row = mysql_fetch_assoc($sql)){
											echo '<option value="'.$row['nilai'].'">'.$row['nilai'].'</option>
											 '; } } ?>
										</select>
									</div>
									<div class="form-group">
										<label for="masukkanEmail">Usia</label>
										<select class="form-control" name="usia">
											<option>- Pilih Usia -</option>
											<?php
									$sql = mysql_query("SELECT * FROM atribut where atribut='usia'");
									if(mysql_num_rows($sql) != 0){
										while($row = mysql_fetch_assoc($sql)){
											echo '<option value="'.$row['nilai'].'">'.$row['nilai'].'</option>
											 '; } } ?>
										</select>
									</div>
									<div class="form-group">
										<label for="masukkanPesan">Usaha</label>
										<select class="form-control" name="usaha">
											<option>- Pilih Usaha -</option>
											<?php
									$sql = mysql_query("SELECT * FROM atribut where atribut='usaha'");
									if(mysql_num_rows($sql) != 0){
										while($row = mysql_fetch_assoc($sql)){
											echo '<option value="'.$row['nilai'].'">'.$row['nilai'].'</option>
											 '; } } ?>
										</select>
									</div>
									<div class="form-group">
										<label for="masukkanEmail">Anggota Sejak</label>
										<select class="form-control" name="anggota">
											<option>- Pilih Anggota -</option>
											<?php
									$sql = mysql_query("SELECT * FROM atribut where atribut='anggota_sejak'");
									if(mysql_num_rows($sql) != 0){
										while($row = mysql_fetch_assoc($sql)){
											echo '<option value="'.$row['nilai'].'">'.$row['nilai'].'</option>
											 '; } } ?>
										</select>
									</div>
									<div class="form-group">
										<label for="masukkanEmail">Total Pinjaman</label>
										<select class="form-control" name="total_pinjaman">
											<option>- Pilih Total Pinjaman -</option>
											<?php
									$sql = mysql_query("SELECT * FROM atribut where atribut='total_pinjaman'");
									if(mysql_num_rows($sql) != 0){
										while($row = mysql_fetch_assoc($sql)){
											echo '<option value="'.$row['nilai'].'">'.$row['nilai'].'</option>
											 '; } } ?>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="masukkanEmail">Besar Pinjaman</label>
										<select class="form-control" name="besar_pinjaman">
											<option>- Pilih Besar Pinjaman -</option>
											<?php
									$sql = mysql_query("SELECT * FROM atribut where atribut='besar_pinjaman'");
									if(mysql_num_rows($sql) != 0){
										while($row = mysql_fetch_assoc($sql)){
											echo '<option value="'.$row['nilai'].'">'.$row['nilai'].'</option>
											 '; } } ?>
										</select>
									</div>
									<div class="form-group">
										<label for="masukkanEmail">Angsuran</label>
										<select class="form-control" name="angsuran">
											<option>- Pilih Angsuran -</option>
											<?php
									$sql = mysql_query("SELECT * FROM atribut where atribut='angsuran'");
									if(mysql_num_rows($sql) != 0){
										while($row = mysql_fetch_assoc($sql)){
											echo '<option value="'.$row['nilai'].'">'.$row['nilai'].'</option>
											 '; } } ?>
										</select>
									</div>
									<div class="form-group">
										<label for="masukkanEmail">Lama Pinjaman</label>
										<select class="form-control" name="lama_pinjaman">
											<option>- Pilih Lama Pinjaman -</option>
											<?php
									$sql = mysql_query("SELECT * FROM atribut where atribut='lama_pinjaman'");
									if(mysql_num_rows($sql) != 0){
										while($row = mysql_fetch_assoc($sql)){
											echo '<option value="'.$row['nilai'].'">'.$row['nilai'].'</option>
											 '; } } ?>
										</select>
									</div>
									<div class="form-group">
										<label for="masukkanEmail">Aktual</label>
										<select class="form-control" name="aktual">
											<option>- Pilih Aktual -</option>
											<option>Macet</option>
											<option>Lancar</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Input Data</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<!-- Modal Hapus Data -->
		<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus Data</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form role="form" action="hapus_dataset.php" method="post">
							<div class="form-group">
								<label for="masukkanEmail">Apa anda yakin ingin hapus semua data?</label>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Delete Data</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="card mb-3">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
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
                  </tr>
                </thead>
                <tbody>
					<?php 
					$no = 1;
					$data = mysql_query("select * from dataset");
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
</body>

</html>
