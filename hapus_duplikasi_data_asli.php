<?php
	include 'koneksi.php';

	//Pilih Semua Data Asli
	$jumlah_duplikasi = 0;
	$data = mysql_query("SELECT * FROM data_asli");
	while ($result = mysql_fetch_array($data)){
		//Masukan Setiap Data kedalam Variabel
		$id = $result['Id_data_asli'];
		$pinjaman = $result['pinjaman_ke'];
		$usia = $result['usia'];
		$usaha = $result['usaha'];
		$anggota = $result['anggota_sejak'];
		$total_pinjaman = $result['total_pinjaman'];
		$besar_pinjaman = $result['besar_pinjaman'];
		$angsuran = $result['angsuran'];
		$lama_pinjaman = $result['lama_pinjaman'];
		$aktual = $result['aktual'];

		//Cari Duplikasi data di tabel Data Asli
		
		$flag = mysql_num_rows(mysql_query("SELECT * FROM data_asli WHERE pinjaman_ke='$pinjaman' and usia='$usia' and usaha='$usaha' and anggota_sejak='$anggota' and 
		total_pinjaman='$total_pinjaman' and besar_pinjaman='$besar_pinjaman' and angsuran='$angsuran' and lama_pinjaman='$lama_pinjaman' and aktual='$aktual'"));
		
		if($flag > 1 ){
			//Hapus Data
			$delete = mysql_query("Delete from data_asli where Id_data_asli = $id");
			$jumlah_duplikasi++;
		} 
		
	}
	
	echo "<script>window.alert('Proses Selesai\\nJumlah Duplikasi Data = $jumlah_duplikasi');
	window.location='data_asli.php'</script>";
?>