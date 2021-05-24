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
$aksi="aksi_rSifat.php";

switch($_GET[act]){
  
  default:
  
    echo "<h1>REFERENSI SIFAT SURAT</h1>";
    
	echo "<input type=button class='button' value='Tambah Data' onclick=location.href='?op=rSifat&act=tambahrSifat'><br><br>";
	
	echo "
	<div class='demo_jui'>
	<table cellpadding='0' cellspacing='0' border='0' class='display' id='example'>
		<thead>
			<tr>
				<th width=20px align=center>ID</th>
				<th >Uraian Jenis</th>
				<th width=100px>Lihat/<br>Ubah</th>
			</tr>
		</thead>
		<tbody>";
		
    $tampil	= mysql_query("SELECT * FROM rSifat ORDER BY  sifat ASC");
    while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr>
			 <td align=center >$r[id]</td>
			 <td align=left>$r[sifat]</td>
             <td align=center>
			 <a href=?op=rSifat&act=editrSifat&id=$r[id]><img class='masterTooltip'  src='../../images/edit.png' border='0' title='Ubah Data'></a>	
			 <a href=?op=rSifat&act=deleterSifat&id=$r[id]><img class='masterTooltip'  src='../../images/delete.png' border='0' title='Hapus Data'></a>
	         </td>
			 </tr>";
    }	
		echo"</tbody></table></div><div class='spacer'></div>";
	
  break;

  
  case "tambahrSifat":
      echo "<h1>Tambah SURAT MASUK</h1>
			<div class='line'></div>
			<div class='box'>";
    echo "	
	        <form method=POST action='$aksi?op=rSifat&act=input'>
			<label><span>KODE SIFAT		</span><input type='text' name='kodeSifat' size='10'></label>
			<label><span>URAIAN SIFAT			</span><input type='text' name='urSifat' size='50'></label>		
		
		<input type=submit class=button value=Simpan>
		<input type=button value=Batal class=button onclick=self.history.back()>
          </form></div>";

    break;
  

  case "editrSifat":
    $edit = mysql_query("SELECT * FROM rSifat WHERE id='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
	
	
	echo "<h1>Ubah rSifat</h1>
			<div class='line'></div>
			<div class='box'>";
    echo "
        <form method=POST action=$aksi?op=rSifat&act=update>
        <input type=hidden name=id value=$r[id]>
				
		<label><span>KODE JENIS			</span><input type='text' name='kodeSifat' value='$r[id]' size='10'></label>
		<label><span>URAIAN JENIS			</span><input type='text' name='urSifat' value='$r[sifat]' size='50'></label> 
		<input type=submit class=button value=Update>
        <input type=button class=button value=Batal onclick=self.history.back()></td></tr>
        </form></div>";
    break;
	
	case "deleterSifat":
	mysql_query("DELETE FROM rsifat WHERE kodeSifat='$_GET[id]' ");
	header('location:rSifat.php');
    break; 


}
}  
?>

