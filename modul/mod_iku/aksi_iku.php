<?php
session_start();
$timezone = "Asia/Jakarta";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus ikuin <br>";
  echo "<a href=../../index.php><b>ikuIN</b></a></center>";
}
else{

include "../../config/koneksi.php";
include "../../config/fungsi_seo.php";
include "../../config/library.php";
include "../../config/fungsi_indotgl.php";

$op		=$_GET[op];  $act	=$_GET[act];

if ($op=='iku' AND $act=='input'){
	$date	= date("Y-m-d");
	mysql_query("INSERT INTO iku(
									id,
									user,
									iku,
									periode)
									VALUES(
									'',
									'$_SESSION[namauser]',
									'$_POST[iku]',
									'$_SESSION[periode]'
									)");
	header('location:../../show.php?op='.$op);
}
elseif ($op=='iku' AND $act=='update'){
  mysql_query("UPDATE riku SET 
								 kode		= '$_POST[nKode]',
								 urbidang	= '$_POST[urBidang]',
								 iku	= '$_POST[uriku]',
								 eselon		= '$_POST[kdEselon]',
								 kontrol	= '$_POST[nKontrol]'
								 WHERE id	= '$_GET[id]'");
  header('location:../../show.php?op='.$op);
}

// MENGHAPUS DATA
elseif ($op=='iku' AND $act=='delete'){
  mysql_query("DELETE FROM iku WHERE id='$_GET[id]' ");
	header('location:../../show.php?op='.$op);
}
//

//akhir dari line
}
?>
