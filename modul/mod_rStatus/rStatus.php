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
$aksi="aksi_rStatus.php";

switch($_GET[act]){
  
  default:
  
    echo "<h1>REFERENSI STATUS SURAT</h1>";
    
	echo "<input type=button class='button' value='Tambah Data' onclick=location.href='?op=rStatus&act=tambahrStatus'><br><br>";
	
	echo "
	<div class='demo_jui'>
	<table cellpadding='0' cellspacing='0' border='0' class='display' id='example'>
		<thead>
			<tr>
				<th width=20px align=center>ID</th>
				<th >Uraian Status</th>
				<th width=100px>Lihat/<br>Ubah</th>
			</tr>
		</thead>
		<tbody>";
		
    $tampil	= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rstatus ORDER BY  status ASC");
    while ($r=mysqli_fetch_array($tampil)){
	
       echo "<tr>
			 <td align=center >$r[id]</td>
			 <td align=center>$r[status]</td>
             <td align=center>
			 <a href=?op=rStatus&act=editrStatus&id=$r[id]><img class='masterTooltip'  src='images/edit.png' border='0' title='Ubah Data'></a>	
			 <a href=?op=rStatus&act=deleterStatus&id=$r[id]><img class='masterTooltip'  src='images/delete.png' border='0' title='Hapus Data'></a>
	         </td>
			 </tr>";
    }	
		echo"</tbody></table></div><div class='spacer'></div>";
	
  break;

  
  case "tambahrStatus":
      echo "<h1>Tambah Status Surat</h1>
			<div class='line'></div>
			<div class='box'>";
    echo "	
	        <form method=POST action='$aksi?op=rStatus&act=input'>
			<label><span>KODE STATUS	</span><input type='text' name='kodeStatus' size='10'></label>
			<label><span>URAIAN STATUS			</span><input type='text' name='urStatus' size='50'></label>		
		
		<input type=submit class=button value=Simpan>
		<input type=button value=Batal class=button onclick=self.history.back()>
          </form></div>";

    break;
  

  case "editrStatus":
    $edit = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rstatus WHERE id='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);
	
	
	echo "<h1>Ubah Status</h1>
			<div class='line'></div>
			<div class='box'>";
    echo "
        <form method=POST action=$aksi?op=rStatus&act=update>
        <input type=hidden name=id value=$r[id]>
				
		<label><span>KODE STATUS		</span><input type='text' name='kodeStatus' value='$r[id]' size='10'></label>
		<label><span>URAIAN STATUS			</span><input type='text' name='urStatus' value='$r[status]' size='50'></label> 
		<input type=submit class=button value=Update>
        <input type=button class=button value=Batal onclick=self.history.back()></td></tr>
        </form></div>";
    break;
	
	case "deleterStatus":
	mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM rstatus WHERE kodestatus='$_GET[id]' ");
	header('location:rStatus.php');
    break; 


}
}  
?>

