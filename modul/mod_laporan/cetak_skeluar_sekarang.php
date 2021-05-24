<?php

error_reporting(0);

$timezone = "Asia/Jakarta";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);

session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
error_reporting(0);
include "../../plugin/mpdf/mpdf.php";
include "../../config/koneksi.php";
$mpdf = new mPDF('utf-8','A4');

ob_start();

$t 	= (date("Y-m-d"));
$no = 1;
$kue=mysql_query("SELECT jSurat AS jenis, COUNT(nAgenda) AS jumlah FROM sKeluar where tKeluar='$t' GROUP BY jSurat ");
$sql=mysql_query("SELECT * FROM skeluar where tKeluar='$t' ");
?>

<html>
<head><title></title>
	<style type="text/css">
	p{
		text-align:center;
		font-size:12px;
		font-weight:bold;
		font-family:Arial, Helvetica, sans-serif;
		color:#000066;
	}
	body{
		font-size:10px;
		font-family:Arial, Helvetica, sans-serif;	
	}
	
	table{
		border-style:solid;
		border-width:thin;
		border-spacing:inherit;
	}
	
	tr{
		text-align:center;
		font-weight:bold;
	}
	
	td{


	}
	
	
	
	</style>
</head>
</body>

<?php
echo '<p>DAFTAR SURAT KELUAR PER TANGGAL: '.$t.'</p>
<table border=1 repeat_header=1 width=100%>
<thead>
<tr>
<th style="text-align:center; font-weight:bold;">No.</td>
<th style="text-align:center; font-weight:bold;">Jenis</td>
<th style="text-align:center; font-weight:bold;">Agenda</td>
<th style="text-align:center; font-weight:bold;">Kontrol</td>
<th style="text-align:center; font-weight:bold;" width=10px>Sifat</td>
<th style="text-align:center; font-weight:bold;">Lampiran</td>
<th style="text-align:center; font-weight:bold;">Penerbit</td>
<th style="text-align:center; font-weight:bold;" width=200px>Kepada</td>
<th style="text-align:center; font-weight:bold;">Perihal</td>
<th style="text-align:center; font-weight:bold;">Keterangan</td>
</tr>
</thead>';


while($r=mysql_fetch_assoc($sql)){
	$noagd=sprintf("%06d", $r[nAgenda]);
	echo '<tr>
	<td align=right>'.$no.'</td>
	<td>'.$r[jSurat].'</td>
	<td>'.$noagd.'</td>
	<td>'.$r[nKontrol].''.$r[periode].'</td>
	<td>'.$r[uSifat].'</td>
	<td>'.$r[jLampiran].'</td>
	<td>'.$r[penerbit].'</td>
	<td>'.$r[kepada].'</td>
	<td>'.$r[hal].'</td>
	<td>'.$r[ket].'</td>	
	</tr>';
	$no++;
}
?>
</table>
<pagebreak />
<?php
echo '<p>REKAPITULASI SURAT KELUAR PER: '.$t.' </p>
<table border=1 repeat_header=1>
<thead>
<tr>
<th style="text-align:center; font-weight:bold;">No.</td>
<th style="text-align:center; font-weight:bold;">Jenis Surat</td>
<th style="text-align:center; font-weight:bold;">Jumlah Surat</td>
</tr>
</thead>';

$no=1;
while($h=mysql_fetch_assoc($kue)){
	echo '<tr>
	<td align=right>'.$no.'</td>
	<td>'.$h[jenis].'</td>
	<td align=right>'.$h[jumlah].' buah</td>	
	</tr>';
	$no++;
}
?>
</table>
</body>
</html>	

<?php
$html	= ob_get_contents();
ob_end_clean();
$mpdf->setFooter('Generated by: Aplikasi SPARTAN || Hal:{PAGENO}');
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf",'I');
exit;
}
?>
