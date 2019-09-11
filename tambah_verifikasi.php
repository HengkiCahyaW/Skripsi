<?php
	//include koneksi
	include 'koneksi.php';
	
	$pinjaman = $_POST['pinjaman'];
	$usia = $_POST['usia'];
	$usaha = $_POST['usaha'];
	$anggota = $_POST['anggota'];
	$total_pinjaman = $_POST['total_pinjaman'];
	$besar_pinjaman = $_POST['besar_pinjaman'];
	$angsuran = $_POST['angsuran'];
	$lama_pinjaman = $_POST['lama_pinjaman'];

	//query insert
	$insert = "INSERT INTO data_verifikasi(pinjaman_ke, usia, usaha, anggota_sejak, total_pinjaman, besar_pinjaman, angsuran, lama_pinjaman) 
	VALUES('$pinjaman','$usia','$usaha','$anggota','$total_pinjaman','$besar_pinjaman','$angsuran','$lama_pinjaman')";
	
	if (mysql_query($insert)) {
		echo "<script>window.alert('Berhasil Input');
		window.location='verifikasi.php'</script>";
	}
	else{
		echo "ERROR, data gagal di input". mysql_error();
	}

?>