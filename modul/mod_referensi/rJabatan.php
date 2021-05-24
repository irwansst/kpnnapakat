<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "../../plugin/var.php";
include "config/library.php";
include "config/fungsi_indotgl.php";
include "config/fungsi_combobox.php";
include "config/class_paging.php";
include "logout.php";

   
//menampilkan data dari database
$aksi="aksi_rJabatan.php";

switch($_GET[act]){
  
  default:
  
    echo "<h1>REFERENSI JENIS ARSIP</h1>";
    
	echo "<input type=button class='button' value='Tambah Data' onclick=location.href='?op=rJabatan&act=tambahrJabatan'><br><br>";
	
	echo "
	<div class='demo_jui'>
	<table cellpadding='0' cellspacing='0' border='0' class='display' id='example'>
		<thead>
			<tr>
				<th width=20px align=center>ID</th>
				<th align=center>Kode</th>
				<th align=center>Bidang</th>
				<th align=center>Jabatan</th>
				<th align=center>Eselon</th>
				<th align=center>Kontrol</th>
				<th width=100px>Lihat/<br>Ubah</th>
			</tr>
		</thead>
		<tbody>";
		
    $tampil	= mysql_query("SELECT * FROM rjabatan ORDER BY  id ASC");
    while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr>
			 <td align=right >$r[id]</td>
			 <td >$r[kode]</td>
			 <td >$r[urbidang]</td>
			 <td >$r[jabatan]</td>
			 <td >$r[eselon]</td>
			 <td width=20%>$r[kontrol]</td>
             <td align=center>
			 <a href=?op=rJabatan&act=editrJabatan&id=$r[id]><img class='masterTooltip'  src='../../images/edit.png' border='0' title='Ubah Data'></a>	
			 <a href=?op=rJabatan&act=deleterJabatan&id=$r[id]><img class='masterTooltip'  src='../../images/delete.png' border='0' title='Hapus Data'></a>
	         </td>
			 </tr>";
    }	
		echo"</tbody></table></div><div class='spacer'></div>";
	
  break;

  
  case "tambahrJabatan":
      echo "<h1>Tambah Jenis Arsip</h1>
			<div class='line'></div>
			<div class='box'>";
    echo "	
	        <form method=POST action='$aksi?op=rJabatan&act=input'>
			<label><span>KODE</span><input type='text' name='nKode' size='10'></label>
			<label><span>URAIAN BIDANG</span><input type='text' name='urBidang' size='50'></label>
			<label><span>JABATAN	</span><input type='text' name='urJabatan' size='50'></label>
			<label><span>KODE ESELON	</span><input type='text' name='kdEselon' size='4'></label>
			<label><span>KONTROL	</span><input type='text' name='nKontrol' size='30'></label>		
		
		<input type=submit class=button value=Simpan>
		<input type=button value=Batal class=button onclick=self.history.back()>
          </form></div>";

    break;
  

  case "editrJabatan":
    $edit = mysql_query("SELECT * FROM rJabatan WHERE id='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
	
	
	echo "<h1>Ubah Jabatan</h1>
			<div class='line'></div>
			<div class='box'>";
    echo "
        <form method=POST action=$aksi?op=rJabatan&act=update>
        <input type=hidden name=id value=$r[id]>		
		<label><span>KODE </span><input type='text' name='nKode' value='$r[kode]' size='10'></label>
		<label><span>BIDANG			</span><input type='text' name='urBidang' value='$r[urbidang]' size='100'></label>
		<label><span>JABATAN			</span><input type='text' name='urJabatan' value='$r[jabatan]' size='50'></label>
		<label><span>ESELON			</span><input type='text' name='kdEselon' value='$r[eselon]' size='4'></label>
		<label><span>KONTROL SURAT			</span><input type='text' name='nKontrol' value='$r[kontrol]' size='100'></label>    
		<input type=submit class=button value=Update>
        <input type=button class=button value=Batal onclick=self.history.back()></td></tr>
        </form></div>";
    break;
	
	case "deleterJabatan":
	mysql_query("DELETE FROM rJabatan WHERE id='$_GET[id]' ");
	header('location:rJabatan.php');
    break; 


}
}  
?>

