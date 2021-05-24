<?php
session_start();
$timezone = "Asia/Jakarta";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

include "../../config/koneksi.php";
include "../../config/fungsi_seo.php";
include "../../config/library.php";
include "../../config/fungsi_indotgl.php";

$op		=$_GET[op];  $act	=$_GET[act];

if ($op=='unit' AND $act=='input'){
	mysql_query("INSERT INTO kpn_unit(
									kode,
									nama_unit)
									VALUES(
									'$_POST[kode]',								
									'$_POST[nama_unit]'
									)");
	header('location:../../show.php?op='.$op);
}
elseif ($op=='unit' AND $act=='update'){
mysql_query("UPDATE kpn_unit SET 
								 kode			= '$_POST[kode]',
								 nama_unit	= '$_POST[nama_unit]'
								 WHERE id		= '$_POST[id]'");
  header('location:../../show.php?op='.$op);
}

// MENGHAPUS DATA
elseif ($op=='unit' AND $act=='delete'){
  mysql_query("DELETE FROM kpn_unit WHERE id='$_GET[id]' ");
	header('location:../../show.php?op='.$op);
}
//

//akhir dari line
}
?>
