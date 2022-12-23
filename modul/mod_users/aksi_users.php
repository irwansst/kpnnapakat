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

if ($op=='users' AND $act=='input'){
	$pass = md5($_POST[password]);
	mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO kpn_users(
									username,
									password,
									nama_lengkap,
									email,
                  no_telp,
                  kd_satker,
                  kd_kppn,
									level,
									blokir
                  )
									VALUES(
									'$_POST[username]',
									'$pass',
									'$_POST[nama_lengkap]',
									'$_POST[email]',
									'$_POST[no_telp]',
                  '$_POST[kd_satker]',
                  '$_POST[kd_kppn]',
									'$_POST[level]',
									'$_POST[blokir]'
									)");

	header('location:../../show.php?op='.$op);
}
elseif ($op=='users' AND $act=='update'){

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE kpn_users SET
                username    = '$_POST[username]',  
                 nama_lengkap	= '$_POST[nama_lengkap]',
								 email			= '$_POST[email]',
								 no_telp		= '$_POST[no_telp]',
                 kd_satker		= '$_POST[kd_satker]',
                 kd_kppn		= '$_POST[kd_kppn]',
								 level			= '$_POST[level]',
								 blokir			= '$_POST[blokir]'
								 WHERE id		= '$_POST[id]'");

  header('location:../../show.php?op='.$op);
}

// MENGHAPUS DATA
elseif ($op=='users' AND $act=='delete'){
  mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM kpn_users WHERE id='$_GET[id]' ");
	header('location:../../show.php?op='.$op);
}

//reset Password
elseif ($op=='users' AND $act=='reset'){
  $pass = md5(trim($_POST[password]));
  mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE kpn_users SET
  								 password			= '$pass'
  								 WHERE id		= '$_POST[id]'");
	header('location:../../show.php?op='.$op);
}

//akhir dari line
}
?>
