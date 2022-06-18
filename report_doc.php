<html>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
<body onload="window.print();">
<?php
	include("Config/config.php");

	$id = $_POST['id_cetak'];
	$id2 = $_POST['id_dosen_pegawai'];
?>
<img src = "images/yarsi.jpg" width = "190" height = "45">
<div style = 'width:100%; border:1pt solid black; text-align:center; font-size:12pt; margin-top:10px;'><b>FORM KETIDAKHADIRAN PEGAWAI</b></div><br>
Yang bertanda tangan dibawah ini.
<div style = 'margin-left:50px;'>
	<form>
		<table>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td>
					<?php
						$result2 = mysql_query("SELECT `nama` FROM `dosen_pegawai` WHERE `id_dosen_pegawai` = '$id2'");
						$row2 = mysql_fetch_array($result2);
						echo $row2["nama"];
					?>
				</td>
			</tr>
			<tr>
				<td>NIK</td>
				<td>:</td>
				<td>
					<?php
						$result2 = mysql_query("SELECT `NIK` FROM `dosen_pegawai` WHERE `id_dosen_pegawai` = '$id2'");
						$row2 = mysql_fetch_array($result2);
						echo $row2["NIK"];
					?>
				</td>
			</tr>
			<tr>
				<td>Unit/Fakultas&nbsp;</td>
				<td>:</td>
				<td>
					<?php
						$result2 = mysql_query("SELECT `unit_atau_fakultas` FROM `dosen_pegawai` WHERE `id_dosen_pegawai` = '$id2'");
						$row2 = mysql_fetch_array($result2);
						echo $row2["unit_atau_fakultas"];
					?>
				</td>
			</tr>
			<tr>
				<td>Status </td>
				<td>:</td>
				<td>
					<?php
						$result2 = mysql_query("SELECT `status` FROM `dosen_pegawai` WHERE `id_dosen_pegawai` = '$id2'");
						$row2 = mysql_fetch_array($result2);
						$status = $row2["status"];
						
						if ($status == "1" || $status == "2") {
					?>
							<input type = 'checkbox' checked>Dosen
							<input type = 'checkbox'>Karyawan
					<?php
						} else {
					?>
							<input type = 'checkbox'>Dosen
							<input type = 'checkbox' checked>Karyawan
					<?php
						}
					?>
				</td>
			</tr>
		</table>
	<?php
		$result2 = mysql_query("SELECT * FROM `form_cuti` WHERE `id_form_cuti` = '$id'");
		$row2 = mysql_fetch_array($result2);
		$mengajukan = $row2["mengajukan"];
		
		if ($mengajukan == "Sakit" || $mengajukan == "Alasan Lain" || $mengajukan == "Alasan Khusus") {
	?>
		<div style = 'margin-left:-48px;'>
			<table>
				<tr>
					<td>mengajukan</td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td>:</td>
					<td><input type = 'checkbox' checked>ijin tidak masuk kerja , dikarenakan :</td>
				</tr>
			</table>
		</div>
		<div style = 'margin-left:140px;'>
			<table>
				<?php
					if ($mengajukan == "Sakit") {
				?>
					<tr>
						<td><input type = 'checkbox' checked>sakit</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>alasan khusus</td>
						<td>:</td>
						<td>-</td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>alasan lain</td>
						<td>:</td>
						<td>-</td>
					</tr>
				<?php
					} elseif ($mengajukan == "Alasan Lain") {
				?>
					<tr>
						<td><input type = 'checkbox'>sakit</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>alasan khusus</td>
						<td>:</td>
						<td>-</td>
					</tr>
					<tr>
						<td><input type = 'checkbox' checked>alasan lain</td>
						<td>:</td>
						<td><span style = 'font-size:8pt;'>
						<?php
							$result2 = mysql_query("SELECT * FROM `form_cuti` WHERE `id_form_cuti` = '$id'");
							$row2 = mysql_fetch_array($result2);
							$lain = $row2['alasan_khusus_text'].$row2['alasan_lain_text'].$row2['alasan_penting_text'].$row2['luar_tanggungan_text'];
							echo $lain;
						?>
						</span>
						</td>
					</tr>
				<?php
					} elseif ($mengajukan == "Alasan Khusus") {
				?>
					<tr>
						<td><input type = 'checkbox'>sakit</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox' checked>alasan khusus</td>
						<td>:</td>
						<td><span style = 'font-size:8pt;'>
						<?php
							$result2 = mysql_query("SELECT * FROM `form_cuti` WHERE `id_form_cuti` = '$id'");
							$row2 = mysql_fetch_array($result2);
							$lain = $row2['alasan_khusus_text'].$row2['alasan_lain_text'].$row2['alasan_penting_text'].$row2['luar_tanggungan_text'];
							echo $lain;
						?>
						</span>
						</td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>alasan lain</td>
						<td>:</td>
						<td>-</td>
					</tr>
				<?php
					}
				?>
			</table>
		</div>
		<div style = 'margin-left:37px;'>
			<table>
				<tr>
					<td> </td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td> </td>
					<td><input type = 'checkbox'>cuti :</td>
				</tr>
			</table>
		</div>
		<div style = 'margin-left:140px;'>
			<table>
				<tr>
					<td><input type = 'checkbox'>tahunan</td>
					<td> </td>
					<td> </td>
				</tr>
				<tr>
					<td><input type = 'checkbox'>besar</td>
					<td> </td>
					<td> </td>
				</tr>
				<tr>
					<td><input type = 'checkbox'>sakit</td>
					<td> </td>
					<td> </td>
				</tr>
				<tr>
					<td><input type = 'checkbox'>bersalin/melahirkan</td>
					<td> </td>
					<td> </td>
				</tr>
				<tr>
					<td><input type = 'checkbox'>karena alasan penting</td>
					<td>:</td>
					<td>-</td>
				</tr>
				<tr>
					<td><input type = 'checkbox'>di luar tanggungan, karena</td>
					<td> </td>
					<td>-</td>
				</tr>
			</table>
		</div>
	<?php
		} else {
	?>
		<div style = 'margin-left:-48px;'>
			<table>
				<tr>
					<td>mengajukan</td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td>:</td>
					<td><input type = 'checkbox' checked>ijin tidak masuk kerja , dikarenakan :</td>
				</tr>
			</table>
		</div>
		<div style = 'margin-left:140px;'>
			<table>
				<tr>
					<td><input type = 'checkbox'>sakit</td>
					<td> </td>
					<td> </td>
				</tr>
				<tr>
					<td><input type = 'checkbox'>alasan khusus</td>
					<td>:</td>
					<td>-</td>
				</tr>
				<tr>
					<td><input type = 'checkbox'>alasan lain</td>
					<td>:</td>
					<td>-</td>
				</tr>
			</table>
		</div>
		<div style = 'margin-left:37px;'>
			<table>
				<tr>
					<td> </td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td> </td>
					<td><input type = 'checkbox' checked>cuti :</td>
				</tr>
			</table>
		</div>
		<div style = 'margin-left:140px;'>
			<table>
				<?php
					if ($mengajukan == "Tahunan") {
				?>
					<tr>
						<td><input type = 'checkbox' checked>tahunan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>besar</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>sakit</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>bersalin/melahirkan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>karena alasan penting</td>
						<td>:</td>
						<td>-</td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>di luar tanggungan, karena</td>
						<td> </td>
						<td>-</td>
					</tr>
				<?php
					} elseif ($mengajukan == "Besar") {
				?>
					<tr>
						<td><input type = 'checkbox'>tahunan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox' checked>besar</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>sakit</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>bersalin/melahirkan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>karena alasan penting</td>
						<td>:</td>
						<td>-</td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>di luar tanggungan, karena</td>
						<td> </td>
						<td>-</td>
					</tr>
				<?php
					} elseif ($mengajukan == "Sakit") {
				?>
					<tr>
						<td><input type = 'checkbox'>tahunan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>besar</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox' checked>sakit</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>bersalin/melahirkan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>karena alasan penting</td>
						<td>:</td>
						<td>-</td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>di luar tanggungan, karena</td>
						<td> </td>
						<td>-</td>
					</tr>
				<?php
					} elseif ($mengajukan == "Bersalin/melahirkan") {
				?>
					<tr>
						<td><input type = 'checkbox'>tahunan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>besar</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>sakit</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox' checked>bersalin/melahirkan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>karena alasan penting</td>
						<td>:</td>
						<td>-</td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>di luar tanggungan, karena</td>
						<td> </td>
						<td>-</td>
					</tr>
				<?php
					} elseif ($mengajukan == "Alasan Penting") {
				?>
					<tr>
						<td><input type = 'checkbox'>tahunan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>besar</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>sakit</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>bersalin/melahirkan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox' checked>karena alasan penting</td>
						<td>:</td>
						<td><span style = 'font-size:8pt;'>
						<?php
							$result2 = mysql_query("SELECT * FROM `form_cuti` WHERE `id_form_cuti` = '$id'");
							$row2 = mysql_fetch_array($result2);
							$lain = $row2['alasan_khusus_text'].$row2['alasan_lain_text'].$row2['alasan_penting_text'].$row2['luar_tanggungan_text'];
							echo $lain;
						?>
						<span>
						</td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>di luar tanggungan, karena</td>
						<td> </td>
						<td>-</td>
					</tr>
				<?php
					} elseif ($mengajukan == "Di Luar Tanggungan") {
				?>
					<tr>
						<td><input type = 'checkbox'>tahunan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>besar</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>sakit</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>bersalin/melahirkan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><input type = 'checkbox'>karena alasan penting</td>
						<td>:</td>
						<td>-</td>
					</tr>
					<tr>
						<td><input type = 'checkbox' checked>di luar tanggungan, karena</td>
						<td> </td>
						<td><span style = 'font-size:8pt;'>
						<?php
							$result2 = mysql_query("SELECT * FROM `form_cuti` WHERE `id_form_cuti` = '$id'");
							$row2 = mysql_fetch_array($result2);
							$lain = $row2['alasan_khusus_text'].$row2['alasan_lain_text'].$row2['alasan_penting_text'].$row2['luar_tanggungan_text'];
							echo $lain;
						?>
						</span>
						</td>
					</tr>
				<?php
					}
					}
				?>
			</table>
		</div>
		<div style = 'margin-left:0px;'>
			<table>
				<tr>
					<td>selama</td>
					<td>:</td>
					<td>
						<?php
							$result2 = mysql_query("SELECT * FROM `form_cuti` WHERE `id_form_cuti` = '$id'");
							$row2 = mysql_fetch_array($result2);
							$hari = $row2['jumlah_hari'];
							echo $hari;
						?>
						hari
					</td>
				</tr>
				<tr>
					<td>dari tanggal</td>
					<td> </td>
					<td><?php
							$result2 = mysql_query("SELECT * FROM `form_cuti` WHERE `id_form_cuti` = '$id'");
							$row2 = mysql_fetch_array($result2);
							$h = date('d-m-Y', strtotime($row2['tanggal_awal']));
							echo $h;
						?>
					s/d
						<?php
							$result2 = mysql_query("SELECT * FROM `form_cuti` WHERE `id_form_cuti` = '$id'");
							$row2 = mysql_fetch_array($result2);
							$i = date('d-m-Y', strtotime($row2['tanggal_berakhir']));
							echo $i;
						?>
					</td>
				</tr>
			</table>
		</div>
		<div style = 'margin-left:0px;'>
			<table>
				<?php
					$result2 = mysql_query("SELECT * FROM `form_cuti` WHERE `id_form_cuti` = '$id'");
					$row2 = mysql_fetch_array($result2);
					$keterangan = $row2["keterangan"];
					
					if ($keterangan == "Surat dokter") {
				?>
					<tr>
						<td>dengan keterangan:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td><input type = 'checkbox' checked>surat dokter <input type = 'checkbox'>surat tugas <input type = 'checkbox'>surat keterangan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td> </td>
						<td><input type = 'checkbox'>dipotong cuti tahunan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td> </td>
						<td><input type = 'checkbox'>dipotong gaji</td>
						<td> </td>
						<td> </td>
					</tr>
				<?php
					} elseif ($keterangan == "Dipotong cuti tahunan") {
				?>
					<tr>
						<td>dengan keterangan:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td><input type = 'checkbox'>surat dokter <input type = 'checkbox'>surat tugas <input type = 'checkbox'>surat keterangan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td> </td>
						<td><input type = 'checkbox' checked>dipotong cuti tahunan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td> </td>
						<td><input type = 'checkbox'>dipotong gaji</td>
						<td> </td>
						<td> </td>
					</tr>
				<?php
					} elseif ($keterangan == "Dipotong gaji") {
				?>
					<tr>
						<td>dengan keterangan:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td><input type = 'checkbox'>surat dokter <input type = 'checkbox'>surat tugas <input type = 'checkbox'>surat keterangan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td> </td>
						<td><input type = 'checkbox'>dipotong cuti tahunan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td> </td>
						<td><input type = 'checkbox' checked>dipotong gaji</td>
						<td> </td>
						<td> </td>
					</tr>
					<?php
					} elseif ($keterangan == "Surat keterangan") {
				?>
					<tr>
						<td>dengan keterangan:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td><input type = 'checkbox'>surat dokter <input type = 'checkbox'>surat tugas <input type = 'checkbox' checked>surat keterangan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td> </td>
						<td><input type = 'checkbox'>dipotong cuti tahunan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td> </td>
						<td><input type = 'checkbox'>dipotong gaji</td>
						<td> </td>
						<td> </td>
					</tr>
					<?php
					} elseif ($keterangan == "Surat tugas") {
				?>
					<tr>
						<td>dengan keterangan:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td><input type = 'checkbox'>surat dokter <input type = 'checkbox' checked>surat tugas <input type = 'checkbox'>surat keterangan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td> </td>
						<td><input type = 'checkbox'>dipotong cuti tahunan</td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td> </td>
						<td><input type = 'checkbox'>dipotong gaji</td>
						<td> </td>
						<td> </td>
					</tr>
				<?php
					}
				?>
			</table>
		</div>
	</form>
