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
	mysql_query("INSERT INTO kpn_users(
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

//menginput ke dalam tabel anggota
$qinsa=mysql_query("SELECT * FROM kpn_users WHERE username = '$_POST[username]' ");
$insa = mysql_fetch_array($qinsa);

mysql_query("INSERT INTO kpn_anggota(
	id,
	nip,
	nama_lengkap,
	tempat_lhr,
	tgl_lhr,
	alamat,
	email,
	no_telp,
	unit,
	bank,
	norek,
	tgl_daftar,
	aktif)
	VALUES(
	'$insa[id]',
	'$insa[username]',								
	'$insa[nama_lengkap]',
	'',
	'',
	'',
	'$insa[email]',
	'$insa[no_telp]',
	'',
	'',
	'',
	'',
	'Y'
	)"
	);

	header('location:../../show.php?op='.$op);
}
elseif ($op=='users' AND $act=='update'){

//updating table kpn_users
	$pass = md5($_POST[password]);
mysql_query("UPDATE kpn_users SET 
								 username		= '$_POST[username]',
								 password		= '$pass',
								 nama_lengkap	= '$_POST[nama_lengkap]',
								 email			= '$_POST[email]',
								 no_telp		= '$_POST[no_telp]',
								 level			= '$_POST[level]',
								 blokir			= '$_POST[blokir]'
								 WHERE id		= '$_POST[id]'");

//updating table kpn_anggota
mysql_query("UPDATE kpn_anggota SET 
								 
								 id				= '$_POST[id]',
								 nip			= '$_POST[username]',
								 nama_lengkap	= '$_POST[nama_lengkap]',
								 email			= '$_POST[email]',
								 no_telp		= '$_POST[no_telp]'
								 WHERE id		= '$_POST[id]'");

  header('location:../../show.php?op='.$op);
}

// MENGHAPUS DATA
elseif ($op=='users' AND $act=='delete'){
  mysql_query("DELETE FROM kpn_users WHERE id='$_GET[id]' ");
	header('location:../../show.php?op='.$op);
}
//

//akhir dari line
}
?>
