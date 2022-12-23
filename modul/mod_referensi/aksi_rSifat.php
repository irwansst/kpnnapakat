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

if ($op=='rSifat' AND $act=='input'){
	$date	= date("Y-m-d");
	mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO rsifat(
									id,
									sifat) 
					                VALUES(
									'$_POST[kodeSifat]',
									'$_POST[urSifat]'
									)");
	header('location:rSifat.php');
}
elseif ($op=='rSifat' AND $act=='update'){
  mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE rsifat SET 
								 id	= '$_POST[kodeSifat]',
								 sifat	= '$_POST[urSifat]'
								 WHERE id  = '$_POST[kodeSifat]'");
  header('location:rSifat.php');
}

//MENGHAPUS DATA
elseif ($op=='rSifat' AND $act=='delete'){
  mysqli_query($GLOBALS["___mysqli_ston"], "DELETE from rsifat WHERE id   = '$_POST[kodeSifat]'");
  header('location:rSifat.php');
}


//akhir dari line
}
?>
