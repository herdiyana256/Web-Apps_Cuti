<?php

if(isset($_GET['action'])=='submitfunct') {
	submitfunct();
}

function submitfunct() {
	/** Include path **/
	ini_set('include_path', 'Classes/');

	/** PHPExcel */
	include 'PHPExcel.php';

	/** PHPExcel_Writer_Excel2007 */
	include 'PHPExcel/Writer/Excel2007.php';

	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Set properties
	$objPHPExcel->getProperties()->setCreator("FTI Universitas YARSI");
	$objPHPExcel->getProperties()->setLastModifiedBy("FTI Universitas YARSI");
	$objPHPExcel->getProperties()->setTitle("Laporan Cuti FTI Universitas YARSI");
	$objPHPExcel->getProperties()->setSubject("Laporan Cuti FTI Universitas YARSI");
	$objPHPExcel->getProperties()->setDescription("Laporan Cuti FTI Universitas YARSI");

	// Add some data
	$objPHPExcel->setActiveSheetIndex(0);

	include('Config/config.php');
	
	$tahun = $_POST['tahun'];
	$bulan = $_POST['bulan'];
	
	$tbt = $tahun . $bulan;
	
	if ($bulan == "-01-21")
		$tbt2 = $tahun . "-02-20";
	elseif ($bulan == "-02-21")
		$tbt2 = $tahun . "-03-20";
	elseif ($bulan == "-03-21")
		$tbt2 = $tahun . "-04-20";
	elseif ($bulan == "-04-21")
		$tbt2 = $tahun . "-05-20";
	elseif ($bulan == "-05-21")
		$tbt2 = $tahun . "-06-20";
	elseif ($bulan == "-06-21")
		$tbt2 = $tahun . "-07-20";
	elseif ($bulan == "-07-21")
		$tbt2 = $tahun . "-08-20";
	elseif ($bulan == "-08-21")
		$tbt2 = $tahun . "-09-20";
	elseif ($bulan == "-09-21")
		$tbt2 = $tahun . "-10-20";
	elseif ($bulan == "-10-21")
		$tbt2 = $tahun . "-11-20";
	elseif ($bulan == "-11-21")
		$tbt2 = $tahun . "-12-20";
	elseif ($bulan == "-12-21")
		$tbt2 = $tahun+1 . "-01-20";
	
	//echo $tbt . "<br>";
	//echo $tbt2;
	
	$resultdb = mysql_query("SELECT * FROM form_cuti WHERE tanggal_awal >= '$tbt' && tanggal_awal <= '$tbt2' ORDER BY id_dosen_pegawai ASC");
	
	$cek = "";

	$inc = (int)2;

	$objPHPExcel->getActiveSheet()
			->getStyle('A1:N256')
			->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'UNIVERSITAS YARSI');
	$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'FAKULTAS TEKNOLOGI INFORMASI');
	$objPHPExcel->getActiveSheet()->SetCellValue('C4', 'REKAPITULASI KETIDAKHADIRAN BULANAN PEGAWAI TETAP');
	$objPHPExcel->getActiveSheet()->SetCellValue('A6', 'PERIODE : ');
	$objPHPExcel->getActiveSheet()->SetCellValue('A7', 'SIDJK (Surat Ijin Dalam Jam Kerja)');
		
	while ($row = mysql_fetch_array($resultdb)) {
		$a = $row['id_form_cuti'];
		   $a2 = $row['id_dosen_pegawai'];
		   
		   $e = $row['mengajukan'];
		   $f = $row['alasan_khusus_text'].$row['alasan_lain_text'].$row['alasan_penting_text'].$row['luar_tanggungan_text'];
		   $g = $row['jumlah_hari'];
		   $h = date('d-m-Y', strtotime($row['tanggal_awal']));
		   $i = date('d-m-Y', strtotime($row['tanggal_berakhir']));
		   $j = $row['keterangan'];
		   $k = $row['status_pengesahan'];
		   $l = date('d-m-Y', strtotime($row['tanggal']));
		   $m = $row['catatan'];
		   $n = $row['tanggal_pengesahan'];
	   $o = $row['laporan'];
	   
		$resultdb2 = mysql_query("SELECT * FROM dosen_pegawai WHERE id_dosen_pegawai = $a2");
		while ($row = mysql_fetch_array($resultdb2)) {
		   $b = $row['nama'];
		   $c = $row['NIK'];
		   $d = $row['status'];
		   
		   if ($d == "1")
				$d = "Dosen TI";
		   else if ($d == "2")
				$d = "Dosen IP";
		   else if ($d == "3")
				$d = "Karyawan";
		}
		
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
			$objPHPExcel->getActiveSheet()->SetCellValue('A9', 'No');
			$objPHPExcel->getActiveSheet()->SetCellValue('B9', 'Nama');
			$objPHPExcel->getActiveSheet()->SetCellValue('C9', 'NIK');
			$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Jumlah Hari');
			$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Waktu Ketidakhadiran / (Tgl SIDJK)');
			$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Tanggal Pengajuan Surat Tidak Masuk / (Jam SIDJK)');
			$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Keterangan');
			$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Sertifikat / Laporan');
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$inc, $a2);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$inc, $b);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$inc, $c);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$inc, $g." ");
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$inc, $h);
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$inc, $l);
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$inc, $f);
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$inc, $o);

			$inc = $inc + 1;
	}

	// Rename sheet
	$objPHPExcel->getActiveSheet()->setTitle('Laporan');

			
	// Save Excel 2007 file
	/*
	 * These lines are commented just for this demo purposes
	 * This is how the excel file is written to the disk, 
	 * but in this case we don't need them since the file was written at the first run
	 */
	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	$objWriter->save(str_replace('.php', '.xlsx', "arsip_cuti.xlsx"));
?>