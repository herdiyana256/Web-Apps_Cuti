<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
	include('Config/cek_login_dosen.php');
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
					<h3>Silahkan cetak form cuti yang telah diajukan (<span style = 'color:red;'>Di urutkan yang paling terbaru</span>)</h3>
				</div>
			<table border = "2px" align="center" style = "background:#fff; width:830px; border:none; margin-top:70px;">
				<tr>
					<th class="style8" style = "background:#2ecc71; width:50px; border:none; text-align:center;">Jumlah Hari</th>
					<th class="style8" style = "background:#2ecc71; width:150px; border:none; text-align:center;">Waktu Ketidakhadiran / (Tgl SIDJK)</th>
					<th class="style8" style = "background:#2ecc71; width:150px; border:none; text-align:center;">Tanggal Pengajuan Surat Tidak Masuk / (Jam SIDJK)</th>
					<th class="style8" style = "background:#2ecc71; border:none; text-align:center;">Keterangan</th>
					<th class="style8" style = "background:#2ecc71; border:none; text-align:center;">Sertifikat / Laporan</th>
					<th class="style8" style = "background:#2ecc71; border:none; text-align:center;">Cetak</th>
				</tr>
				<?php
					
					include('Config/config.php');
					$session = $_SESSION['username'];
					
					$resultdb2 = mysql_query("SELECT id_dosen_pegawai FROM dosen_pegawai WHERE username = '$session'");
					while ($row2 = mysql_fetch_array($resultdb2)) {
						$un = $row2['id_dosen_pegawai'];
					}
					
					$resultdb = mysql_query("SELECT * FROM form_cuti WHERE id_dosen_pegawai = '$un' ORDER BY id_form_cuti DESC");
					
					$cek = "";
					$cek2 = "";
					$loncat = (int)0;
					$inccc = (int)0;
					
					$inc = (int)12;
						
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
									//print("<td style = 'font-size:8pt; text-align:center; border:none; background:#C8F7C5;'>$a2</td>");
									//print("<td style = 'font-size:8pt; width:200px; border:none; background:#C8F7C5;'>$b</td>");
									//print("<td style = 'font-size:8pt; text-align:center; border:none; background:#C8F7C5;'>$c</td>");
									$cek = $a2;
								}
								else {
									//print("<td style = 'font-size:8pt; text-align:center; border:none'> </td>");
									//print("<td style = 'font-size:8pt; width:200px; border:none'> </td>");
									//print("<td style = 'font-size:8pt; text-align:center; border:none'> </td>");
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
								
								print("<td style = 'font-size:8pt; width:140px; text-align:center; border:none; background:#C8F7C5;'>$o</td>");
								print("<td style = 'font-size:8pt; text-align:center; border:none; border:none; background:#C8F7C5;'>
										<form method = 'post' action = 'report_doc.php' form target='_blank'>
											<input type = 'hidden' name = 'id_cetak' value = $a>
											<input type = 'hidden' name = 'id_dosen_pegawai' value = $a2>
											<input type = 'submit' value = 'Cetak'>
										</form></td>");
								print("</tr>");
								
								$q = $h . ' - ' . $i;
					}
				?>
			</table>
			</div>
   	    </div>
    </div>
</div>	
</body>
        
</html>