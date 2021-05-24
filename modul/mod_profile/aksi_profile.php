<?php
session_start();
$timezone = "Asia/Jakarta";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus profilein <br>";
  echo "<a href=../../index.php><b>profileIN</b></a></center>";
}
else{

include "../../config/koneksi.php";
include "../../config/fungsi_seo.php";
include "../../config/library.php";
include "../../config/fungsi_indotgl.php";

$op		=$_GET[op];  $act	=$_GET[act];

if ($op=='profile' AND $act=='input'){
	$date	= date("Y-m-d");
	mysql_query("INSERT INTO profile(
									id,
									user,
									kegiatan,
									iku,
									ket,
									periode)
									VALUES(
									'',
									'$_SESSION[namauser]',
									'$_POST[kegiatan]',
									'$_POST[iku]',
									'$_POST[ket]',
									'$_SESSION[periode]'
									)");
	header('location:../../show.php?op='.$op);
}
elseif ($op=='profile' AND $act=='update'){
  
  mysql_query("UPDATE pegawai SET 
  								 gol		= '$_POST[gol]',
								 es2		= '$_POST[es2]',
								 es3		= '$_POST[es3]',
								 es4		= '$_POST[es4]',
								 jabatan	= '$_POST[jabatan]'
								 WHERE id	= '$_POST[id]'");
  header('location:../../show.php?op='.$op);
}

// MENGHAPUS DATA
elseif ($op=='profile' AND $act=='delete'){
  mysql_query("DELETE FROM profile WHERE id='$_GET[id]' ");
	header('location:../../show.php?op='.$op);
}
//

//akhir dari line
}
?>
