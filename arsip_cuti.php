<?php 
	include('Config/cek_login_admin.php');
?>
<body>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistem Informasi Cuti</title>
<link rel="stylesheet" href="CSS/layout.css" type="text/css" media="screen" />
</head>
<div id="container"> <br>
<div id="header">&nbsp;&nbsp;<img src="Gambar/banner.jpg" width="877" height="120"/>
	<div id="border">
    	<div id="menu">
        	<ul class="float">
    		<li><strong><a id = "padding" href="index.php">Home</a></strong></li>
            
			<?php
				include("menu.php");
			?>
            
            </ul>
    	</div>
        <footer class = "footer2">
			<hr />
			<div id="paddingcopyright">
				<h6 align="right">Copyright &copy; 2015. Fakultas Teknologi Informasi Universitas YARSI. All Right Reserved</h6>
			</div>
		</footer>
		
		<?php
			//include("report_xls.php");
		?>
		
        <div id="login2" style="width:830px;overflow:auto;height:322px;solid grey;">
    		<div style =" margin-top:2px;">
				<div style = "position:absolute; font-size:11pt; margin-top:-55px; margin-left:20px;">
					<p>Download :</p>
				</div>
				<div style = "position:absolute; font-size:11pt; margin-top:-50px; margin-left:110px;">
					<a href = "arsip_cuti.xlsx"><img src = "images/xlsx.png" width="40"></a>&nbsp;
					<!--<button>docx</button>&nbsp;
					<button>pdf</button>-->
				</div>
				<div style = "position:absolute; font-size:11pt; margin-top:-55px; margin-left:400px;">
					<p>Periode :</p>
				</div>
				<div style = "position:absolute; font-size:11pt; margin-top:-55px; margin-left:470px;">
					<p>
					<form action="?action=submitfunct" method="post">
						<select name="tahun">
							<option value="2015">2015</option>
							<option value="2016">2016</option>
							<option value="2017">2017</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							<option value="2020">2020</option>
							<option value="2021">2021</option>
							<option value="2022">2022</option>
							<option value="2023">2023</option>
							<option value="2024">2024</option>
							<option value="2025">2025</option>
							<option value="2026">2026</option>
						</select>
						<select name="bulan">
							<option value="-01-21">21 Januari - 20 Februari</option>
							<option value="-02-21">21 Februari - 20 Maret</option>
							<option value="-03-21">21 Maret - 20 April</option>
							<option value="-04-21">21 April - 20 Mei</option>
							<option value="-05-21">21 Mei - 20 Juni</option>
							<option value="-06-21">21 Juni - 20 Juli</option>
							<option value="-07-21">21 Juli - 20 Agustus</option>
							<option value="-08-21">21 Agustus - 20 September</option>
							<option value="-09-21">21 September - 20 Oktober</option>
							<option value="-10-21">21 Oktober - 20 November</option>
							<option value="-11-21">21 November - 20 Desember</option>
							<option value="-12-21">21 Desember - 20 Januari</option>
						</select>
						<input type = "submit" value = "Lihat" style = "width:70px;">
					</form>
					</p>
				</div>
				<table border = "2px" align="center" style = "background:#fff; width:1000px; border:none; margin-top:70px;">
					<tr>
						<th class="style8" style = "background:#2ecc71; border:none; text-align:center;">No</th>
						<th class="style8" style = "background:#2ecc71; border:none; text-align:center;">Nama</th>
						<th class="style8" style = "background:#2ecc71; width:100px; border:none; text-align:center;">NIK</th>
						<th class="style8" style = "background:#2ecc71; width:50px; border:none; text-align:center;">Jumlah Hari</th>
						<th class="style8" style = "background:#2ecc71; width:150px; border:none; text-align:center;">Waktu Ketidakhadiran / (Tgl SIDJK)</th>
						<th class="style8" style = "background:#2ecc71; width:150px; border:none; text-align:center;">Tanggal Pengajuan Surat Tidak Masuk / (Jam SIDJK)</th>
						<th class="style8" style = "background:#2ecc71; border:none; text-align:center;">Keterangan</th>
						<th class="style8" style = "background:#2ecc71; border:none; text-align:center;">Sertifikat / Laporan</th>
					</tr>
					<?php
					
					if(isset($_GET['action'])=='submitfunct') {
						submitfunct();
					}

					function submitfunct() {
						
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
						$cek2 = "";
						$loncat = (int)0;
						$inccc = (int)0;
						
						$inc = (int)12;
						
						$dateee = date('d/m/Y', strtotime($tbt));
						$dateee2 = date('d/m/Y', strtotime($tbt2));
						
						$objRichText = new PHPExcel_RichText();
						$objRichText->createText('');

						$objBold = $objRichText->createTextRun('REKAPITULASI KETIDAKHADIRAN BULANAN PEGAWAI TETAP');
						$objBold->getFont()->setBold(true);

						$objPHPExcel->getActiveSheet()
								->getStyle('A9:H256')
								->getAlignment()
								->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
								->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
							
						$objPHPExcel->getActiveSheet()
							->getStyle('B12:B256')
							->getAlignment()
							->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)
							->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
						
						$objPHPExcel->getActiveSheet()
							->getStyle('G12:G256')
							->getAlignment()
							->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)
							->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
						
						$objPHPExcel->getActiveSheet()
							->getStyle('C12:C256')
							->getAlignment()
							->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)
							->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
						
						$objPHPExcel->getActiveSheet()
							->getStyle('E12:E256')
							->getAlignment()
							->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)
							->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
						
						$objPHPExcel->getActiveSheet()
							->getStyle('F12:F256')
							->getAlignment()
							->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)
							->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
						
						$objPHPExcel->getActiveSheet()
							->getStyle('A4')
							->getAlignment()
							->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
							->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
							
						$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'UNIVERSITAS YARSI');
						$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'FAKULTAS TEKNOLOGI INFORMASI');
						$objPHPExcel->getActiveSheet()->getCell('A4')->setValue($objRichText);
						$objPHPExcel->getActiveSheet()->SetCellValue('A6', 'PERIODE : '.$dateee .' - '. $dateee2);
						$objPHPExcel->getActiveSheet()->SetCellValue('A7', 'SIDJK (Surat Ijin Dalam Jam Kerja)');
							
						while ($row = mysql_fetch_array($resultdb)) {
						   $a = $row['id_form_cuti'];
						   $a2 = $row['id_dosen_pegawai'];
						   
						   $e = $row['mengajukan'];
						   $f = $row['alasan_khusus_text'].$row['alasan_lain_text'].$row['alasan_penting_text'].$row['luar_tanggungan_text'];
						   $g = $row['jumlah_hari'];
						   $h = date('d/m/Y', strtotime($row['tanggal_awal']));
						   $i = date('d/m/Y', strtotime($row['tanggal_berakhir']));
						   $j = $row['keterangan'];
						   $k = $row['status_pengesahan'];
						   $l = date('d/m/Y', strtotime($row['tanggal']));
						   $m = $row['catatan'];
						   $n = $row['tanggal_pengesahan'];
						   $o = $row['laporan'];
							
						   $resultdb2 = mysql_query("SELECT * FROM dosen_pegawai WHERE id_dosen_pegawai = $a2");
						   while ($row = mysql_fetch_array($resultdb2)) {
							   
							   $z1 = $f;
							   $z2 = $e;
							   
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
									print("<tr>");
									if ($cek == "" || $cek != $a2) {
										print("<td style = 'font-size:8pt; text-align:center; border:none; background:#C8F7C5;'>$a2</td>");
										print("<td style = 'font-size:8pt; width:200px; border:none; background:#C8F7C5;'>$b</td>");
										print("<td style = 'font-size:8pt; text-align:center; border:none; background:#C8F7C5;'>$c</td>");
										$cek = $a2;
									}
									else {
										print("<td style = 'font-size:8pt; text-align:center; border:none'> </td>");
										print("<td style = 'font-size:8pt; width:200px; border:none'> </td>");
										print("<td style = 'font-size:8pt; text-align:center; border:none'> </td>");
									}
									print("<td style = 'font-size:8pt; text-align:center; border:none; background:#C8F7C5;'>$g</td>");
									
									if ($g == "1")
										print("<td style = 'font-size:8pt; text-align:center; border:none; background:#C8F7C5;'>$h</td>");
									else
										print("<td style = 'font-size:8pt; text-align:center; border:none; background:#C8F7C5;'>$h - $i</td>");
									
									print("<td style = 'font-size:8pt; text-align:center; border:none; background:#C8F7C5;'>$l</td>");
									
									if ($e == "Alasan Lain" || $e == "Alasan Penting" || $e == "Di Luar Tanggungan" || $e == "Alasan Khusus")
										print("<td style = 'font-size:8pt; width:200px; text-align:left; border:none; background:#C8F7C5;'>$f</td>");
									else
										print("<td style = 'font-size:8pt; width:200px; text-align:left; border:none; background:#C8F7C5;'>$e</td>");
									
									if ($o != "Tidak ada")
										print("<td style = 'font-size:8pt; width:140px; text-align:center; border:none; background:#C8F7C5;'>$o
										<form method = 'post' action = 'edit_laporan.php'>
											<input type = 'hidden' name = 'id_cuti' value = '$a'/>
											<input type = 'text' name = 'update' placeholder = 'Laporan 01, Laporan 02, dst' style = 'width:180px;'/>
											<input type = 'submit' value = 'edit' style = 'font-size:8pt; height:25px;'/>
										</form>
									
									</td>");
									else
										print("<td style = 'font-size:8pt; width:140px; text-align:center; border:none; background:#C8F7C5;'>$o</td>");
										
									print("</tr>");
									
									$q = $h . ' - ' . $i;
									
									$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
									$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(17);
									$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
									$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(6);
									$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
									$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
									$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(19);
									$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
									$objPHPExcel->getActiveSheet()->SetCellValue('A9', 'No');
									$objPHPExcel->getActiveSheet()->SetCellValue('B9', 'Nama');
									$objPHPExcel->getActiveSheet()->SetCellValue('C9', 'NIK');
									$objPHPExcel->getActiveSheet()->SetCellValue('D9', 'Jumlah Hari');
									$objPHPExcel->getActiveSheet()->SetCellValue('E9', 'Waktu Ketidakhadiran / (Tgl SIDJK)');
									$objPHPExcel->getActiveSheet()->SetCellValue('F9', 'Tanggal Pengajuan Surat Tidak Masuk / (Jam SIDJK)');
									$objPHPExcel->getActiveSheet()->SetCellValue('G9', 'Keterangan');
									$objPHPExcel->getActiveSheet()->SetCellValue('H9', 'Sertifikat/Laporan');
									
									$styleArray4 = array(
										  'borders' => array(
											  'allborders' => array(
												  'style' => PHPExcel_Style_Border::BORDER_THIN
											  )
										  )
									  );
									
									if ($cek2 == "" || $cek2 != $a2) {
										$objPHPExcel->getActiveSheet()->SetCellValue('A'.$inc, $a2);
										$objPHPExcel->getActiveSheet()->SetCellValue('B'.$inc, $b);
										$objPHPExcel->getActiveSheet()->SetCellValue('C'.$inc, $c." ");
										$cek2 = $a2;
										
										if ($inccc != 0) {
											$objPHPExcel->getActiveSheet()->getStyle('A'.$inccc.':C'.($inc-1))->applyFromArray($styleArray4);
											$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$inccc.':A'.($inc-1));
											$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.$inccc.':B'.($inc-1));
											$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$inccc.':C'.($inc-1));
										}
										
										$inccc = $inc;
									}
										
									$objPHPExcel->getActiveSheet()->SetCellValue('D'.$inc, $g);
									
									if ($g == "1")
										$objPHPExcel->getActiveSheet()->SetCellValue('E'.$inc, $h);
									else
										$objPHPExcel->getActiveSheet()->SetCellValue('E'.$inc, $q);
									
									$objPHPExcel->getActiveSheet()->SetCellValue('F'.$inc, $l);
									
									if ($e == "Alasan Lain" || $e == "Alasan Penting" || $e == "Di Luar Tanggungan" || $e == "Alasan Khusus") {
										$objPHPExcel->getActiveSheet()->SetCellValue('G'.$inc, $z1);
									}
									else {
										$objPHPExcel->getActiveSheet()->SetCellValue('G'.$inc, $z2);
									}
						
									$objPHPExcel->getActiveSheet()->SetCellValue('H'.$inc, $o);

									$inc = $inc + 1;
						}
						
						$mydate = getdate(date("U"));
						$datess = "Jakarta, $mydate[mday] $mydate[month] $mydate[year] ";
						
						$objPHPExcel->getActiveSheet()->SetCellValue('B'.($inc+1), $datess);
						$objPHPExcel->getActiveSheet()->SetCellValue('C'.($inc+1), 'Diterima oleh:');
						$objPHPExcel->getActiveSheet()->SetCellValue('E'.($inc+1), 'Diterima oleh:');
						$objPHPExcel->getActiveSheet()->SetCellValue('G'.($inc+1), 'Diterima kembali:');
						
						$objPHPExcel->getActiveSheet()->SetCellValue('B'.($inc+2), 'Dibuat oleh:');
						$objPHPExcel->getActiveSheet()->SetCellValue('C'.($inc+2), 'Tgl.');
						$objPHPExcel->getActiveSheet()->SetCellValue('E'.($inc+2), 'Tgl.');
						$objPHPExcel->getActiveSheet()->SetCellValue('G'.($inc+2), 'Tgl.');
						
						$objPHPExcel->getActiveSheet()->SetCellValue('B'.($inc+6), 'Sri Wuryanti');
						$objPHPExcel->getActiveSheet()->SetCellValue('C'.($inc+6), '(.......................)');
						$objPHPExcel->getActiveSheet()->SetCellValue('E'.($inc+6), '(.......................)');
						$objPHPExcel->getActiveSheet()->SetCellValue('G'.($inc+6), '(.................................)');
						
						$objPHPExcel->getActiveSheet()->SetCellValue('B'.($inc+7), 'FTI');
						$objPHPExcel->getActiveSheet()->SetCellValue('C'.($inc+7), 'Registrar');
						$objPHPExcel->getActiveSheet()->SetCellValue('E'.($inc+7), 'Yayasan');
						$objPHPExcel->getActiveSheet()->SetCellValue('G'.($inc+7), 'FTI');
						
						$objPHPExcel->getActiveSheet()->SetCellValue('B'.($inc+9), 'Mengetahui:');
						
						$objPHPExcel->getActiveSheet()->SetCellValue('B'.($inc+13), 'DR. Vitri Tundjungsari, S.T., M.Sc.');
						
						$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A9:A11');
						$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E9:E11');
						$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B9:B11');
						$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C9:C11');
						$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D9:D11');
						$objPHPExcel->setActiveSheetIndex(0)->mergeCells('F9:F11');
						$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G9:G11');
						$objPHPExcel->setActiveSheetIndex(0)->mergeCells('H9:H11');
						$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A4:H4');
						
						$objPHPExcel->getActiveSheet()->getStyle('A9:H256')->getAlignment()->setWrapText(true);
						
						$styleArray = array(
							'font'  => array(
								'size'  => 9
							));
						
						$styleArray2 = array(
							'font'  => array(
								'size'  => 9,
								'bold'  => true
							));
						
						$styleArray3 = array(
							'font'  => array(
								'size'  => 14,
								'bold'  => true
							));
						
						$objPHPExcel->getActiveSheet()->getStyle('A1:H256')->applyFromArray($styleArray);
						$objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($styleArray2);
						$objPHPExcel->getActiveSheet()->getStyle('A4')->applyFromArray($styleArray3);
						$objPHPExcel->getActiveSheet()->getStyle('A9:H9')->applyFromArray($styleArray2);
					  
						$num = (int)$inc - 1;
					  
						$styleArray4 = array(
							  'borders' => array(
								  'allborders' => array(
									  'style' => PHPExcel_Style_Border::BORDER_THIN
								  )
							  )
						  );
						
						if ($inc != 12) {
							$objPHPExcel->getActiveSheet()->getStyle('A9:H11')->applyFromArray($styleArray4);
							$objPHPExcel->getActiveSheet()->getStyle('D12:H'.$num)->applyFromArray($styleArray4);
						
						
							$objPHPExcel->getActiveSheet()->getStyle('A'.$inccc.':C'.($inc-1))->applyFromArray($styleArray4);
							$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$inccc.':A'.($inc-1));
							$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.$inccc.':B'.($inc-1));
							$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$inccc.':C'.($inc-1));
						}
						
						// Rename sheet
						//$objPHPExcel->getActiveSheet()->setTitle('Laporan');

								
						// Save Excel 2007 file
						/*
						 * These lines are commented just for this demo purposes
						 * This is how the excel file is written to the disk, 
						 * but in this case we don't need them since the file was written at the first run
						 */
						$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
						$objWriter->save(str_replace('.php', '.xlsx', "arsip_cuti.xlsx"));
					}
				?>
				</table>
		    </div>
   	    </div>
    </div>
</div>	
</body>
        
</html>