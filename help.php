<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php session_start();?>
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
             <h4 align="center"><strong>Sistem Cuti Fakultas Teknologi Informasi</strong></h4>
            		<p align="justify">
					&nbsp;
					
					Sistem Cuti Fakultas Teknologi Informasi Universitas Yarsi Memiliki Beberapa fitur yaitu :</br>
              		&nbsp;&nbsp;
					
					- Dapat mengisi cuti secara online</br>
              		&nbsp;&nbsp;
					
					- Dapat mengajukan cuti secara online</br>
              		&nbsp;&nbsp;
					
					- Dapat berinteraksi dengan Dosen, Dekan dan Tata usaha secara online</br></br>
              		&nbsp;
					
					Langkah-langkah mengisi cuti secara online sebagai berikut :</br>
              		&nbsp;&nbsp;
					
					- Login terlebih dahulu dengan mengisi username dan password</br>
                    &nbsp;&nbsp;
					
					- Setelah login, Klik menu cuti untuk mengajukan cuti</br>
                    &nbsp;&nbsp;
					
					- Isi form cuti yang telah di sediakan</br>
                    &nbsp;&nbsp;
					
					- Setalah mengisi maka data akan di berikan ke dekan untuk di persetujukan</p>  		
		  </div>
   	  </div>
    </div>
</div>
</body>
<?php
	include("copyright.php");
?>
</html>