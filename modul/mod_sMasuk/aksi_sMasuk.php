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

if ($op=='sMasuk' AND $act=='input'){
	$date	= date("Y-m-d");
	mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO smasuk(
									nAgenda,
									jSurat,
									uSifat,
									nSurat,
									tSurat,
									jLampiran,
									tMasuk,
									dari,
									hal,
									dispo,
									status,
									periode) 
					                VALUES(
									'$_POST[nagenda]',
									'$_POST[jsurat]',
									'$_POST[usifat]',
									'$_POST[nsurat]',
									'$_POST[tsurat]',
									'$_POST[jlampiran]',
									'$date',
									'$_POST[dari]',
									'$_POST[hal]',
									'$_POST[dispo]',
									'$_POST[status]',
									'$_SESSION[periode]'
									)");
	header('location:../../show.php?op='.$op);
}
elseif ($op=='sMasuk' AND $act=='update'){
  mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE smasuk SET 
								 nAgenda	= '$_POST[nagenda]',
								 jSurat		= '$_POST[jsurat]',
								 tMasuk		= '$_POST[tmasuk]',
								 usifat		= '$_POST[usifat]',
								 nSurat  	= '$_POST[nsurat]',
								 tSurat  	= '$_POST[tsurat]',
								 jLampiran	= '$_POST[jlampiran]',
                                 dari   	= '$_POST[dari]',
                                 hal   		= '$_POST[hal]',
                                 dispo 		= '$_POST[dispo]',
                                 status    	= '$_POST[status]'
								 WHERE id_sMasuk   = '$_POST[id]'");
  header('location:../../show.php?op='.$op);
}

elseif ($op=='sMasuk' AND $act=='upload'){
  		if(isset($_POST['btn-upload']))
			{
				$folder="../../arsip/";
				$img = $_FILES['img']['name'];
				$img_loc = $_FILES['img']['tmp_name'];
				$nmfile=$img;
		
				if(move_uploaded_file($img_loc,$folder.$img))
				{
					echo "<script>alert('Upload Data Sukses!!!');</script>";
					mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE smasuk SET nfile = '$nmfile' WHERE id_sMasuk='$_POST[id]'");
  					header('location:../../show.php?op='.$op);
				}else{
					echo "<script>alert('Upload Gagal');</script>";
				}
			}
		}
	
//MENGHAPUS DATA
}