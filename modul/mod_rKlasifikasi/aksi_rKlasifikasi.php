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

if ($op=='rJenis' AND $act=='input'){
	$date	= date("Y-m-d");
	mysql_query("INSERT INTO jenis(
									kodejenis,
									urjenis) 
					                VALUES(
									'$_POST[kodejenis]',
									'$_POST[urjenis]'
									)");
	header('location:rJenis.php');
}
elseif ($op=='rJenis' AND $act=='update'){
  mysql_query("UPDATE rarsip SET 
								 id	= '$_POST[kodejenis]',
								 jnsarsip	= '$_POST[urjenis]'
								 WHERE id   = '$_POST[kodejenis]'");
  header('location:rJenis.php');
}

//MENGHAPUS DATA
elseif ($op=='rJenis' AND $act=='delete'){
  mysql_query("DELETE from jenis WHERE id   = '$_POST[id]'");
  header('location:rJenis.php');
}


//akhir dari line
}
?>
