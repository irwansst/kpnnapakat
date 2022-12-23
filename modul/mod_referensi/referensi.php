<?php
session_start();
error_reporting(0);
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  header('location:../../logout.php');
}
else{



switch($_GET[act]){
  // Tampil User
  default:
    echo "<h1>REFERENSI</h1>";
    echo "
		
	<table width=100%>
	<tr>
		<td valign='top' width='190px'>
		<h1>UMUM</h1>
			<ul id='vertical' >
			   <li><a href='modul/mod_referensi/rJenis.php' target=q>Jenis Surat</a></li>
			   <li><a href='modul/mod_referensi/rSifat.php' target=q>Sifat Surat</a></li>
			   <li> <a href='modul/mod_referensi/rStatus.php' target=q>Status Surat</a></li>
			   <li> <a href='modul/mod_referensi/rArsip.php' target=q>Jenis Arsip</a></li>
			   <li> <a href='modul/mod_referensi/rJabatan.php' target=q>Jabatan</a></li>
			   <li> <a href='modul/mod_referensi/rKantor.php' target=q>Kantor/Instansi</a></li>
			</ul>
		</td>
		
		<td valign=top>
		 <iframe width=100% height=570px name=q scroller=no frameborder=no src='modul/mod_referensi/rJenis.php'></iframe> 
		
		</td>
	</tr>
	</table>
			 
				
	";
    break;
  
  
}
}
?>
