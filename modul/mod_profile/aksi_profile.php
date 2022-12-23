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
	mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO profile(
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

  mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE one_users SET
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

//Upload FOTO
elseif ($op=='profile' AND $act=='uploadpics'){
  //$tglnow = date('Y-m-d H:i:s');
    if(isset($_POST["uploadfoto"])) {

        //$kdsatker = $_POST['kdsatker'];
        //$thang = $_SESSION[periode];
        //$bulan = $_POST['bulan'];
        //$revisi = $_POST['revisi'];
        $nmadk = $_SESSION[namauser];
        $ekstensi_diperbolehkan = array('jpg');
        //$nama    = $_FILES['fileup']['name'];
        $x = explode('.', $_FILES['foto']['name']);
        $ekstensi = strtolower(end($x));
        $file = $nmadk.'.'.$ekstensi;
        $namafile = $_FILES['foto']['name'];
        $ukuran = $_FILES['foto']['size'];
        $file_tmp = $_FILES['foto']['tmp_name'];
          if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            if($ukuran > 2097152){
              echo "UKURAN FILE TERLALU BESAR!";
              echo "<br/><br/>";
              echo "<a href='http://kppnbandaaceh.id/moonraker/show.php?op=elpj'>Kembali</a>";
              echo "<br/>ukuran ".$ukuran;
              }
            else{
              move_uploaded_file($file_tmp, '../../photos/'.$file);
              /*$query    = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE one_elpj SET
                fileba = '$file',
                timestamp = '$tglnow'
                WHERE id	= '$_POST[id]' ");*/

              echo "FILE BERHASIL DI UPLOAD!";
              echo "<br/><br/>";
              echo "AGAR FOTO TERUPDATE, CLEAR BROWSING DATA > CACHED AND IMAGES PADA BROWSER!";
              echo "<br/><br/>";
              echo "<a href='http://kppnbandaaceh.id/moonraker/show.php?op=profile'>Kembali</a>";
              echo "<br/>ukuran ".$ukuran;
              echo "<br/>".$_POST['id'];
              }
            }else{
              echo "EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN!";
              echo "<br/><br/>";
              echo "<a href='http://kppnbandaaceh.id/moonraker/show.php?op=profile'>Kembali</a>";
            }
          }
          else{
            echo "GAGAL UPLOAD";
            echo "<br/><br/>";
            echo "<a href='http://kppnbandaaceh.id/moonraker/show.php?op=profile'>Kembali</a>";
          }
        }

// MENGHAPUS DATA
elseif ($op=='profile' AND $act=='delete'){
  mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM profile WHERE id='$_GET[id]' ");
	header('location:../../show.php?op='.$op);
}
//

//akhir dari line
}
?>
