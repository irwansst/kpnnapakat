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

if ($op=='anggota' AND $act=='input'){
	$pass = md5($_POST[password]);
	mysql_query("INSERT INTO kpn_anggota(
									username,
									password,
									nama_lengkap,
									email,
									no_telp,
									level,
									blokir)
									VALUES(
									'$_POST[username]',								
									'$pass',
									'$_POST[nama_lengkap]',
									'$_POST[email]',
									'$_POST[no_telp]',
									'$_POST[level]',
									'$_POST[blokir]'
									)");

	header('location:../../show.php?op='.$op);
}
elseif ($op=='anggota' AND $act=='update'){

//updating table kpn_users
mysql_query("UPDATE kpn_anggota SET 
								 tempat_lhr		= '$_POST[tempat_lhr]',
								 tgl_lhr		= '$_POST[tgl_lhr]',
								 alamat			= '$_POST[alamat]',
								 unit			= '$_POST[unit]',
								 bank			= '$_POST[bank]',
								 norek			= '$_POST[norek]',
								 tgl_daftar		= '$_POST[tgl_daftar]',
								 aktif			= '$_POST[aktif]'
								 WHERE id		= '$_POST[id]'");

  header('location:../../show.php?op='.$op);
}

// MENGHAPUS DATA
elseif ($op=='anggota' AND $act=='delete'){
  mysql_query("DELETE FROM kpn_anggota WHERE id='$_GET[id]' ");
	header('location:../../show.php?op='.$op);
}
//

//akhir dari line
}
?>
