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

if ($op=='bank' AND $act=='input'){
	mysql_query("INSERT INTO kpn_bank(
									kode,
									nama_bank)
									VALUES(
									'$_POST[kode]',								
									'$_POST[nama_bank]'
									)");
	header('location:../../show.php?op='.$op);
}
elseif ($op=='bank' AND $act=='update'){
mysql_query("UPDATE kpn_bank SET 
								 kode			= '$_POST[kode]',
								 nama_bank	= '$_POST[nama_bank]'
								 WHERE id		= '$_POST[id]'");
  header('location:../../show.php?op='.$op);
}

// MENGHAPUS DATA
elseif ($op=='bank' AND $act=='delete'){
  mysql_query("DELETE FROM kpn_bank WHERE id='$_GET[id]' ");
	header('location:../../show.php?op='.$op);
}
//

//akhir dari line
}
?>
