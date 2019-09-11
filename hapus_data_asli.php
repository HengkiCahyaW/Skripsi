<?php
	include 'koneksi.php';

	//Hapus Semua Data
	mysql_query("TRUNCATE data_asli");
	mysql_query("TRUNCATE dataset");
	mysql_query("TRUNCATE data_training");
	mysql_query("TRUNCATE data_testing");
	
	echo "<script>window.location='data_asli.php'</script>";
?>