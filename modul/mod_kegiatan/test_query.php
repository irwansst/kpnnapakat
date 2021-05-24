<?php
include "../../config/koneksi.php";
$tampil	= mysql_query("SELECT * from rjabatan");

   while ($r=mysql_fetch_array($tampil)){
   		echo "$r[kode] <br />";

    }


?>