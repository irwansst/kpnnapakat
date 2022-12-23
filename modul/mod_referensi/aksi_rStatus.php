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

if ($op=='rStatus' AND $act=='input'){
	$date	= date("Y-m-d");
	mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO rstatus(
									id,
									status) 
					                VALUES(
									'$_POST[kodeStatus]',
									'$_POST[urStatus]'
									)");
	header('location:rStatus.php');
}
elseif ($op=='rStatus' AND $act=='update'){
  mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE rstatus SET 
								 id	= '$_POST[kodeStatus]',
								 Status	= '$_POST[urStatus]'
								 WHERE id  = '$_POST[kodeStatus]'");
  header('location:rStatus.php');
}

//MENGHAPUS DATA
elseif ($op=='rStatus' AND $act=='delete'){
  mysqli_query($GLOBALS["___mysqli_ston"], "DELETE from rStatus WHERE id   = '$_POST[kodeStatus]'");
  header('location:rStatus.php');
}


//akhir dari line
}
?>
