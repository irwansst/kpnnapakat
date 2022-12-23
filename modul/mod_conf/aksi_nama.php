<?php
session_start();
error_reporting(0);
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    header('location:../../logout.php');
}
else{
include "../../config/koneksi.php";

$op=$_GET[op];
$act=$_GET[act];

if ($op=='nama' AND $act=='update'){
    mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE nama SET nama	= '$_POST[nama]',
                                 alamat = '$_POST[alamat]',
                                 telp   = '$_POST[telp]',  
                                 email  = '$_POST[email]',  
                                 web    = '$_POST[web]'  
                           WHERE id_nama = '$_POST[id]'");
  }
  header('location:nama.php');
}
?>
