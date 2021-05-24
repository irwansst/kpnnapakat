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

if ($op=='rArsip' AND $act=='input'){
	$date	= date("Y-m-d");
	mysql_query("INSERT INTO rarsip(
									id,
									jnsarsip) 
					                VALUES(
									'$_POST[kodeJnsArsip]',
									'$_POST[urJnsArsip]'
									)");
	header('location:rArsip.php');
}
elseif ($op=='rArsip' AND $act=='update'){
  mysql_query("UPDATE rarsip SET 
								 id	= '$_POST[kodeJnsArsip]',
								 jnsarsip	= '$_POST[urJnsArsip]'
								 WHERE id  = '$_POST[kodeJnsArsip]'");
  header('location:rArsip.php');
}

//MENGHAPUS DATA
elseif ($op=='rArsip' AND $act=='delete'){
  mysql_query("DELETE from rarsip WHERE id   = '$_POST[kodeJnsArsip]'");
  header('location:rArsip.php');
}


//akhir dari line
}
?>
