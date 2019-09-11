<?php
	include 'koneksi.php';

	//Hapus Semua Data
	mysql_query("TRUNCATE hasil_verifikasi");
	mysql_query("TRUNCATE detil_hasil_verifikasi");
	
	$data = mysql_query("SELECT * FROM data_verifikasi");
	while ($result = mysql_fetch_array($data)){
		
		//Nilai Atribut
		$id = $result['Id_data_verif'];
		$pinjaman_ke = $result['pinjaman_ke'];
		$usia = $result['usia'];
		$usaha = $result['usaha'];
		$anggota = $result['anggota_sejak'];
		$total_pinjaman = $result['total_pinjaman'];
		$besar_pinjaman = $result['besar_pinjaman'];
		$angsuran = $result['angsuran'];
		$lama_pinjaman = $result['lama_pinjaman'];
		
		//Insert ID Terlebih Dahulu
		mysql_query ("INSERT INTO hasil_verifikasi(Id_hasil_verif) VALUES('$id')");
		
		//Masukkan Nilai Ke Array
		$data_traning = array("$pinjaman_ke","$usia","$usaha","$anggota","$total_pinjaman","$besar_pinjaman","$angsuran","$lama_pinjaman");
		
		for ($i=0; $i <= 7; $i++) { 
			//Ambil Nilai Macet Tiap Atribut
			$sql_nilai_macet = mysql_query ("SELECT probabilitas_macet FROM perhitungan where nilai='$data_traning[$i]'");
			$row_nilai_macet = mysql_fetch_array($sql_nilai_macet);
			$get_nilai_macet = $row_nilai_macet['probabilitas_macet'];
			
			//Ambil Nilai Lancar Tiap Atribut
			$sql_nilai_lancar = mysql_query ("SELECT probabilitas_lancar FROM perhitungan where nilai='$data_traning[$i]'");
			$row_nilai_lancar = mysql_fetch_array($sql_nilai_lancar);
			$get_nilai_lancar = $row_nilai_lancar['probabilitas_lancar'];
			
			//Ambil Atribut
			$sql_atribut = mysql_query ("SELECT atribut FROM atribut where nilai='$data_traning[$i]'");
			$row_atribut = mysql_fetch_array($sql_atribut);
			$get_atribut = $row_atribut['atribut'];
			
			//Insert Ke Database
			mysql_query ("UPDATE hasil_verifikasi SET $get_atribut='$get_nilai_macet-$get_nilai_lancar' WHERE Id_hasil_verif='$id'");
		}	
	}
	
	$data_verifikasi = mysql_query("SELECT * FROM hasil_verifikasi");
	while ($hasil = mysql_fetch_array($data_verifikasi)){
		$id = $hasil['Id_hasil_verif'];
		$hasil_pinjaman_ke = $hasil['pinjaman_ke'];
		$hasil_usia = $hasil['usia'];
		$hasil_usaha = $hasil['usaha'];
		$hasil_anggota = $hasil['anggota_sejak'];
		$hasil_total_pinjaman = $hasil['total_pinjaman'];
		$hasil_besar_pinjaman = $hasil['besar_pinjaman'];
		$hasil_angsuran = $hasil['angsuran'];
		$hasil_lama_pinjaman = $hasil['lama_pinjaman'];
		
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
		
		
		if ($p_macet > $p_lancar){
			mysql_query ("UPDATE hasil_verifikasi SET prediksi='Macet', total_nilai_macet='$p_macet', total_nilai_lancar='$p_lancar' WHERE Id_hasil_verif='$id'");
		} else {
			mysql_query ("UPDATE hasil_verifikasi SET prediksi='Lancar', total_nilai_macet='$p_macet', total_nilai_lancar='$p_lancar' WHERE Id_hasil_verif='$id'");
		}
	}
	
	echo "<script>window.alert('Proses Selesai');
	window.location='verifikasi.php'</script>";
?>