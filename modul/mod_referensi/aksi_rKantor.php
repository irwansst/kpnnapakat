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

if ($op=='rKantor' AND $act=='input'){
	$date	= date("Y-m-d");
	mysql_query("INSERT INTO rkantor(
									id,
									kantor,
									alamat,
									telpon,
									faks,
									pos,
									email) 
					                VALUES(
									'',
									'$_POST[nKantor]',
									'$_POST[nAlamat]',
									'$_POST[nTelp]',
									'$_POST[nFaks]',
									'$_POST[nPos]',
									'$_POST[nEmail]'
									)");
	header('location:rKantor.php');
}

elseif ($op=='rKantor' AND $act=='update'){
  mysql_query("UPDATE rkantor SET 
								 kantor	= '$_POST[nKantor]',
								 alamat	= '$_POST[nAlamat]',
								 telpon	= '$_POST[nTelp]',
								 faks	= '$_POST[nFaks]',
								 pos	= '$_POST[nPos]',
								 email	= '$_POST[nEmail]'
								 WHERE id  = '$_POST[id]'");
  header('location:rKantor.php');
}

//MENGHAPUS DATA
elseif ($op=='rKantor' AND $act=='delete'){
  mysql_query("DELETE from rkantor WHERE id   = '$_GET[id]'");
  header('location:rKantor.php');
}


//akhir dari line
}
?>
