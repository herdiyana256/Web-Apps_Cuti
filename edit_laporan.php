<?php
	include("Config/config.php");

	$id_cuti = $_POST['id_cuti'];
	$update = $_POST['update'];

	$query = mysql_query("UPDATE form_cuti SET laporan = '$update' WHERE id_form_cuti = '$id_cuti'") or die(mysql_error());
		
	if ($query) {
		header('location:arsip_cuti.php');
	}
?>