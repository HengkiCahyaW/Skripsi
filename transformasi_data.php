<?php
	include 'koneksi.php';

	//Hapus Semua Data
	mysql_query("TRUNCATE dataset");
	mysql_query("TRUNCATE atribut");
	
	//Membuat Tabel Median & Nilai
	$tabel = mysql_query('CREATE TABLE median( '.
       'id INT NOT NULL AUTO_INCREMENT, '.
       'data_asli VARCHAR(20) NOT NULL, '.
       'primary key ( id ))');
	   
	$tabel = mysql_query('CREATE TABLE nilai( '.
       'id INT NOT NULL AUTO_INCREMENT, '.
       'atribut VARCHAR(20) NOT NULL, '.
       'nilai VARCHAR(20) NOT NULL, '.
       'primary key ( id ))');
	
	//Mencari Median
	$atribut = array("pinjaman_ke","usia","total_pinjaman","besar_pinjaman","angsuran","lama_pinjaman");
	
	for ($i=0; $i <= 5; $i++) { 
		//Masukan Data Ke Tabel Baru
		$sql = mysql_query("INSERT INTO median(data_asli) SELECT $atribut[$i] FROM data_asli order by $atribut[$i] ASC");
		
		//Hitung Jumlah Data
		$sql_total = mysql_query ("SELECT COUNT(*) as total FROM median");
		$row_total = mysql_fetch_array($sql_total);
		$get_total = $row_total['total'];
		
		//Hitung Median
		$median = round($get_total / 2);
		
		//Ambil Nilai Median Dari Tabel berdasarkan ID
		$sql_median = mysql_query ("SELECT * FROM median where id='$median'");
		$row_median = mysql_fetch_array($sql_median);
		$nilai_median = $row_median['data_asli'];
		
		//Insert Atribut Median Ke Tabel Nilai
		$sql = mysql_query("INSERT INTO nilai(atribut,nilai) VALUES ('$atribut[$i]','$nilai_median')");
		
		mysql_query("TRUNCATE median");
	}	
	
	//Pilih Semua Data Asli
	$data = mysql_query("SELECT * FROM data_asli");
	while ($result = mysql_fetch_array($data)){
		//Masukan Setiap Data kedalam Variabel
		$pinjaman = $result['pinjaman_ke'];
		$usia = $result['usia'];
		$usaha = $result['usaha'];
		$anggota = $result['anggota_sejak'];
		$total_pinjaman = $result['total_pinjaman'];
		$besar_pinjaman = $result['besar_pinjaman'];
		$angsuran = $result['angsuran'];
		$lama_pinjaman = $result['lama_pinjaman'];
		$aktual = $result['aktual'];
		
		//Ambil Nilai Median Dari Database
		$sql_median = mysql_query ("SELECT nilai FROM nilai where atribut='pinjaman_ke'");
		$row_median = mysql_fetch_array($sql_median);
		$nilai_median = $row_median['nilai'];
		
		//Ubah Data sesuai Media 
		if ($pinjaman >  $nilai_median){
			$pinjaman = ">".$nilai_median;
		} else {
			$pinjaman = "<=".$nilai_median;
		}
		
		//Ambil Nilai Median Dari Database
		$sql_median = mysql_query ("SELECT nilai FROM nilai where atribut='usia'");
		$row_median = mysql_fetch_array($sql_median);
		$nilai_median = $row_median['nilai'];
		
		//Ubah Data sesuai Media 
		if ($usia >  $nilai_median){
			$usia = ">".$nilai_median;
		} else {
			$usia = "<=".$nilai_median;
		}
		
		//Ambil Nilai Median Dari Database
		$sql_median = mysql_query ("SELECT nilai FROM nilai where atribut='total_pinjaman'");
		$row_median = mysql_fetch_array($sql_median);
		$nilai_median = $row_median['nilai'];
		
		//Ubah Data sesuai Media 
		if ($total_pinjaman >  $nilai_median){
			$total_pinjaman = ">".$nilai_median;
		} else {
			$total_pinjaman = "<=".$nilai_median;
		}
		
		//Ambil Nilai Median Dari Database
		$sql_median = mysql_query ("SELECT nilai FROM nilai where atribut='besar_pinjaman'");
		$row_median = mysql_fetch_array($sql_median);
		$nilai_median = $row_median['nilai'];
		
		//Ubah Data sesuai Media 
		if ($besar_pinjaman >  $nilai_median){
			$besar_pinjaman = ">".$nilai_median;
		} else {
			$besar_pinjaman = "<=".$nilai_median;
		}
		
		//Ambil Nilai Median Dari Database
		$sql_median = mysql_query ("SELECT nilai FROM nilai where atribut='angsuran'");
		$row_median = mysql_fetch_array($sql_median);
		$nilai_median = $row_median['nilai'];
		
		//Ubah Data sesuai Media 
		if ($angsuran >  $nilai_median){
			$angsuran = ">".$nilai_median;
		} else {
			$angsuran = "<=".$nilai_median;
		}
		
		//Ambil Nilai Median Dari Database
		$sql_median = mysql_query ("SELECT nilai FROM nilai where atribut='lama_pinjaman'");
		$row_median = mysql_fetch_array($sql_median);
		$nilai_median = $row_median['nilai'];
		
		//Ubah Data sesuai Media 
		if ($lama_pinjaman >  $nilai_median){
			$lama_pinjaman = ">".$nilai_median;
		} else {
			$lama_pinjaman = "<=".$nilai_median;
		}
		
		//Cari Duplikasi data di tabel Data Training
		
		$flag = mysql_num_rows(mysql_query("SELECT * FROM dataset WHERE pinjaman_ke='$pinjaman' and usia='$usia' and usaha='$usaha' and anggota_sejak='$anggota' and 
		total_pinjaman='$total_pinjaman' and besar_pinjaman='$besar_pinjaman' and angsuran='$angsuran' and lama_pinjaman='$lama_pinjaman' and aktual='$aktual'"));
		
		if($flag <= 0 ){
			//Insert Ke Tabel jika tidak ada yang duplikasi
			$insert = mysql_query("INSERT INTO dataset(pinjaman_ke, usia, usaha, anggota_sejak, total_pinjaman, besar_pinjaman, angsuran, lama_pinjaman, aktual) 
			VALUES('$pinjaman','$usia','$usaha','$anggota','$total_pinjaman','$besar_pinjaman','$angsuran','$lama_pinjaman','$aktual')");
		}
	}
	
	//Masukan Setiap Atribut ke Array
	$atribut = array("total","pinjaman_ke","usia","usaha","anggota_sejak","total_pinjaman","besar_pinjaman","angsuran","lama_pinjaman");
	
	for ($i=0; $i <= 8; $i++) { 
		$atribut_data = $atribut[$i];

		if($atribut_data == "total"){
			$insert = mysql_query("INSERT INTO atribut(atribut,nilai) VALUES ('total','total')");
		} else {
			$sql = mysql_query("SELECT $atribut_data as nilai FROM dataset group by $atribut_data");
			while ($result = mysql_fetch_array($sql)){
				
				$nilai = $result['nilai'];
				
				$insert = mysql_query("INSERT INTO atribut(atribut,nilai) VALUES ('$atribut_data','$nilai')");
			}
		}
	}
	
	mysql_query("drop table median");
	mysql_query("drop table nilai");
	
	echo "<script>window.alert('Proses Selesai');
	window.location='dataset.php'</script>";
?>