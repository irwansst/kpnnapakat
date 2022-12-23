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

if ($op=='kegiatan' AND $act=='input'){
	$date	= date("Y-m-d");
	mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO kegiatan(
									kegiatan,
									dasar,
									tgl_mulai,
									tgl_akhir,
									bidang,
									periode) 
					                VALUES(
									'$_POST[vkegiatan]',
									'$_POST[vdasar]',
									'$_POST[vmulai]',
									'$_POST[vakhir]',
									'$_POST[vbidang]',
									'$_SESSION[periode]'
									)");
	header('location:../../show.php?op='.$op);
}
elseif ($op=='kegiatan' AND $act=='update'){
  mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE kegiatan SET 
								 kegiatan	= '$_POST[vkegiatan]',
								 dasar 		= '$_POST[vdasar]',
								 tgl_mulai	= '$_POST[vmulai]',
								 tgl_akhir	= '$_POST[vakhir]'						 
								 WHERE id   = '$_POST[id]'");
  header('location:../../show.php?op='.$op);
}

elseif ($op=='kegiatan' AND $act=='output'){
  mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE kegiatan SET 
								 output	= '$_POST[voutput]'						 				 
								 WHERE id   = '$_POST[id]'");
  header('location:../../show.php?op='.$op);
}

elseif ($op=='kegiatan' AND $act=='upload'){
  		if(isset($_POST['btn-upload']))
			{
				$folder="../../arsip/";
				$img = $_FILES['img']['name'];
				$img_loc = $_FILES['img']['tmp_name'];
				$nmfile=$img;
		
				if(move_uploaded_file($img_loc,$folder.$img))
				{
					echo "<script>alert('Upload Data Sukses!!!');</script>";
					mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE kegiatan SET nfile = '$nmfile' WHERE id_kegiatan='$_POST[id]'");
  					header('location:../../show.php?op='.$op);
				}else{
					echo "<script>alert('Upload Gagal');</script>";
				}
			}
		}
	
//MENGHAPUS DATA
}