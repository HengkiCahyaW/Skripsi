<?php
	include 'koneksi.php';

	//Hapus Semua Data
	mysql_query("TRUNCATE data_verifikasi");
	mysql_query("TRUNCATE hasil_verifikasi");
	
	echo "<script>window.location='verifikasi.php'</script>";
?>