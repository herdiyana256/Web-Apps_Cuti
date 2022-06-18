<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
	include('Config/cek_login_dosen.php');
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
        
        <div id="login2">
    		<div style="padding:0px;overflow:auto;width:830px;height:322px;solid grey;">
            <h4>&nbsp;&nbsp;&nbsp;Silahkan Mengisi Form Cuti Berikut : </h4>
		<table>
			<tr>
    			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama </td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php
				include('Config/config.php');
				$result2 = mysql_query("SELECT `nama` FROM `dosen_pegawai` WHERE `username` = '$username'");
				$row2 = mysql_fetch_array($result2);
				echo $row2["nama"];
				?></td>
			</tr>	
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIK</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php
				include('Config/config.php');
				$result2 = mysql_query("SELECT `NIK` FROM `dosen_pegawai` WHERE `username` = '$username'");
				$row2 = mysql_fetch_array($result2);
				echo $row2["NIK"];
				?></td>
            </tr>
            <tr>
    			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unit/Fakultas </td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php
				include('Config/config.php');
				$result2 = mysql_query("SELECT `unit_atau_fakultas` FROM `dosen_pegawai` WHERE `username` = '$username'");
				$row2 = mysql_fetch_array($result2);
				echo $row2["unit_atau_fakultas"];
				?></td>
			</tr>
            <tr>
    			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status </td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php
				include('Config/config.php');
				$result2 = mysql_query("SELECT `status` FROM `dosen_pegawai` WHERE `username` = '$username'");
				$row2 = mysql_fetch_array($result2);
				$data = $row2["status"];
				if ($data == "1")
					echo "Dosen TI";
				else if ($data == "2")
					echo "Dosen IP";
				else if ($data == "3")
					echo "Karyawan";
				?></td>
			</tr>
			<tr>
				<form method="post" action="?action=submitfunct">
				<input type="hidden" name="id" value="<?php
					include('Config/config.php');
					$result2 = mysql_query("SELECT `id_dosen_pegawai` FROM `dosen_pegawai` WHERE `username` = '$username'");
					$row2 = mysql_fetch_array($result2);
					echo $row2["id_dosen_pegawai"];
					?>" />
				<input type="hidden" name="sisa_cuti" value="<?php
					include('Config/config.php');
					$result2 = mysql_query("SELECT `waktu_cuti` FROM `dosen_pegawai` WHERE `username` = '$username'");
					$row2 = mysql_fetch_array($result2);
					echo $row2["waktu_cuti"];
					?>" />
				<input type="hidden" name="tanggal" value="<?php
					$mydate = getdate(date("U"));
					$date1 = "$mydate[mday]-$mydate[mon]-$mydate[year]";
					echo $date1;
					?>" />
    			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mengajukan </td>
				<td>&nbsp;&nbsp;&nbsp;<input type="radio" name="mengajukan" value="Ijin" onclick="radio1();" id="ijin" required/>Ijin tidak masuk kerja, dikarenakan :</td>
			</tr>
				<tr>
					<td></td>
					<td id="mengajukan_view1" style="display:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" onclick="radio2();" name="tidak_masuk_kerja" value="Sakit" id="sakit_kerja" />Sakit</td>
				</tr>
				<tr>
					<td></td>
					<td id="mengajukan_view2" style="display:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" onclick="radio2();" name="tidak_masuk_kerja" value="Alasan Khusus" id="alasan_khusus" />Alasan Khusus
					</td>
					<td>
						<span id="alasan_khusus_text" style="display:none; margin-left:-200px"><input type='text' name='alasan_khusus_text' size="40"></span>
					</td>
				</tr>
				<tr>
					<td></td>
					<td id="mengajukan_view3" style="display:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" onclick="radio2();" name="tidak_masuk_kerja" value="Alasan Lain" id="alasan_lain" />Alasan Lain
					</td>
					<td>
						<span id="alasan_lain_text" style="display:none; margin-left:-200px"><input type='text' name='alasan_lain_text' size="40"></span>
					</td>
				</tr>
			<tr>
    			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
				
				<td>&nbsp;&nbsp;&nbsp;<input type="radio" name="mengajukan" value="Cuti" onclick="radio1();" id="cuti" />Cuti : <span style = "color:red;">(Sisa Cuti = <?php
					include('Config/config.php');
					$result2 = mysql_query("SELECT `waktu_cuti` FROM `dosen_pegawai` WHERE `username` = '$username'");
					$row2 = mysql_fetch_array($result2);
					echo $row2["waktu_cuti"];
					?> Hari)</span></td>
				
				
			</tr>
				<tr>
					<td></td>
					<td id="mengajukan_view4" style="display:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" onclick="radio3();" name="jenis_cuti" value="Tahunan" id="tahunan" />Tahunan</td>
				</tr>
				<tr>
					<td></td>
					<td id="mengajukan_view5" style="display:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" onclick="radio3();" name="jenis_cuti" value="Besar" id="besar" />Besar</td>
				</tr>
				<tr>
					<td></td>
					<td id="mengajukan_view6" style="display:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" onclick="radio3();" name="jenis_cuti" value="Sakit" id="sakit" />Sakit</td>
				</tr>
				<tr>
					<td></td>
					<td id="mengajukan_view7" style="display:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" onclick="radio3();" name="jenis_cuti" value="Bersalin/melahirkan" id="bersalin" />Bersalin/melahirkan</td>
				</tr>
				<tr>
					<td></td>
					<td id="mengajukan_view8" style="display:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" onclick="radio3();" name="jenis_cuti" value="Alasan Penting" id="alasan_penting" />Karena alasan penting
					</td>
					<td>
						<span id="alasan_penting_text" style="display:none; margin-left:-90px"><input type='text' name='alasan_penting_text' size="35"></span>
					</td>
				</tr>
				<tr>
					<td></td>
					<td id="mengajukan_view9" style="display:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" onclick="radio3();" name="jenis_cuti" value="Di Luar Tanggungan" id="luar_tanggungan" />Di luar tanggungan, karena
					</td>
					<td>
						<span id="luar_tanggungan_text" style="display:none; margin-left:-90px"><input type='text' name='luar_tanggungan_text' size="35"></span>
					</td>
				</tr>
				
				<tr>
    				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Selama </td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="number" name="jumlah_hari" required/> Hari</td>
				</tr>
                <tr>
    			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dari tanggal </td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" size="20" name="tanggal_awal" title="dd-mm-yyyy"/ required> &nbsp;s/d &nbsp;<input type="date" size="20" name="tanggal_berakhir" title="dd-mm-yyyy"/ required></td>
			</tr>	
            <tr>
    			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dengan keterangan </td>
				<td>&nbsp;&nbsp;&nbsp;<input type="radio" name="keterangan" id = "suratdokter" onclick="radio4();" value="Surat dokter"/ required>Surat dokter</td>
			</tr>
			<tr>
    			<td> </td>
				<td>&nbsp;&nbsp;&nbsp;<input type="radio" name="keterangan" id = "surattugas" onclick="radio4();" value="Surat tugas"/ required>Surat tugas</td>
			</tr>
			<tr>
				<td> </td>
				<td id="laporan2" style="display:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="laporan" value="Ada"/>Laporan ada</td>
			</tr>
			<tr>
				<td> </td>
				<td id="laporan3" style="display:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="laporan" value="Tidak ada"/>Laporan tidak ada</td>
			</tr>
			<tr>
    			<td> </td>
				<td>&nbsp;&nbsp;&nbsp;<input type="radio" name="keterangan" id = "suratketerangan" onclick="radio4();" value="Surat keterangan"/ required>Surat keterangan</td>
			</tr>
            <tr>
            	<td></td>
				<td>&nbsp;&nbsp;&nbsp;<input type="radio" name="keterangan" id = "potongcuti" onclick="radio4();" value="Dipotong cuti tahunan"/ required>Dipotong cuti tahunan</td>
			</tr>
            <tr>
            	<td></td>
				<td>&nbsp;&nbsp;&nbsp;<input type="radio" name="keterangan" id = "potonggaji" onclick="radio4();" value="Dipotong gaji"/ required>Dipotong gaji</td>
			</tr>
			<tr>
            	<td> </td>
				<td> </td>
			</tr>
			<tr>
            	<td> </td>
				<td> </td>
			</tr>
			<tr>
            	<td> </td>
				<td> </td>
			</tr>
			<tr>
            	<td> </td>
				<td> </td>
			</tr>
			<tr>
            	<td> </td>
				<td> </td>
				<td>Jakarta, <span id = "date"></span><script type = "text/javascript">
								var current = new Date();
								var date = current.getUTCDate();
								var month = current.getUTCMonth()+1;
								var year = current.getUTCFullYear();
								
								document.getElementById("date").innerHTML = date + "-" + month + "-" + year;
							 </script> </td>
			</tr>
            <tr>
            	<td></td>
				<td><br>&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Kirim" style = "font-size:12pt;width:100px;height:25px;"/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="submit" value="Hapus" style = "font-size:12pt;width:100px;height:25px;"/></td>
			</tr>
			</tr>
		</table>
				</form>
		  </div>
			<script type="text/javascript">
				function radio4() {
					if (document.getElementById('surattugas').checked) {
						document.getElementById('laporan2').style.display = 'block';
						document.getElementById('laporan3').style.display = 'block';
					}
					else if (document.getElementById('suratdokter').checked) {
						document.getElementById('laporan2').style.display = 'none';
						document.getElementById('laporan3').style.display = 'none';
					}
					else if (document.getElementById('suratketerangan').checked) {
						document.getElementById('laporan2').style.display = 'none';
						document.getElementById('laporan3').style.display = 'none';
					}
					else if (document.getElementById('potongcuti').checked) {
						document.getElementById('laporan2').style.display = 'none';
						document.getElementById('laporan3').style.display = 'none';
					}
					else if (document.getElementById('potonggaji').checked) {
						document.getElementById('laporan2').style.display = 'none';
						document.getElementById('laporan3').style.display = 'none';
					}
				}
			</script>
			<script type="text/javascript">
				function radio1() {
					if (document.getElementById('ijin').checked) {
						document.getElementById('mengajukan_view1').style.display = 'block';
						document.getElementById('mengajukan_view2').style.display = 'block';
						document.getElementById('mengajukan_view3').style.display = 'block';
						document.getElementById('mengajukan_view4').style.display = 'none';
						document.getElementById('mengajukan_view5').style.display = 'none';
						document.getElementById('mengajukan_view6').style.display = 'none';
						document.getElementById('mengajukan_view7').style.display = 'none';
						document.getElementById('mengajukan_view8').style.display = 'none';
						document.getElementById('mengajukan_view9').style.display = 'none';
						document.getElementById('alasan_penting_text').style.display = 'none';
						document.getElementById('luar_tanggungan_text').style.display = 'none';
					}
					if (document.getElementById('cuti').checked) {
						document.getElementById('mengajukan_view1').style.display = 'none';
						document.getElementById('mengajukan_view2').style.display = 'none';
						document.getElementById('mengajukan_view3').style.display = 'none';
						document.getElementById('mengajukan_view4').style.display = 'block';
						document.getElementById('mengajukan_view5').style.display = 'block';
						document.getElementById('mengajukan_view6').style.display = 'block';
						document.getElementById('mengajukan_view7').style.display = 'block';
						document.getElementById('mengajukan_view8').style.display = 'block';
						document.getElementById('mengajukan_view9').style.display = 'block';
						document.getElementById('alasan_khusus_text').style.display = 'none';
						document.getElementById('alasan_lain_text').style.display = 'none';
					}
				}
			</script>
			<script type="text/javascript">
				function radio2() {
					if (document.getElementById('alasan_khusus').checked) {
						document.getElementById('alasan_khusus_text').style.display = 'block';
						document.getElementById('alasan_lain_text').style.display = 'none';
					}
					else if (document.getElementById('sakit_kerja').checked) {
						document.getElementById('alasan_khusus_text').style.display = 'none';
						document.getElementById('alasan_lain_text').style.display = 'none';
					}
					else if (document.getElementById('alasan_lain').checked) {
						document.getElementById('alasan_lain_text').style.display = 'block';
						document.getElementById('alasan_khusus_text').style.display = 'none';
					}
				}
			</script>
				<script type="text/javascript">
				function radio3() {
					if (document.getElementById('tahunan').checked) {
						document.getElementById('alasan_penting_text').style.display = 'none';
						document.getElementById('luar_tanggungan_text').style.display = 'none';
					}
					else if (document.getElementById('besar').checked) {
						document.getElementById('alasan_penting_text').style.display = 'none';
						document.getElementById('luar_tanggungan_text').style.display = 'none';
					}
					else if (document.getElementById('sakit').checked) {
						document.getElementById('alasan_penting_text').style.display = 'none';
						document.getElementById('luar_tanggungan_text').style.display = 'none';
					}
					else if (document.getElementById('bersalin').checked) {
						document.getElementById('alasan_penting_text').style.display = 'none';
						document.getElementById('luar_tanggungan_text').style.display = 'none';
					}
					else if (document.getElementById('alasan_penting').checked) {
						document.getElementById('alasan_penting_text').style.display = 'block';
						document.getElementById('luar_tanggungan_text').style.display = 'none';
					}
					else if (document.getElementById('luar_tanggungan').checked) {
						document.getElementById('luar_tanggungan_text').style.display = 'block';
						document.getElementById('alasan_penting_text').style.display = 'none';
					}
				}
			</script>
   	  </div>
				<?php
					include("Config/input_cuti.php");
				?>
    </div>
</div>
</body>
<?php
	include("copyright.php");
?>
</html>