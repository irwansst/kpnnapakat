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
$aksi="aksi_rKantor.php";

switch($_GET[act]){
  
  default:
  
    echo "<h1>REFERENSI ALAMAT KANTOR</h1>";
    
	echo "<input type=button class='button' value='Tambah Data' onclick=location.href='?op=rKantor&act=tambahrKantor'><br><br>";
	
	echo "
	<div class='demo_jui'>
	<table cellpadding='0' cellspacing='0' border='0' class='display' id='example'>
		<thead>
			<tr>
				<th width=20px align=center>ID</th>
				<th align=center>Kantor</th>
				<th align=center>Alamat</th>
				<th align=center>Telpon</th>
				<th align=center>Faksimil</th>
				<th align=center>Kode Pos</th>
				<th align=center>Email</th>
				<th align=center>Lihat/<br>Ubah</th>
			</tr>
		</thead>
		<tbody>";
		
    $tampil	= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rkantor");
    while ($r=mysqli_fetch_array($tampil)){
	
       echo "<tr>
			 <td >$r[id]</td>
			 <td >$r[kantor]</td>
			 <td >$r[alamat]</td>
			 <td >$r[telpon]</td>
			 <td >$r[faks]</td>
			 <td >$r[pos]</td>
			 <td >$r[email]</td>
             <td align=center>
			 <a href=?op=rKantor&act=editrKantor&id=$r[id]><img class='masterTooltip'  src='../../images/edit.png' border='0' title='Ubah Data'></a>	
			 <a href=?op=rKantor&act=deleterKantor&id=$r[id]><img class='masterTooltip'  src='../../images/delete.png' border='0' title='Hapus Data'></a>
	         </td>
			 </tr>";
    }	
		echo"</tbody></table></div><div class='spacer'></div>";
	
  break;

  
  case "tambahrKantor":
      echo "<h1>Tambah Alamat Kantor</h1>
			<div class='line'></div>
			<div class='box'>";
    echo "	
	        <form method=POST action='$aksi?op=rKantor&act=input'>
			<label><span>KANTOR</span><input type='text' name='nKantor' size='100'></label>
			<label><span>ALAMAT</span><input type='text' name='nAlamat' size='100'></label>
			<label><span>TELPON	</span><input type='text' name='nTelp' size='100'></label>
			<label><span>FAKSIMIL	</span><input type='text' name='nFaks' size='100'></label>
			<label><span>KODE POS	</span><input type='text' name='nPos' size='100'></label>
			<label><span>EMAIL	</span><input type='text' name='nEmail' size='100'></label>			
		
		<input type=submit class=button value=Simpan>
		<input type=button value=Batal class=button onclick=self.history.back()>
          </form></div>";

    break;
  

  case "editrKantor":
    $edit = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rKantor WHERE id='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);
	
	
	echo "<h1>Ubah Kantor</h1>
			<div class='line'></div>
			<div class='box'>";
    echo "
        <form method=POST action='$aksi?op=rKantor&act=update'>
        <input type=hidden name=id value=$r[id]>		
		<label><span>KANTOR		</span><input type='text' name='nKantor' value='$r[kantor]' size='100'></label>
		<label><span>ALAMAT		</span><input type='text' name='nAlamat' value='$r[alamat]' size='100'></label>
		<label><span>TELPON		</span><input type='text' name='nTelp' value='$r[telpon]' size='100'></label>
		<label><span>FAKSIMIL	</span><input type='text' name='nFaks' value='$r[faks]' size='100'></label>
		<label><span>KODE POS	</span><input type='text' name='nPos' value='$r[pos]' size='100'></label>
		<label><span>EMAIL		</span><input type='text' name='nEmail' value='$r[email]' size='100'></label>    
		<input type=submit class=button value=Update>
        <input type=button class=button value=Batal onclick=self.history.back()></td></tr>
        </form></div>";
    break;
	
	case "deleterKantor":
	mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM rKantor WHERE id='$_GET[id]' ");
	header('location:rKantor.php');
    break; 


}
}  
?>

