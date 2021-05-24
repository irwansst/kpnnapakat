<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";

   
//menampilkan data dari database
$aksi="aksi_rKlasifikasi.php";

switch($_GET[act]){
  
  default:
  
    echo "<h1>REFERENSI KLASIFIKASI ARSIP</h1>";
    
	echo "<input type=button class='button' value='Tambah Data' onclick=location.href='?op=rKlasifikasi&act=tambahrKlasifikasi'><br><br>";
	
	echo "
	<div class='demo_jui'>
	<table cellpadding='0' cellspacing='0' border='0' class='display' id='example'>
		<thead>
			<tr>
				<th >Kode</th>
				<th >Uraian</th>
				<th >Unit</th>
				<th >Keamanan</th>
				<th >Dasar</th>
				<th >Akses</th>
				<th >Keterangan</th>
				<th width=100px>Lihat/<br>Ubah</th>
			</tr>
		</thead>
		<tbody>";
		
    $tampil	= mysql_query("SELECT * FROM rklasifikasi ORDER BY kode asc ");
    while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr>
			 <td align=left>$r[kode]</td>
			 <td align=left>$r[uraian]</td>
			 <td align=left>$r[unit]</td>
			 <td align=left>$r[keamanan]</td>
			 <td align=left>$r[dasar]</td>
			 <td align=left>$r[akses]</td>
			 <td align=left>$r[keterangan]</td>
             <td align=center>
			 <a href=?op=rKlasifikasi&act=editrKlasifikasi&id=$r[kode]><img class='masterTooltip'  src='images/edit.png' border='0' title='Ubah Data'></a>	
			 <a href=?op=rKlasifikasi&act=deleterKlasifikasi&id=$r[kode]><img class='masterTooltip'  src='images/delete.png' border='0' title='Hapus Data'></a>
	         </td>
			 </tr>";
    }	
		echo"</tbody></table></div><div class='spacer'></div>";
	
  break;

  
  case "tambahrKlasifikasi":
      echo "<h1>Tambah SURAT MASUK</h1>
			<div class='line'></div>
			<div class='box'>";
    echo "	
	        <form method=POST action='$aksi?op=rKlasifikasi&act=input'>
			<label><span>KODE Klasifikasi			</span><input type='text' name='kodeKlasifikasi' size='10'></label>
			<label><span>URAIAN Klasifikasi			</span><input type='text' name='urKlasifikasi' size='50'></label>		
		
		<input type=submit class=button value=Simpan>
		<input type=button value=Batal class=button onclick=self.history.back()>
          </form></div>";

    break;
  

  case "editrKlasifikasi":
    $edit = mysql_query("SELECT * FROM Klasifikasi WHERE id='$_GET[kode]'");
    $r    = mysql_fetch_array($edit);
	
	
	echo "<h1>Ubah rKlasifikasi</h1>
			<div class='line'></div>
			<div class='box'>";
    echo "
        <form method=POST action=$aksi?op=rKlasifikasi&act=update>
        <input type=hidden name=id value=$r[kode]>
				
		<label><span>KODE Klasifikasi			</span><input type='text' name='kodeKlasifikasi' value='$r[kode]' size='10'></label>
		<label><span>URAIAN Klasifikasi			</span><input type='text' name='urKlasifikasi' value='$r[jnsarsip]' size='50'></label> 
		<input type=submit class=button value=Update>
        <input type=button class=button value=Batal onclick=self.history.back()></td></tr>
        </form></div>";
    break;
	
	case "deleterKlasifikasi":
	mysql_query("DELETE FROM Klasifikasi WHERE id='$_GET[kode]' ");
	header('location:rKlasifikasi.php');
    break; 


}
}  
?>

