<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../plugin/var.php";
   
    echo "<h1>Laporan SURAT keputusan</h1>
			<div class='line'></div>
			<div class='box'>";
	echo "
		  <b>LAPORAN SURAT KEPUTUSAN HARI INI</b><br>
		  <a href=pdf_keputusan_sekarang.php target=_blank class=button>Proses laporan</a> 
		  
		  <form method=POST action='pdf_perintah.php' target=_blank>
          <br><br><b>LAPORAN SURAT KEPUTUSAN PER PERIODE</b><br>
		  <table>
		  <tr>
		  <td><label><span>DARI TANGGAL</span>
		  <input type='text' name='tgl1' size='10' id=datepicker style='text-align:center;'></label></td>
		  <td><label><span>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S.D. TANGGAL</span>
		  <input type='text' name='tgl2' size='10' id=datepicker1 style='text-align:center;'></label></td>
		  </tr>
		  </table>
		  <br>
		  <input type=submit class=button value='Proses Laporan'></form></div>";
}
?>

