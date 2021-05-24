<?php
//error_reporting(0);
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

	if ($op=='sArsip' AND $act=='input'){
		$date	= date("Y-m-d");
						
			//membuat nomor urut arsip
			$q = mysql_query("select MAX(nUrut) as nourut from sarsip where periode='$_SESSION[periode]' AND bidang='$_POST[bidang]' ");
			$r = mysql_fetch_array($q);
			if($r){
					$nurut=$r[nourut]+1;
			}else{
					$nurut=1;
			}
			
			//membuat nomor arsip
			$noarc = $_SESSION[periode].$_POST[bidang].sprintf("%05d", $nurut);
			//memasukkan data ke tabel
			mysql_query("INSERT INTO sarsip(
									tArsip,
									jKlasifikasi,
									jArsip,
									inaktif,
									bidang,
									rak,
									box,
									folder,
									baris,
									kolom,
									file,
									keterangan,
									nArsip,
									periode,
									nUrut)
					                VALUES(
									'$date',
									'$_POST[jklasifikasi]',
									'$_POST[jarsip]',
									'$_POST[inaktif]',
									'$_POST[bidang]',
									'$_POST[nrak]',
									'$_POST[nbox]',
									'$_POST[nfolder]',
									'$_POST[nbaris]',
									'$_POST[nkolom]',
									'$_POST[nmFile]',
									'$_POST[ket]',
									'$noarc',
									'$_SESSION[periode]',
									'$nurut')");
		//menambahkan nomor arsip ke surat masuk									
		mysql_query("UPDATE skeluar SET nArsip = '$noarc' WHERE id_sKeluar='$_POST[id]'");
		
			//=========================================
			//akhir dari query mysql
			//==========================================
																	
			header('location:../../show.php?op=sArsip');
			
			
			} 
	
	
//MENGHAPUS DATA
}
?>
