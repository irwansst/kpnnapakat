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
$aksi="aksi_rArsip.php";

switch($_GET[act]){
  
  default:
  
    echo "<h1>REFERENSI JENIS ARSIP</h1>";
    
	echo "<input type=button class='button' value='Tambah Data' onclick=location.href='?op=rArsip&act=tambahrArsip'><br><br>";
	
	echo "
	<div class='demo_jui'>
	<table cellpadding='0' cellspacing='0' border='0' class='display' id='example'>
		<thead>
			<tr>
				<th width=20px align=center>ID</th>
				<th >Jenis Arsip</th>
				<th width=100px>Lihat/<br>Ubah</th>
			</tr>
		</thead>
		<tbody>";
		
    $tampil	= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rarsip ORDER BY  id ASC");
    while ($r=mysqli_fetch_array($tampil)){
	
       echo "<tr>
			 <td align=center >$r[id]</td>
			 <td align=center>$r[jnsarsip]</td>
             <td align=center>
			 <a href=?op=rArsip&act=editrArsip&id=$r[id]><img class='masterTooltip'  src='../../images/edit.png' border='0' title='Ubah Data'></a>	
			 <a href=?op=rArsip&act=deleterArsip&id=$r[id]><img class='masterTooltip'  src='../../images/delete.png' border='0' title='Hapus Data'></a>
	         </td>
			 </tr>";
    }	
		echo"</tbody></table></div><div class='spacer'></div>";
	
  break;

  
  case "tambahrArsip":
      echo "<h1>Tambah Jenis Arsip</h1>
			<div class='line'></div>
			<div class='box'>";
    echo "	
	        <form method=POST action='$aksi?op=rArsip&act=input'>
			<label><span>KODE JENIS ARSIP	</span><input type='text' name='kodeJnsArsip' size='10'></label>
			<label><span>URAIAN JENIS ARSIP	</span><input type='text' name='urJnsArsip' size='50'></label>		
		
		<input type=submit class=button value=Simpan>
		<input type=button value=Batal class=button onclick=self.history.back()>
          </form></div>";

    break;
  

  case "editrArsip":
    $edit = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rarsip WHERE id='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);
	
	
	echo "<h1>Ubah Jenis Arsip</h1>
			<div class='line'></div>
			<div class='box'>";
    echo "
        <form method=POST action=$aksi?op=rArsip&act=update>
        <input type=hidden name=id value=$r[id]>
				
		<label><span>KODE JENIS ARSIP </span><input type='text' name='kodeJnsArsip' value='$r[id]' size='10'></label>
		<label><span>URAIAN JENIS ARSIP			</span><input type='text' name='urJnsArsip' value='$r[jnsarsip]' size='50'></label> 
		<input type=submit class=button value=Update>
        <input type=button class=button value=Batal onclick=self.history.back()></td></tr>
        </form></div>";
    break;
	
	case "deleterArsip":
	mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM rarsip WHERE id='$_GET[id]' ");
	header('location:rArsip.php');
    break; 


}
}  
?>

