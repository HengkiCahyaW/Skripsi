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

  <title>Verifikasi</title>

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
      <li class="nav-item">
        <a class="nav-link" href="pemodelan.php">
          <i class="fas fa-fw fa-cube"></i>
          <span>Pemodelan</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="verifikasi.php">
          <i class="fas fa-fw fa-check-circle"></i>
          <span>Verifikasi</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

		<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Verifikasi</h1>
		</div>
		
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<button class="btn btn-secondary" data-toggle="modal" data-target="#myModal"><i class="fas fa-download fa-sm text-white-50"></i> Tambah Data</button>
			<button class="btn btn-secondary" data-toggle="modal" data-target="#myModal1"><i class="fas fa-download fa-sm text-white-50"></i> Import Excel</button>
			<button class="btn btn-secondary" onclick="window.location.href='proses_verifikasi.php'"><i class="fas fa-adjust fa-sm text-white-50"></i> Verifikasi Data</button>
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
						<form role="form" action="tambah_verifikasi.php" method="post">
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
										<label for="masukkanEmail">lama_pinjaman</label>
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
								</div>
								<div class="col-md-6">
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
						<form role="form" action="hapus_data_verifikasi.php" method="post">
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
		
		<!-- Modal Import Excel -->
		<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form role="form" action="import_data_verifikasi.php" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="masukkanEmail">Pilih Data</label>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="customFile" name="file" accept=".xls">
									<label class="custom-file-label" for="customFile">Choose file (.xls)</label>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Import</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="card mb-3">
		  <div class="card-header">
			<i class="fas fa-table"></i>
			Data Verifikasi</div>
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
                  </tr>
                </thead>
                <tbody>
					<?php 
					$no = 1;
					$data = mysql_query("select * from data_verifikasi");
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
			Hasil Verifikasi</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm" id="" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th scope="col">No</th>
					<th scope="col">Atribut</th>
					<th scope="col">Nilai</th>
					<th scope="col">Probabilitas Macet</th>
					<th scope="col">Probabilitas Lancar</th>
                  </tr>
                </thead>
                <tbody>
					<?php 
					//Hitung Data
					$sql_total_data = mysql_query ("SELECT COUNT(*) as total FROM data_verifikasi");
					$row_total_data = mysql_fetch_array($sql_total_data);
					$get_total_data = $row_total_data['total'];
					
					//Hitung Hasil
					$sql_total_hasil = mysql_query ("SELECT COUNT(*) as total FROM hasil_verifikasi");
					$row_total_hasil = mysql_fetch_array($sql_total_hasil);
					$get_total_hasil = $row_total_hasil['total'];
					
					if ($get_total_data <= $get_total_hasil){
						$no1 = 1;
						$data = mysql_query("select * from data_verifikasi");
						while($d = mysql_fetch_array($data)){
							$id = $d['Id_data_verif'];
							$pinjaman = $d['pinjaman_ke'];
							$usia = $d['usia'];
							$usaha = $d['usaha'];
							$anggota = $d['anggota_sejak'];
							$total_pinjaman = $d['total_pinjaman'];
							$besar_pinjaman = $d['besar_pinjaman'];
							$angsuran = $d['angsuran'];
							$lama_pinjaman = $d['lama_pinjaman'];
							
							$data_verifikasi = mysql_query("SELECT * FROM hasil_verifikasi WHERE Id_hasil_verif='$id'");
							while ($hasil = mysql_fetch_array($data_verifikasi)){
								$hasil_pinjaman_ke = $hasil['pinjaman_ke'];
								$hasil_usia = $hasil['usia'];
								$hasil_usaha = $hasil['usaha'];
								$hasil_anggota = $hasil['anggota_sejak'];
								$hasil_total_pinjaman = $hasil['total_pinjaman'];
								$hasil_besar_pinjaman = $hasil['besar_pinjaman'];
								$hasil_angsuran = $hasil['angsuran'];
								$hasil_lama_pinjaman = $hasil['lama_pinjaman'];
								$hasil_verifikasi = $hasil['prediksi'];
								
								$data1 = explode("-", $hasil_pinjaman_ke);
								$hasil_pinjaman_ke_macet = $data1[0];
								$hasil_pinjaman_ke_lancar = $data1[1];
								
								$data2 = explode("-" , $hasil_usia);
								$hasil_usia_macet = $data2[0];
								$hasil_usia_lancar = $data2[1];
								
								$data3 = explode("-" , $hasil_usaha);
								$hasil_usaha_macet = $data3[0];
								$hasil_usaha_lancar = $data3[1];
								
								$data4 = explode("-" , $hasil_anggota);
								$hasil_anggota_macet = $data4[0];
								$hasil_anggota_lancar = $data4[1];
								
								$data5 = explode("-" , $hasil_total_pinjaman);
								$hasil_total_pinjaman_macet = $data5[0];
								$hasil_total_pinjaman_lancar = $data5[1];
								
								$data6 = explode("-" , $hasil_besar_pinjaman);
								$hasil_besar_pinjaman_macet = $data6[0];
								$hasil_besar_pinjaman_lancar = $data6[1];
								
								$data7 = explode("-" , $hasil_angsuran);
								$hasil_angsuran_macet = $data7[0];
								$hasil_angsuran_lancar = $data7[1];
								
								$data8 = explode("-" , $hasil_lama_pinjaman);
								$hasil_lama_pinjaman_macet = $data8[0];
								$hasil_lama_pinjaman_lancar = $data8[1];
								
								$sql_p_macet = mysql_query ("SELECT probabilitas_macet FROM perhitungan WHERE atribut='total'");
								$row_p_macet = mysql_fetch_array($sql_p_macet);
								$get_p_macet = $row_p_macet['probabilitas_macet'];
								
								$sql_p_lancar = mysql_query ("SELECT probabilitas_lancar FROM perhitungan WHERE atribut='total'");
								$row_p_lancar = mysql_fetch_array($sql_p_lancar);
								$get_p_lancar = $row_p_lancar['probabilitas_lancar'];
								
								$p_macet = (round($get_p_macet * $hasil_pinjaman_ke_macet * $hasil_usia_macet * $hasil_usaha_macet * $hasil_anggota_macet * $hasil_total_pinjaman_macet * $hasil_besar_pinjaman_macet * $hasil_angsuran_macet * $hasil_lama_pinjaman_macet,20));
								$p_lancar = (round($get_p_lancar * $hasil_pinjaman_ke_lancar * $hasil_usia_lancar * $hasil_usaha_lancar * $hasil_anggota_lancar * $hasil_total_pinjaman_lancar * $hasil_besar_pinjaman_lancar * $hasil_angsuran_lancar * $hasil_lama_pinjaman_lancar,20));
							
								if ($hasil_verifikasi == "Macet"){
									$kesimpulan = "Berdasarkan perhitungan di atas, dapat diprediksi bawa Pinjaman tersebut akan <b>Macet</b> <br> karena <b>Nilai Probabilitas Macet ($p_macet) > Nilai Probabilitas Lancar ($p_lancar)</b>";
								} else {
									$kesimpulan = "Berdasarkan perhitungan di atas, dapat diprediksi bawa Pinjaman tersebut <b>Lancar</b> <br> karena <b>Nilai Probabilitas Lancar ($p_lancar) > Nilai Probabilitas Macet ($p_macet)</b>";
								}
							}
						
					
					?>
					<tr>
						<td><?php echo $no1; ?></td>
						<td>Pinjaman Ke-</td>
						<td><?php echo $pinjaman; ?></td>
						<td><?php echo $hasil_pinjaman_ke_macet; ?></td>
						<td><?php echo $hasil_pinjaman_ke_lancar; ?></td>
					</tr>
					<tr>
						<td></td>
						<td>Usia</td>
						<td><?php echo $usia; ?></td>
						<td><?php echo $hasil_usia_macet; ?></td>
						<td><?php echo $hasil_usia_lancar; ?></td>
					</tr>
					<tr>
						<td></td>
						<td>Usaha</td>
						<td><?php echo $usaha; ?></td>
						<td><?php echo $hasil_usaha_macet; ?></td>
						<td><?php echo $hasil_usaha_lancar; ?></td>
					</tr>
					<tr>
						<td></td>
						<td>Anggota Sejak</td>
						<td><?php echo $anggota; ?></td>
						<td><?php echo $hasil_anggota_macet; ?></td>
						<td><?php echo $hasil_anggota_lancar; ?></td>
					</tr>
					<tr>
						<td></td>
						<td>Total Pinjaman Keseluruhan</td>
						<td><?php echo $total_pinjaman; ?></td>
						<td><?php echo $hasil_total_pinjaman_macet; ?></td>
						<td><?php echo $hasil_total_pinjaman_lancar; ?></td>
					</tr>
					<tr>
						<td></td>
						<td>Besar Pinjaman</td>
						<td><?php echo $besar_pinjaman; ?></td>
						<td><?php echo $hasil_besar_pinjaman_macet; ?></td>
						<td><?php echo $hasil_besar_pinjaman_lancar; ?></td>
					</tr>
					<tr>
						<td></td>
						<td>Angsuran</td>
						<td><?php echo $angsuran; ?></td>
						<td><?php echo $hasil_angsuran_macet; ?></td>
						<td><?php echo $hasil_angsuran_lancar; ?></td>
					</tr>
					<tr>
						<td></td>
						<td>Lama Pinjaman</td>
						<td><?php echo $lama_pinjaman; ?></td>
						<td><?php echo $hasil_lama_pinjaman_macet; ?></td>
						<td><?php echo $hasil_lama_pinjaman_lancar; ?></td>
					</tr>
					<tr>
						<td></td>
						<td colspan="8">
							<?php 
								echo "<b>Detil Perhitungan<br></b>";
								echo "P(X|H)*P(H) Macet : $get_p_macet x $hasil_pinjaman_ke_macet x $hasil_usia_macet x $hasil_usaha_macet x $hasil_anggota_macet x $hasil_total_pinjaman_macet x $hasil_besar_pinjaman_macet x $hasil_angsuran_macet x $hasil_lama_pinjaman_macet = $p_macet <br>";
								echo "P(X|H)*P(H) Lancar : $get_p_lancar x $hasil_pinjaman_ke_lancar x $hasil_usia_lancar x $hasil_usaha_lancar x $hasil_anggota_lancar x $hasil_total_pinjaman_lancar x $hasil_besar_pinjaman_lancar x $hasil_angsuran_lancar x $hasil_lama_pinjaman_lancar = $p_lancar <br><br>";
								echo "<b>Kesimpulan<br></b>";
								echo "$kesimpulan";
							?>
						</td>
					</tr>
					<tr class="table-light">
						<td></td>
					</tr>
					<tr class="table-light">
						<td></td>
					</tr>
					<tr class="table-light">
						<td></td>
					</tr>
					<?php 
					$no1++;
						}
					} else {
					?>
					<tr>
						<td colspan="9" class="text-center">LAKUKAN VERIFIKASI DATA TERLEBIH DAHULU</td>
					</tr>
					<?php
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
