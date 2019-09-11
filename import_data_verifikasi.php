<?php
	// menghubungkan dengan koneksi
	include 'koneksi.php';
	// menghubungkan dengan library excel reader
	include 'excel_reader2.php';

	//Hapus Semua Data
	mysql_query("TRUNCATE data_verifikasi");
	
	// upload file xls
	$target = basename($_FILES['file']['name']) ;
	move_uploaded_file($_FILES['file']['tmp_name'], $target);

	// beri permisi agar file xls dapat di baca
	chmod($_FILES['file']['name'],0777);

	// mengambil isi file xls
	$data = new Spreadsheet_Excel_Reader($_FILES['file']['name'],false);
	// menghitung jumlah baris data yang ada
	$jumlah_baris = $data->rowcount($sheet_index=0);

	// jumlah default data yang berhasil di import
	$berhasil = 0;

	for ($i=2; $i<=$jumlah_baris; $i++)
	{
	  // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
		$pinjaman = $data->val($i,1);
		$usia = $data->val($i, 2);
		$usaha = $data->val($i, 3);
		$anggota = $data->val($i,4);
		$total_pinjaman = $data->val($i,5);
		$besar_pinjaman = $data->val($i,6);
		$angsuran = $data->val($i,7);
		$lama_pinjaman = $data->val($i,8);
		
		
		$insert = mysql_query("INSERT INTO data_verifikasi(pinjaman_ke, usia, usaha, anggota_sejak, total_pinjaman, besar_pinjaman, angsuran, lama_pinjaman) 
			VALUES('$pinjaman','$usia','$usaha','$anggota','$total_pinjaman','$besar_pinjaman','$angsuran','$lama_pinjaman')");
	}
	
	echo "<script>window.alert('Import Selesai');
	window.location='verifikasi.php'</script>";
?>
