<?php 
	include('Config/cek_login_admin.php');
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
	
	$objGrid -> searchby("id_dosen_pegawai,nama,NIK,email");
	
	//$objGrid -> linkparam("sess=".$_REQUEST["sess"]."&username=".$_REQUEST["username"]);	 
	
	$objGrid -> decimalDigits(2);
	
	$objGrid -> decimalPoint(",");
	
	/* ADOdb library must be included */
	include_once('adodb/adodb.inc.php');
	
	/* to use ADOdb is so simple as say true */
	$objGrid -> conectadb("localhost", "root", "", "cuti", true, "mysql");
	
	$objGrid -> tabla ("dosen_pegawai");

	$objGrid -> buttons(true,true,true,true);
	
	$objGrid -> keyfield("id_dosen_pegawai");

	$objGrid -> salt("Some Code4Stronger(Protection)");

	//$objGrid -> TituloGrid("phpMyDataGrid Sample page");

	//$objGrid -> FooterGrid("<div style='float:left'>&copy; 2007 Gurusistemas.com</div>");

	$objGrid -> datarows(12);
	
	$objGrid -> paginationmode('links');

	$objGrid -> orderby("tahun_masuk", "DESC");

	$objGrid -> noorderarrows();
	
	//$objGrid -> FormatColumn("active", "Active", 2, 2, 0,"30", "center", "check:No:Yes");  
	$objGrid -> FormatColumn("nama", "Nama", 120, 120, 0, "220", "left");
	$objGrid -> FormatColumn("NIK", "NIK", 30, 30, 0, "90", "center");
	$objGrid -> FormatColumn("unit_atau_fakultas", "Fakultas", 30, 30, 0, "105", "center");
	$objGrid -> FormatColumn("status", "Status", 15, 15, 0, "55", "center", "select:1_Dosen TI:2_Dosen IP:3_Karyawan");
	$objGrid -> FormatColumn("email", "Email", 50, 50, 0, "180", "left");
	$objGrid -> FormatColumn("no_tlp", "No Telepon", 30, 30, 0, "85", "center");
	$objGrid -> FormatColumn("tahun_masuk", "Tahun Masuk (tanggal/bulan/tahun) (contoh:10/7/2012)", 10, 10, 0, "85", "center", "date:dmy:/");
	$objGrid -> FormatColumn("waktu_cuti", "Sisa Cuti", 5, 5, 0, "50", "center");

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
        <div id="login2" style="width:830px;overflow:auto;height:322px;solid grey;">
    		<div style =" margin-top:2px;">
                <?php 
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
        
</html>