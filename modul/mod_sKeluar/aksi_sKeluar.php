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

if ($op=='sKeluar' AND $act=='input'){
	$date	= date("Y-m-d");
	
	//membuat nomor agenda surat keluar
	$q = mysqli_query($GLOBALS["___mysqli_ston"], "select MAX(nAgenda) as nAgenda from skeluar where jSurat='$_POST[jsurat]' and periode='$_SESSION[periode]'");
	$r = mysqli_fetch_array($q);
	if($r){
		$noagd=$r[nAgenda]+1;
	}else{
		$noagd=1;
	}
		
	mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO skeluar(
									tKeluar,
									nAgenda,
									jSurat,
									nKontrol,
									uSifat,
									jLampiran,
									penerbit,
									kepada,
									hal,
									ket,
									periode) 
					                VALUES(
									'$date',
									'$noagd',
									'$_POST[jsurat]',
									'$_POST[nkontrol]',
									'$_POST[usifat]',
									'$_POST[jlampiran]',
									'$_POST[penerbit]',
									'$_POST[kepada]',
									'$_POST[hal]',
									'$_POST[ket]',
									'$_SESSION[periode]'
									)");
	header('location:../../show.php?op='.$op);
}
elseif ($op=='sKeluar' AND $act=='update'){
  mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE skeluar SET 
								 tKeluar	= '$_POST[tkeluar]',
								 nAgenda	= '$_POST[nagenda]',
								 jSurat		= '$_POST[jsurat]',
								 nKontrol	= trim('$_POST[nkontrol]'),
								 uSifat		= '$_POST[usifat]',
								 jLampiran	= '$_POST[jlampiran]',
								 penerbit	= '$_POST[penerbit]',
								 kepada		= '$_POST[kepada]',
								 hal		= '$_POST[hal]',
								 ket		= '$_POST[ket]'
								 
 								 WHERE id_sKeluar   = '$_POST[id]'");
								 
  header('location:../../show.php?op='.$op);
}

elseif ($op=='sKeluar' AND $act=='upload'){
  		if(isset($_POST['btn-upload']))
			{
				$folder="../../arsip/";
				$img = $_FILES['img']['name'];
				$img_loc = $_FILES['img']['tmp_name'];
				$nmfile=$img;
		
				if(move_uploaded_file($img_loc,$folder.$img))
				{
					echo "<script>alert('Upload Data Sukses!!!');</script>";
					mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE skeluar SET nfile = '$nmfile' WHERE id_sKeluar='$_POST[id]'");
  					header('location:../../show.php?op='.$op);
				}else{
					echo "<script>alert('Upload Gagal');</script>";
				}
			}
		}


}
?>
