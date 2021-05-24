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

if ($op=='log' AND $act=='input'){
	$date	= date("Y-m-d");
	mysql_query("INSERT INTO log(
									id,
									user,
									kegiatan,
									iku,
									ket,
									periode)
									VALUES(
									'',
									'$_SESSION[namauser]',
									'$_POST[kegiatan]',
									'$_POST[iku]',
									'$_POST[ket]',
									'$_SESSION[periode]'
									)");
	header('location:../../show.php?op='.$op);
}
elseif ($op=='log' AND $act=='update'){
  mysql_query("UPDATE log SET 
								 waktu		= '$_POST[waktu]',
								 kegiatan	= '$_POST[kegiatan]',
								 iku			= '$_POST[iku]',
								 ket			= '$_POST[ket]'
								 WHERE id	= '$_POST[id]'");
  header('location:../../show.php?op='.$op);
}

// MENGHAPUS DATA
elseif ($op=='log' AND $act=='delete'){
  mysql_query("DELETE FROM log WHERE id='$_GET[id]' ");
	header('location:../../show.php?op='.$op);
}
//

//akhir dari line
}
?>
