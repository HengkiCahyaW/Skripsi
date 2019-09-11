<?php
	include 'koneksi.php';

	//Hapus Semua Data
	mysql_query("TRUNCATE dataset");
	
	echo "<script>window.location='dataset.php'</script>";
?>