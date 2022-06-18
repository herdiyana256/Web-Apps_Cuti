<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
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
    		<div style="padding:10px;overflow:auto;width:800px;height:322px;solid grey; font-size:11pt;" >
              		<p align="justify">&nbsp;&nbsp;&nbsp;
					
					Sistem cuti fakultas Teknologi Informasi Universitas Yarsi berfungsi untuk mendaftar cuti secara
					&nbsp;
					online dan data-data cuti akan diorganisir untuk dosen dan karyawan yang berbeda dilingkungan
					&nbsp;
					FTI Universitas Yarsi.</p>
       		  
			  <p align="justify">&nbsp;&nbsp;&nbsp;
			  
			  Dengan adanya sistem cuti online diharapkan akan membantu dosen dan karyawan dalam 
			  &nbsp;
			  mengisi cuti data-data cuti akan dikelola secara terorganisir dan akan meminimalisir kesalahan 
			  &nbsp;
			  yang akan terjadi.</p>
              		
					<h4 align="center" class="style1">
					
					Sistem Cuti Fakultas Teknologi Informasi<br/><br/>
					
					Universitas Yarsi <br/><br/> dibangun oleh<br/><br/>
					
					Team WhyNot. 2015</h4>
		  </div>
   	  </div>
    </div>
</div>
</body>
<?php
	include("copyright.php");
?>
</html>