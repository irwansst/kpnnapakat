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

if ($op=='Jabatan' AND $act=='input'){
	$date	= date("Y-m-d");
	mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO rjabatan(
									id,
									kode,
									urbidang,
									jabatan,
									eselon,
									kontrol) 
					                VALUES(
									'',
									'$_POST[nKode]',
									'$_POST[urBidang]',
									'$_POST[urJabatan]',
									'$_POST[kdEselon]',
									'$_POST[nKontrol]'
									)");
	header('location:../../show.php?op='.$op);
}
elseif ($op=='Jabatan' AND $act=='update'){
  mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE rjabatan SET 
								 kode		= '$_POST[nKode]',
								 urbidang	= '$_POST[urBidang]',
								 jabatan	= '$_POST[urJabatan]',
								 eselon		= '$_POST[kdEselon]',
								 kontrol	= '$_POST[nKontrol]'
								 WHERE id	= '$_GET[id]'");
  header('location:../../show.php?op='.$op);
}

//MENGHAPUS DATA
elseif ($op=='Jabatan' AND $act=='delete'){
  mysqli_query($GLOBALS["___mysqli_ston"], "DELETE from rjabatan WHERE id   = '$_GET[id]'");
  header('location:../../show.php?op='.$op);
}


//akhir dari line
}
?>
