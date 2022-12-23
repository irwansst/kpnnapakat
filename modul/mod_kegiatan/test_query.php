<?php
include "../../config/koneksi.php";
$tampil	= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from rjabatan");

   while ($r=mysqli_fetch_array($tampil)){
   		echo "$r[kode] <br />";

    }


?>