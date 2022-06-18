<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
session_start();
?>
<?php
	include("Config/config.php");
	if (isset($_SESSION['username']) || !empty($_SESSION['username'])) {
		$username = $_SESSION['username'];
		
		$result = mysql_query("SELECT `nama`, `status`, `NIK` FROM `dekanat` WHERE `username` = '$username'");
		$result2 = mysql_query("SELECT `nama`, `status`, `NIK` FROM `dosen_pegawai` WHERE `username` = '$username'");
		$result3 = mysql_query("SELECT `nama`, `status`, `id_admin_tatausaha` FROM `admin_tatausaha` WHERE `username` = '$username'");
		$row = mysql_fetch_array($result);
		$row2 = mysql_fetch_array($result2);
		$row3 = mysql_fetch_array($result3);
	
		if ($row3["status"] != "admin") {
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistem Informasi Cuti</title>
<link rel="stylesheet" href="CSS/layout.css" type="text/css" media="screen" />
</head>
<body>

<?php
	include('Config/config.php');

	$mydate = getdate(date("U"));
	$date1 = "$mydate[year]-$mydate[mon]-$mydate[mday]";
	$year = "$mydate[year]";
	$day = (int)"$mydate[mday]";
	$month = (int)"$mydate[mon]";
	
	//echo $day." ".$month."<br>";

	$resultdb = mysql_query("SELECT * FROM dosen_pegawai ORDER BY tahun_masuk DESC");
	while ($row = mysql_fetch_array($resultdb)) {
		$a = $row['id_dosen_pegawai'];
		$b = $row['waktu_cuti'];
		
		$date2 = date('Y-m-d', strtotime($row['tahun_masuk']));
		$no_year = date('m-d', strtotime($row['tahun_masuk']));
		$group = $year."-".$no_year;
		$day2 = (int)date('d', strtotime($row['tahun_masuk']));
		$month2 = (int)date('m', strtotime($row['tahun_masuk']));
		
		//echo $day2." ".$month2."<br>";
		
		$date1_c_1 = date_create($group);
		$date2_c_1 = date_create($date2);
		$diff1 = date_diff($date2_c_1,$date1_c_1); // sisa harapan
		
		$date1_c = date_create($date1);
		$date2_c = date_create($date2);
		$diff2 = date_diff($date2_c,$date1_c); // sisa sekarang
		
		if ($diff2->format("%a") < 365) {
			mysql_query("UPDATE dosen_pegawai SET waktu_cuti = 0 WHERE id_dosen_pegawai = '$a'");
		}
		else if (($day == $day2) && ($month == $month2)) {
			mysql_query("UPDATE dosen_pegawai SET waktu_cuti = 12 WHERE id_dosen_pegawai = '$a'");
		}
	}
?>

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
        
		<?php
			if (isset($_SESSION['username']) || !empty($_SESSION['username'])) {
		?>
				
			<div id="login2">
				<div style="padding:0px;overflow:auto;width:830px;height:322px;solid grey" >
						<div style = "margin-left:20px; margin-top:10px; width:800px; font-size:9pt; padding-top:5px; padding-bottom:5px;">
							<?php
								$mydate = getdate(date("U"));
								$hari = "$mydate[weekday]";
								if ($hari == "Sunday")
									$hari = "Minggu";
								elseif ($hari == "Monday")
									$hari = "Senin";
								elseif ($hari == "Tuesday")
									$hari = "Selasa";
								elseif ($hari == "Wednesday")
									$hari = "Rabu";
								elseif ($hari == "Thursday")
									$hari = "Kamis";
								elseif ($hari == "Friday")
									$hari = "Jum'at";
								elseif ($hari == "Saturday")
									$hari = "Sabtu";
								
								date_default_timezone_set('Asia/Jakarta');
								$timezone = date('H:i:s');
								
								$date1 = $hari. ", $mydate[mday] $mydate[month] $mydate[year] ";
								echo $date1 . $timezone . ' WIB | Tahun Akademik 2014/2015';
						?>
						</div>
						<div style = "margin-left:20px; width:800px; font-size:9pt; padding-top:5px; padding-bottom:5px;"><b>
						<?php
								echo $row["nama"];
								echo $row2["nama"];
								echo $row3["nama"];
								echo " (";
								echo $row["NIK"];
								echo $row2["NIK"];
								echo $row3["id_admin_tatausaha"];
								echo ")";
						?>
						</b>
						<?php
								echo "- Level User : ";
								echo "<b>".$row["status"];
								if ($row2["status"] == "1" || $row2["status"] == "2")
									echo "dosen";
								elseif ($row2["status"] == "3")
									echo "karyawan";
								echo $row3["status"]."</b>";
								echo ", Fakultas : Teknologi Informasi";
						?>
						</div>
						<br>
				
						<div align="center">
							<strong><a id="lupapassword" href="http://nic.yarsi.ac.id/registrasi/chpass.php"><span id="hover">Ganti Password</span></a></strong>
						</div>
						
						<h4 align="center"><strong>Ketentuan-ketentuan yang berkaitan dengan hal cuti yaitu :</strong></h4>
						<p align="justify" style = "padding-left:10px; padding-right:10px; font-size:10.5pt;">
							<?php
								include('Config/config.php');

								$resultdb = mysql_query("SELECT * FROM informasi_cuti");
								while ($row = mysql_fetch_array($resultdb)) {
									echo $row["syarat_cuti"] . "<br>";
								}
							?>
						</p>
			  </div>
			  
		<?php
			} else {
		?>
		
		<div id="login">
    		<div id="form">
        <strong>Form Login</strong>
        	</div>
        <div id="input">
        	<div id="paddinglogin">
            	<div id="ukuran">
                <form action="Config/otentikasi.php" method="post">
        <h4 align="center">User Name :</h4>
        	</div>
            	</div>
        	<div id="paddinglogin">
        <input type="text" name="username" id="username" size="30"/>
        	</div>
        	<div id="paddinglogin">
            	<div id="ukuran">
        <h4 align="center">Password  :</h4>
        	</div>
            	</div>
        	<div id="paddinglogin">        
            <input name="password" type="password" id="password" size="30"/><br /><br />
        	</div>
        	<div id="paddinglogin">
            	<div id="ukuran">
        <input type="submit" name="submit" value="Login" />
        	</div>
            <?php
				if(!empty($_GET['error'])){
					if($_GET['error'] == 1){?>
                   	<script>
					alert("Please check your username and password");
					</script>
                    <?php
					}
				}?>
            </form>
            	</div>
        	<div id="paddinglogin">
				<br /><br /><strong><a id="lupapassword" href="http://nic.yarsi.ac.id/registrasi/chpass.php?from_sisakad=1"><span id="hover">Lupa Password ?</span></a></strong>
        	</div>
        </div>
    	</div>
		
		<?php
			}
		?>
			
    </div>
</div>
</body>
<?php
	include("copyright.php");
?>
</html>
<?php
} else {
	
?>
	<?php
	include ("phpmydatagrid.class.php");
	
	$objGrid = new datagrid;
	
	$objGrid -> friendlyHTML();

	$objGrid -> pathtoimages("./images/");

	$objGrid -> closeTags(true);  
	
	$objGrid -> form('dosen_pegawai', true);
	
	$objGrid -> methodForm("post"); 
	
	//$objGrid -> total("salary,workeddays");
	
	$objGrid -> searchby("syarat_cuti");
	
	//$objGrid -> linkparam("sess=".$_REQUEST["sess"]."&username=".$_REQUEST["username"]);	 
	
	$objGrid -> decimalDigits(2);
	
	$objGrid -> decimalPoint(",");
	
	/* ADOdb library must be included */
	include_once('adodb/adodb.inc.php');
	
	/* to use ADOdb is so simple as say true */
	$objGrid -> conectadb("localhost", "root", "", "cuti", true, "mysql");
	
	$objGrid -> tabla ("informasi_cuti");

	$objGrid -> buttons(true,true,true,true);
	
	$objGrid -> keyfield("id_informasi_cuti");

	$objGrid -> salt("Some Code4Stronger(Protection)");

	//$objGrid -> TituloGrid("phpMyDataGrid Sample page");

	//$objGrid -> FooterGrid("<div style='float:left'>&copy; 2007 Gurusistemas.com</div>");

	$objGrid -> datarows(100);
	
	$objGrid -> paginationmode('links');

	$objGrid -> orderby("id_informasi_cuti", "ASC");

	$objGrid -> noorderarrows();
	
	//$objGrid -> FormatColumn("id_informasi_cuti", "Nomor", 120, 120, 0, "10", "center");
	$objGrid -> FormatColumn("syarat_cuti", "Informasi Cuti", 120, 120, 0, "760", "center");

	$objGrid -> where ("active = '1'");
	
	if (!isset($_REQUEST["DG_ajaxid"])){ // If we intercept an AJAX request from page 
									 // then do not display data below	
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'.
		'<html xmlns="http://www.w3.org/1999/xhtml">'.
		'<head>'.
		'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'.
		'<title>Sistem Informasi Cuti</title>'.
		'<link rel="stylesheet" href="CSS/layout.css" type="text/css" media="screen" />'.
		'</head>';

	$objGrid -> setHeader();
?>
<body>

<?php
	include('Config/config.php');

	$mydate = getdate(date("U"));
	$date1 = "$mydate[year]-$mydate[mon]-$mydate[mday]";
	$year = "$mydate[year]";
	$day = (int)"$mydate[mday]";
	$month = (int)"$mydate[mon]";
	
	//echo $day." ".$month."<br>";

	$resultdb = mysql_query("SELECT * FROM dosen_pegawai ORDER BY tahun_masuk DESC");
	while ($row = mysql_fetch_array($resultdb)) {
		$a = $row['id_dosen_pegawai'];
		$b = $row['waktu_cuti'];
		
		$date2 = date('Y-m-d', strtotime($row['tahun_masuk']));
		$no_year = date('m-d', strtotime($row['tahun_masuk']));
		$group = $year."-".$no_year;
		$day2 = (int)date('d', strtotime($row['tahun_masuk']));
		$month2 = (int)date('m', strtotime($row['tahun_masuk']));
		
		//echo $day2." ".$month2."<br>";
		
		$date1_c_1 = date_create($group);
		$date2_c_1 = date_create($date2);
		$diff1 = date_diff($date2_c_1,$date1_c_1); // sisa harapan
		
		$date1_c = date_create($date1);
		$date2_c = date_create($date2);
		$diff2 = date_diff($date2_c,$date1_c); // sisa sekarang
		
		if ($diff2->format("%a") < 365) {
			mysql_query("UPDATE dosen_pegawai SET waktu_cuti = 0 WHERE id_dosen_pegawai = '$a'");
		}
		else if (($day == $day2) && ($month == $month2)) {
			mysql_query("UPDATE dosen_pegawai SET waktu_cuti = 12 WHERE id_dosen_pegawai = '$a'");
		}
	}
?>

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
        
		<?php
			if (isset($_SESSION['username']) || !empty($_SESSION['username'])) {
		?>
				
			<div id="login2">
				<div style="padding:0px;overflow:auto;width:830px;height:322px;solid grey" >
						<div style = "margin-left:20px; margin-top:10px; width:800px; font-size:9pt; padding-top:5px; padding-bottom:5px;">
							<?php
								$mydate = getdate(date("U"));
								$hari = "$mydate[weekday]";
								if ($hari == "Sunday")
									$hari = "Minggu";
								elseif ($hari == "Monday")
									$hari = "Senin";
								elseif ($hari == "Tuesday")
									$hari = "Selasa";
								elseif ($hari == "Wednesday")
									$hari = "Rabu";
								elseif ($hari == "Thursday")
									$hari = "Kamis";
								elseif ($hari == "Friday")
									$hari = "Jum'at";
								elseif ($hari == "Saturday")
									$hari = "Sabtu";
								
								date_default_timezone_set('Asia/Jakarta');
								$timezone = date('H:i:s');
								
								$date1 = $hari. ", $mydate[mday] $mydate[month] $mydate[year] ";
								echo $date1 . $timezone . ' WIB | Tahun Akademik 2014/2015';
						?>
						</div>
						<div style = "margin-left:20px; width:800px; font-size:9pt; padding-top:5px; padding-bottom:5px;"><b>
						<?php
								echo $row["nama"];
								echo $row2["nama"];
								echo $row3["nama"];
								echo " (";
								echo $row["NIK"];
								echo $row2["NIK"];
								echo $row3["id_admin_tatausaha"];
								echo ")";
						?>
						</b>
						<?php
								echo "- Level User : ";
								echo "<b>".$row["status"];
								if ($row2["status"] == "1" || $row2["status"] == "2")
									echo "dosen";
								elseif ($row2["status"] == "3")
									echo "karyawan";
								echo $row3["status"]."</b>";
								echo ", Fakultas : Teknologi Informasi";
						?>
						</div>
						<br>
				
						<div align="center">
							<strong><a id="lupapassword" href="http://nic.yarsi.ac.id/registrasi/chpass.php"><span id="hover">Ganti Password</span></a></strong>
						</div>
						
						<h4 align="center"><strong>Ketentuan-ketentuan yang berkaitan dengan hal cuti yaitu :</strong></h4>
						<div>
							<?php 
									}
								}
								$objGrid -> ajax('silent'); //disabled online editing
								$objGrid -> grid(); 
								$objGrid -> desconectar(); 
							?>
						</div>
			  </div>
    </div>
</div>
</body>

<?php
}
} else {
?>
	<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistem Informasi Cuti</title>
<link rel="stylesheet" href="CSS/layout.css" type="text/css" media="screen" />
</head>
<body>

<?php
	include('Config/config.php');

	$mydate = getdate(date("U"));
	$date1 = "$mydate[year]-$mydate[mon]-$mydate[mday]";
	$year = "$mydate[year]";
	$day = (int)"$mydate[mday]";
	$month = (int)"$mydate[mon]";
	
	//echo $day." ".$month."<br>";

	$resultdb = mysql_query("SELECT * FROM dosen_pegawai ORDER BY tahun_masuk DESC");
	while ($row = mysql_fetch_array($resultdb)) {
		$a = $row['id_dosen_pegawai'];
		$b = $row['waktu_cuti'];
		
		$date2 = date('Y-m-d', strtotime($row['tahun_masuk']));
		$no_year = date('m-d', strtotime($row['tahun_masuk']));
		$group = $year."-".$no_year;
		$day2 = (int)date('d', strtotime($row['tahun_masuk']));
		$month2 = (int)date('m', strtotime($row['tahun_masuk']));
		
		//echo $day2." ".$month2."<br>";
		
		$date1_c_1 = date_create($group);
		$date2_c_1 = date_create($date2);
		$diff1 = date_diff($date2_c_1,$date1_c_1); // sisa harapan
		
		$date1_c = date_create($date1);
		$date2_c = date_create($date2);
		$diff2 = date_diff($date2_c,$date1_c); // sisa sekarang
		
		if ($diff2->format("%a") < 365) {
			mysql_query("UPDATE dosen_pegawai SET waktu_cuti = 0 WHERE id_dosen_pegawai = '$a'");
		}
		else if (($day == $day2) && ($month == $month2)) {
			mysql_query("UPDATE dosen_pegawai SET waktu_cuti = 12 WHERE id_dosen_pegawai = '$a'");
		}
	}
?>

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
        
		<?php
			if (isset($_SESSION['username']) || !empty($_SESSION['username'])) {
		?>
				
			<div id="login2">
				<div style="padding:0px;overflow:auto;width:830px;height:322px;solid grey" >
						<div style = "margin-left:20px; margin-top:10px; width:800px; font-size:9pt; padding-top:5px; padding-bottom:5px;">
							<?php
								$mydate = getdate(date("U"));
								$hari = "$mydate[weekday]";
								if ($hari == "Sunday")
									$hari = "Minggu";
								elseif ($hari == "Monday")
									$hari = "Senin";
								elseif ($hari == "Tuesday")
									$hari = "Selasa";
								elseif ($hari == "Wednesday")
									$hari = "Rabu";
								elseif ($hari == "Thursday")
									$hari = "Kamis";
								elseif ($hari == "Friday")
									$hari = "Jum'at";
								elseif ($hari == "Saturday")
									$hari = "Sabtu";
								
								date_default_timezone_set('Asia/Jakarta');
								$timezone = date('H:i:s');
								
								$date1 = $hari. ", $mydate[mday] $mydate[month] $mydate[year] ";
								echo $date1 . $timezone . ' WIB | Tahun Akademik 2014/2015';
						?>
						</div>
						<div style = "margin-left:20px; width:800px; font-size:9pt; padding-top:5px; padding-bottom:5px;"><b>
						<?php
								echo $row["nama"];
								echo $row2["nama"];
								echo $row3["nama"];
								echo " (";
								echo $row["NIK"];
								echo $row2["NIK"];
								echo $row3["id_admin_tatausaha"];
								echo ")";
						?>
						</b>
						<?php
								echo "- Level User : ";
								echo "<b>".$row["status"];
								if ($row2["status"] == "1" || $row2["status"] == "2")
									echo "dosen";
								elseif ($row2["status"] == "3")
									echo "karyawan";
								echo $row3["status"]."</b>";
								echo ", Fakultas : Teknologi Informasi";
						?>
						</div>
						<br>
				
						<div align="center">
							<strong><a id="lupapassword" href="http://nic.yarsi.ac.id/registrasi/chpass.php"><span id="hover">Ganti Password</span></a></strong>
						</div>
						
						<h4 align="center"><strong>Ketentuan-ketentuan yang berkaitan dengan hal cuti yaitu :</strong></h4>
						<p align="justify" style = "padding-left:10px; padding-right:10px;">
							<?php
								include('Config/config.php');

								$resultdb = mysql_query("SELECT * FROM informasi_cuti");
								while ($row = mysql_fetch_array($resultdb)) {
									echo $row["syarat_cuti"] . "<br>";
								}
							?>
						</p>
			  </div>
			  
		<?php
			} else {
		?>
		
		<div id="login">
    		<div id="form">
        <strong>Form Login</strong>
        	</div>
        <div id="input">
        	<div id="paddinglogin">
            	<div id="ukuran">
                <form action="Config/otentikasi.php" method="post">
        <h4 align="center">User Name :</h4>
        	</div>
            	</div>
        	<div id="paddinglogin">
        <input type="text" name="username" id="username" size="30"/>
        	</div>
        	<div id="paddinglogin">
            	<div id="ukuran">
        <h4 align="center">Password  :</h4>
        	</div>
            	</div>
        	<div id="paddinglogin">        
            <input name="password" type="password" id="password" size="30"/><br /><br />
        	</div>
        	<div id="paddinglogin">
            	<div id="ukuran">
        <input type="submit" name="submit" value="Login" />
        	</div>
            <?php
				if(!empty($_GET['error'])){
					if($_GET['error'] == 1){?>
                   	<script>
					alert("Please check your username and password");
					</script>
                    <?php
					}
				}?>
            </form>
            	</div>
        	<div id="paddinglogin">
				<br /><br /><strong><a id="lupapassword" href="http://nic.yarsi.ac.id/registrasi/chpass.php?from_sisakad=1"><span id="hover">Lupa Password ?</span></a></strong>
        	</div>
        </div>
    	</div>
		
		<?php
			}
		?>
			
    </div>
</div>
</body>
<?php
	include("copyright.php");
}
?>