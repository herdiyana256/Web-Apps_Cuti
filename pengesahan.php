<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
	include('Config/cek_login_dekan.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistem Informasi Cuti</title>
<link rel="stylesheet" href="CSS/layout.css" type="text/css" media="screen" />
</head>
<body>

<div id="container"><br>
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
        <div id="login2" style="overflow:auto;width:830px;height:322px;solid grey;">
            <h4 align="center"><strong>Tabel Pengesahan</strong></h4>
			<table border = "2px" align="center" style = "background:#ffc; width:1600px;">
				<tr>
					<th class="style8" style = "background:#2ecc71;">No</th>
					<th class="style8" style = "background:#2ecc71;">Nama</th>
					<th class="style8" style = "background:#2ecc71;">NIK</th>
					<th class="style8" style = "background:#2ecc71;">Status</th>
					<th class="style8" style = "background:#2ecc71;">Mengajukan</th>
					<th class="style8" style = "background:#2ecc71;">Lain Lain</th>
					<th class="style8" style = "background:#2ecc71;">Jumlah Hari</th>
					<th class="style8" style = "background:#2ecc71;">Tanggal Awal</th>
					<th class="style8" style = "background:#2ecc71;">Tanggal Akhir</th>
					<th class="style8" style = "background:#2ecc71;">Keterangan</th>
					<th class="style8" style = "background:#2ecc71;">Catatan</th>
					<th class="style8" style = "background:#2ecc71;">Pengesahan</th>
			  </tr>
				<?php
					include('Config/config.php');
					$resultdb = mysql_query("SELECT * FROM form_cuti");
						
					while ($row = mysql_fetch_array($resultdb)) {
					   $a = $row['id_form_cuti'];
					   $a2 = $row['id_dosen_pegawai'];
					   
					   $e = $row['mengajukan'];
					   $f = $row['alasan_khusus_text'].$row['alasan_lain_text'].$row['alasan_penting_text'].$row['luar_tanggungan_text'];
					   $g = $row['jumlah_hari'];
					   $h = $row['tanggal_awal'];
					   $i = $row['tanggal_berakhir'];
					   $j = $row['keterangan'];
					   $k = $row['status_pengesahan'];
					   
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
								print("<tr>");
								print("<td style = 'font-size:8pt'>$a</td>");
								print("<td style = 'font-size:8pt'>$b</td>");
								print("<td style = 'font-size:8pt'>$c</td>");
								print("<td style = 'font-size:8pt'>$d</td>");
								print("<td style = 'font-size:8pt'>$e</td>");
								print("<td style = 'font-size:8pt'>$f</td>");
								print("<td style = 'font-size:8pt'>$g</td>");
								print("<td style = 'font-size:8pt'>$h</td>");
								print("<td style = 'font-size:8pt'>$i</td>");
								print("<td style = 'font-size:8pt'>$j</td>");
								if ($k == 'Belum') {
								print("<td style = 'font-size:8pt'><form method='post' action='?action=submitfunct'><input type = 'text' name = 'catt' size = '40'></td>");
								
								print("<td style = 'font-size:8pt;text-align:center;'>
										<input type='hidden' name='id' value=$a/>
										<button name='button' value='1'><img src = 'images/yes.jpg' style = 'width:20px;'></button>
										<button name='button' value='2'><img src = 'images/no.jpg' style = 'width:20px;'></button>
									</form></td>");
								}
								elseif ($k == 'Setuju') {
									print("<td style = 'font-size:8pt'></td>");
									print("<td style = 'font-size:8pt;text-align:center;'>Setuju</td>");
								}
								elseif ($k == 'Tidak Setuju') {
									print("<td style = 'font-size:8pt'></td>");
									print("<td style = 'font-size:8pt;text-align:center;'>Tidak Setuju</td>");
								}
								print("</tr>");
						}
					?>
			</table>
   	  </div>
				<?php
					include("Config/update_pengesahan.php");
				?>
    </div>
</div>
<?php
	include("copyright.php");
?>
</html>