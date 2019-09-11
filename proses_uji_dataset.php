<?php
	include 'koneksi.php';

	//Hapus Semua Data
	mysql_query("TRUNCATE perhitungan");
	mysql_query("TRUNCATE data_training");
	mysql_query("TRUNCATE data_testing");
	
	//---Proses Holdout---\\
	//Hitung Jumlah Data
	$sql_total = mysql_query ("SELECT COUNT(*) as total FROM dataset");
	$row_total = mysql_fetch_array($sql_total);
	$get_total_data = $row_total['total'];
	$jumlah_pindah = (round(($get_total_data/100) * 70));
	
	for ($i=1; $i <= $jumlah_pindah; $i++) { 
		$sql = mysql_query("INSERT INTO data_training(pinjaman_ke, usia, usaha, anggota_sejak, total_pinjaman, besar_pinjaman, angsuran, lama_pinjaman, aktual) 
			   SELECT pinjaman_ke, usia, usaha, anggota_sejak, total_pinjaman, besar_pinjaman, angsuran, lama_pinjaman, aktual FROM dataset where Id_dataset='$i'");	   
	}
	
	//---Proses Pemindahan 1/3 data dari dataset ke data testing---\\
	for ($i=$jumlah_pindah + 1; $i <= $get_total_data; $i++) { 
		$sql = mysql_query("INSERT INTO data_testing(pinjaman_ke, usia, usaha, anggota_sejak, total_pinjaman, besar_pinjaman, angsuran, lama_pinjaman, aktual) 
			   SELECT pinjaman_ke, usia, usaha, anggota_sejak, total_pinjaman, besar_pinjaman, angsuran, lama_pinjaman, aktual FROM dataset where Id_dataset='$i'");	   
	}
	
	$data = mysql_query("SELECT * FROM atribut");
	while ($result = mysql_fetch_array($data)){
		if($result['atribut']=="total"){
			//Hitung Macet
			$sql_total_macet = mysql_query ("SELECT COUNT(*) as aktual FROM data_training WHERE aktual='macet'");
			$row_total_macet = mysql_fetch_array($sql_total_macet);
			$get_total_macet = $row_total_macet['aktual'];
			
			//Hitung lancar Macet
			$sql_total_lancar = mysql_query ("SELECT COUNT(*) as aktual FROM data_training WHERE aktual='lancar'");
			$row_total_lancar = mysql_fetch_array($sql_total_lancar);
			$get_total_lancar = $row_total_lancar['aktual'];
			
			//Hitung probabilitas
			$jumlah_total = $get_total_macet + $get_total_lancar;
			$probabilitas_macet = (round($get_total_macet/$jumlah_total,5));
			$probabilitas_lancar = (round($get_total_lancar/$jumlah_total,5));			
			
			//Insert Database
			$insert = mysql_query("INSERT INTO perhitungan(atribut, nilai, total_macet, total_lancar, probabilitas_macet, probabilitas_lancar) 
			VALUES('$result[atribut]','$result[nilai]','$get_total_macet','$get_total_lancar','$probabilitas_macet','$probabilitas_lancar')");
		} else {
			//Inisialisasi
			$atribut = $result['atribut'];
			$nilai = $result['nilai'];
			
			//Hitung Macet
			$sql_jumlah_macet = mysql_query ("SELECT COUNT(*) as macet FROM data_training WHERE $atribut='$nilai' and aktual='macet'");
			$row_jumlah_macet = mysql_fetch_array($sql_jumlah_macet);
			$get_jumlah_macet = $row_jumlah_macet['macet'];
			
			//Hitung lancar Macet
			$sql_jumlah_lancar = mysql_query ("SELECT COUNT(*) as lancar_macet FROM data_training WHERE $atribut='$nilai' and aktual='lancar'");
			$row_jumlah_lancar = mysql_fetch_array($sql_jumlah_lancar);
			$get_jumlah_lancar = $row_jumlah_lancar['lancar_macet'];
			
			//Hitung probabilitas
			$probabilitas_macet = (round($get_jumlah_macet/$get_total_macet,5));
			$probabilitas_lancar = (round($get_jumlah_lancar/$get_total_lancar,5));			
			
			//Insert Database
			$insert = mysql_query("INSERT INTO perhitungan(atribut, nilai, total_macet, total_lancar, probabilitas_macet, probabilitas_lancar) 
			VALUES('$result[atribut]','$result[nilai]','$get_jumlah_macet','$get_jumlah_lancar','$probabilitas_macet','$probabilitas_lancar')");
		}
	}
	
	$data = mysql_query("SELECT * FROM data_training");
	while ($result = mysql_fetch_array($data)){
		
		//Nilai Atribut
		$id = $result['Id_training'];
		$pinjaman_ke = $result['pinjaman_ke'];
		$usia = $result['usia'];
		$usaha = $result['usaha'];
		$anggota = $result['anggota_sejak'];
		$total_pinjaman = $result['total_pinjaman'];
		$besar_pinjaman = $result['besar_pinjaman'];
		$angsuran = $result['angsuran'];
		$lama_pinjaman = $result['lama_pinjaman'];
		
		//Ambil Nilai macet Tiap Atribut
		$sql_nilai_macet = mysql_query ("SELECT probabilitas_macet FROM perhitungan where nilai='$pinjaman_ke'");
		$row_nilai_macet = mysql_fetch_array($sql_nilai_macet);
		$get_nilai_macet_pinjaman_ke = $row_nilai_macet['probabilitas_macet'];
		
		$sql_nilai_macet = mysql_query ("SELECT probabilitas_macet FROM perhitungan where nilai='$usia'");
		$row_nilai_macet = mysql_fetch_array($sql_nilai_macet);
		$get_nilai_macet_usia = $row_nilai_macet['probabilitas_macet'];
		
		$sql_nilai_macet = mysql_query ("SELECT probabilitas_macet FROM perhitungan where nilai='$usaha'");
		$row_nilai_macet = mysql_fetch_array($sql_nilai_macet);
		$get_nilai_macet_usaha = $row_nilai_macet['probabilitas_macet'];
		
		$sql_nilai_macet = mysql_query ("SELECT probabilitas_macet FROM perhitungan where nilai='$anggota'");
		$row_nilai_macet = mysql_fetch_array($sql_nilai_macet);
		$get_nilai_macet_anggota = $row_nilai_macet['probabilitas_macet'];
		
		$sql_nilai_macet = mysql_query ("SELECT probabilitas_macet FROM perhitungan where nilai='$total_pinjaman'");
		$row_nilai_macet = mysql_fetch_array($sql_nilai_macet);
		$get_nilai_macet_total_pinjaman = $row_nilai_macet['probabilitas_macet'];
		
		$sql_nilai_macet = mysql_query ("SELECT probabilitas_macet FROM perhitungan where nilai='$besar_pinjaman'");
		$row_nilai_macet = mysql_fetch_array($sql_nilai_macet);
		$get_nilai_macet_besar_pinjaman = $row_nilai_macet['probabilitas_macet'];
		
		$sql_nilai_macet = mysql_query ("SELECT probabilitas_macet FROM perhitungan where nilai='$angsuran'");
		$row_nilai_macet = mysql_fetch_array($sql_nilai_macet);
		$get_nilai_macet_angsuran = $row_nilai_macet['probabilitas_macet'];
		
		$sql_nilai_macet = mysql_query ("SELECT probabilitas_macet FROM perhitungan where nilai='$lama_pinjaman'");
		$row_nilai_macet = mysql_fetch_array($sql_nilai_macet);
		$get_nilai_macet_lama_pinjaman = $row_nilai_macet['probabilitas_macet'];
		
		$sql_nilai_macet = mysql_query ("SELECT probabilitas_macet FROM perhitungan where nilai='total'");
		$row_nilai_macet = mysql_fetch_array($sql_nilai_macet);
		$get_nilai_macet_total = $row_nilai_macet['probabilitas_macet'];
		
		$macet = $get_nilai_macet_total * $get_nilai_macet_pinjaman_ke * $get_nilai_macet_usia * $get_nilai_macet_usaha * $get_nilai_macet_anggota * $get_nilai_macet_total_pinjaman * $get_nilai_macet_besar_pinjaman * $get_nilai_macet_angsuran * $get_nilai_macet_lama_pinjaman;
		
		//Ambil Nilai Lancar macet Tiap Atribut
		$sql_nilai_lancar = mysql_query ("SELECT probabilitas_lancar FROM perhitungan where nilai='$pinjaman_ke'");
		$row_nilai_lancar = mysql_fetch_array($sql_nilai_lancar);
		$get_nilai_lancar_pinjaman_ke = $row_nilai_lancar['probabilitas_lancar'];
		
		$sql_nilai_lancar = mysql_query ("SELECT probabilitas_lancar FROM perhitungan where nilai='$usia'");
		$row_nilai_lancar = mysql_fetch_array($sql_nilai_lancar);
		$get_nilai_lancar_usia = $row_nilai_lancar['probabilitas_lancar'];
		
		$sql_nilai_lancar = mysql_query ("SELECT probabilitas_lancar FROM perhitungan where nilai='$usaha'");
		$row_nilai_lancar = mysql_fetch_array($sql_nilai_lancar);
		$get_nilai_lancar_usaha = $row_nilai_lancar['probabilitas_lancar'];
	
		$sql_nilai_lancar = mysql_query ("SELECT probabilitas_lancar FROM perhitungan where nilai='$anggota'");
		$row_nilai_lancar = mysql_fetch_array($sql_nilai_lancar);
		$get_nilai_lancar_anggota = $row_nilai_lancar['probabilitas_lancar'];
		
		$sql_nilai_lancar = mysql_query ("SELECT probabilitas_lancar FROM perhitungan where nilai='$total_pinjaman'");
		$row_nilai_lancar = mysql_fetch_array($sql_nilai_lancar);
		$get_nilai_lancar_total_pinjaman = $row_nilai_lancar['probabilitas_lancar'];
		
		$sql_nilai_lancar = mysql_query ("SELECT probabilitas_lancar FROM perhitungan where nilai='$besar_pinjaman'");
		$row_nilai_lancar = mysql_fetch_array($sql_nilai_lancar);
		$get_nilai_lancar_besar_pinjaman = $row_nilai_lancar['probabilitas_lancar'];
		
		$sql_nilai_lancar = mysql_query ("SELECT probabilitas_lancar FROM perhitungan where nilai='$angsuran'");
		$row_nilai_lancar = mysql_fetch_array($sql_nilai_lancar);
		$get_nilai_lancar_angsuran = $row_nilai_lancar['probabilitas_lancar'];
		
		$sql_nilai_lancar = mysql_query ("SELECT probabilitas_lancar FROM perhitungan where nilai='$lama_pinjaman'");
		$row_nilai_lancar = mysql_fetch_array($sql_nilai_lancar);
		$get_nilai_lancar_lama_pinjaman = $row_nilai_lancar['probabilitas_lancar'];
		
		$sql_nilai_lancar = mysql_query ("SELECT probabilitas_lancar FROM perhitungan where nilai='total'");
		$row_nilai_lancar = mysql_fetch_array($sql_nilai_lancar);
		$get_nilai_lancar_total = $row_nilai_lancar['probabilitas_lancar'];
		
		$lancar = $get_nilai_lancar_total * $get_nilai_lancar_pinjaman_ke * $get_nilai_lancar_usia * $get_nilai_lancar_usaha * $get_nilai_lancar_anggota * $get_nilai_lancar_total_pinjaman * $get_nilai_lancar_besar_pinjaman * $get_nilai_lancar_angsuran * $get_nilai_lancar_lama_pinjaman;
		
		if ($macet > $lancar){
			$prediksi = "Macet";
		} else {
			$prediksi = "Lancar";
		}
		
		mysql_query ("UPDATE data_training SET prediksi='$prediksi' WHERE Id_training='$id'");
	}
	
	$data = mysql_query("SELECT * FROM data_testing");
	while ($result = mysql_fetch_array($data)){
		
		//Nilai Atribut
		$id = $result['Id_testing'];
		$pinjaman_ke = $result['pinjaman_ke'];
		$usia = $result['usia'];
		$usaha = $result['usaha'];
		$anggota = $result['anggota_sejak'];
		$total_pinjaman = $result['total_pinjaman'];
		$besar_pinjaman = $result['besar_pinjaman'];
		$angsuran = $result['angsuran'];
		$lama_pinjaman = $result['lama_pinjaman'];
		
		//Ambil Nilai macet Tiap Atribut
		$sql_nilai_macet = mysql_query ("SELECT probabilitas_macet FROM perhitungan where nilai='$pinjaman_ke'");
		$row_nilai_macet = mysql_fetch_array($sql_nilai_macet);
		$get_nilai_macet_pinjaman_ke = $row_nilai_macet['probabilitas_macet'];
		
		$sql_nilai_macet = mysql_query ("SELECT probabilitas_macet FROM perhitungan where nilai='$usia'");
		$row_nilai_macet = mysql_fetch_array($sql_nilai_macet);
		$get_nilai_macet_usia = $row_nilai_macet['probabilitas_macet'];
		
		$sql_nilai_macet = mysql_query ("SELECT probabilitas_macet FROM perhitungan where nilai='$usaha'");
		$row_nilai_macet = mysql_fetch_array($sql_nilai_macet);
		$get_nilai_macet_usaha = $row_nilai_macet['probabilitas_macet'];
		
		$sql_nilai_macet = mysql_query ("SELECT probabilitas_macet FROM perhitungan where nilai='$anggota'");
		$row_nilai_macet = mysql_fetch_array($sql_nilai_macet);
		$get_nilai_macet_anggota = $row_nilai_macet['probabilitas_macet'];
		
		$sql_nilai_macet = mysql_query ("SELECT probabilitas_macet FROM perhitungan where nilai='$total_pinjaman'");
		$row_nilai_macet = mysql_fetch_array($sql_nilai_macet);
		$get_nilai_macet_total_pinjaman = $row_nilai_macet['probabilitas_macet'];
		
		$sql_nilai_macet = mysql_query ("SELECT probabilitas_macet FROM perhitungan where nilai='$besar_pinjaman'");
		$row_nilai_macet = mysql_fetch_array($sql_nilai_macet);
		$get_nilai_macet_besar_pinjaman = $row_nilai_macet['probabilitas_macet'];
		
		$sql_nilai_macet = mysql_query ("SELECT probabilitas_macet FROM perhitungan where nilai='$angsuran'");
		$row_nilai_macet = mysql_fetch_array($sql_nilai_macet);
		$get_nilai_macet_angsuran = $row_nilai_macet['probabilitas_macet'];
		
		$sql_nilai_macet = mysql_query ("SELECT probabilitas_macet FROM perhitungan where nilai='$lama_pinjaman'");
		$row_nilai_macet = mysql_fetch_array($sql_nilai_macet);
		$get_nilai_macet_lama_pinjaman = $row_nilai_macet['probabilitas_macet'];
		
		$sql_nilai_macet = mysql_query ("SELECT probabilitas_macet FROM perhitungan where nilai='total'");
		$row_nilai_macet = mysql_fetch_array($sql_nilai_macet);
		$get_nilai_macet_total = $row_nilai_macet['probabilitas_macet'];
		
		$macet = $get_nilai_macet_total * $get_nilai_macet_pinjaman_ke * $get_nilai_macet_usia * $get_nilai_macet_usaha * $get_nilai_macet_anggota * $get_nilai_macet_total_pinjaman * $get_nilai_macet_besar_pinjaman * $get_nilai_macet_angsuran * $get_nilai_macet_lama_pinjaman;
		
		//Ambil Nilai Lancar macet Tiap Atribut
		$sql_nilai_lancar = mysql_query ("SELECT probabilitas_lancar FROM perhitungan where nilai='$pinjaman_ke'");
		$row_nilai_lancar = mysql_fetch_array($sql_nilai_lancar);
		$get_nilai_lancar_pinjaman_ke = $row_nilai_lancar['probabilitas_lancar'];
		
		$sql_nilai_lancar = mysql_query ("SELECT probabilitas_lancar FROM perhitungan where nilai='$usia'");
		$row_nilai_lancar = mysql_fetch_array($sql_nilai_lancar);
		$get_nilai_lancar_usia = $row_nilai_lancar['probabilitas_lancar'];
		
		$sql_nilai_lancar = mysql_query ("SELECT probabilitas_lancar FROM perhitungan where nilai='$usaha'");
		$row_nilai_lancar = mysql_fetch_array($sql_nilai_lancar);
		$get_nilai_lancar_usaha = $row_nilai_lancar['probabilitas_lancar'];
	
		$sql_nilai_lancar = mysql_query ("SELECT probabilitas_lancar FROM perhitungan where nilai='$anggota'");
		$row_nilai_lancar = mysql_fetch_array($sql_nilai_lancar);
		$get_nilai_lancar_anggota = $row_nilai_lancar['probabilitas_lancar'];
		
		$sql_nilai_lancar = mysql_query ("SELECT probabilitas_lancar FROM perhitungan where nilai='$total_pinjaman'");
		$row_nilai_lancar = mysql_fetch_array($sql_nilai_lancar);
		$get_nilai_lancar_total_pinjaman = $row_nilai_lancar['probabilitas_lancar'];
		
		$sql_nilai_lancar = mysql_query ("SELECT probabilitas_lancar FROM perhitungan where nilai='$besar_pinjaman'");
		$row_nilai_lancar = mysql_fetch_array($sql_nilai_lancar);
		$get_nilai_lancar_besar_pinjaman = $row_nilai_lancar['probabilitas_lancar'];
		
		$sql_nilai_lancar = mysql_query ("SELECT probabilitas_lancar FROM perhitungan where nilai='$angsuran'");
		$row_nilai_lancar = mysql_fetch_array($sql_nilai_lancar);
		$get_nilai_lancar_angsuran = $row_nilai_lancar['probabilitas_lancar'];
		
		$sql_nilai_lancar = mysql_query ("SELECT probabilitas_lancar FROM perhitungan where nilai='$lama_pinjaman'");
		$row_nilai_lancar = mysql_fetch_array($sql_nilai_lancar);
		$get_nilai_lancar_lama_pinjaman = $row_nilai_lancar['probabilitas_lancar'];
		
		$sql_nilai_lancar = mysql_query ("SELECT probabilitas_lancar FROM perhitungan where nilai='total'");
		$row_nilai_lancar = mysql_fetch_array($sql_nilai_lancar);
		$get_nilai_lancar_total = $row_nilai_lancar['probabilitas_lancar'];
		
		$lancar = $get_nilai_lancar_total * $get_nilai_lancar_pinjaman_ke * $get_nilai_lancar_usia * $get_nilai_lancar_usaha * $get_nilai_lancar_anggota * $get_nilai_lancar_total_pinjaman * $get_nilai_lancar_besar_pinjaman * $get_nilai_lancar_angsuran * $get_nilai_lancar_lama_pinjaman;
		
		if ($macet > $lancar){
			$prediksi = "Macet";
		} else {
			$prediksi = "Lancar";
		}
		
		mysql_query ("UPDATE data_testing SET prediksi='$prediksi' WHERE Id_testing='$id'");
	}
	
	echo "<script>window.alert('Proses Selesai');
	window.location='data_uji_latih.php'</script>";
?>