</div>
Demikianlah permohonan ini saya buat, atas perhatian dan persetujuannya kami ucapkan terima kasih.
<div style = 'margin-left:460px; margin-top:-10px;'>
	<p>Jakarta : <?php
					$result2 = mysql_query("SELECT * FROM `form_cuti` WHERE `id_form_cuti` = '$id'");
					$row2 = mysql_fetch_array($result2);
					$tanggal = $row2["tanggal"];
					echo $tanggal;
				?></p>
</div>
<div style = 'margin-left:460px; margin-top:-10px;'>
	Pemohon
</div>
<br>
<div style = 'float:right;'>
	<p>(<?php
		$result2 = mysql_query("SELECT `nama` FROM `dosen_pegawai` WHERE `id_dosen_pegawai` = '$id2'");
		$row2 = mysql_fetch_array($result2);
		echo $row2["nama"];
	?>)</p>
</div>
<br>
<br>
<br>
<hr>
<p>Yang bertanda tangan di bawah ini, memberikan persetujuan / tidak memberikan persetujuan.</p>
<div style = 'margin-left:460px;'>
	<p>Jakarta : ..............................<?php
					/*$result2 = mysql_query("SELECT * FROM `form_cuti` WHERE `id_form_cuti` = '$id'");
					$row2 = mysql_fetch_array($result2);
					$tanggal_pengesahan = $row2["tanggal_pengesahan"];
					echo $tanggal_pengesahan;*/
				?></p>
</div>
<br>
<div style = 'float:right;'>
	<p>(Dr. Vitri Tundjungsari, S.T., M.Sc.)</p>
</div>
<br>
<div style = 'border: 1pt solid black; width:350px; height:60px; position:absolute; margin-top:-80px; padding-left:10px;'>
	Dengan catatan ............................................................<br>
	......................................................................................<br>
	......................................................................................
	
				<?php
					/*$result2 = mysql_query("SELECT * FROM `form_cuti` WHERE `id_form_cuti` = '$id'");
					$row2 = mysql_fetch_array($result2);
					$catatan = $row2["catatan"];
					echo $catatan;*/
				?>
</div>
</div>

4.0.000.3.03.0.02 Rev 00
</body>
</html>