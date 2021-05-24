
<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus Login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";

$aksi="modul/mod_iku/aksi_iku.php";


switch($_GET[act]){
  
  default:
  
echo "
	<div class='card shadow mb-4'>
	<div class='card-header py-3'><h6 class='m-0 font-weight-bold text-primary'>Indikator Kinerja Utama</h6></div>
	
	<div class='card-body'>
	<div class='row'>	
		<a href='?op=iku&act=tambahiku' class='btn btn-primary btn-icon-split'>
          <span class='icon text-white-50'>
             <i class='fas fa-plus'></i>
          </span>
          <span class='text'>Tambah</span>	
      </a>  
       
   </div><br />

	<div class='row'>    
	<div class='h6 mb-0 font-weight-normal text-gray-600'>		
		<div class='table-responsive'>
		<table class='table table-bordered table-sm table-hover' id='dataTable' cellspacing='0' cellpadding='0' >
		<thead>
			<tr class='table-success'>
				<th >No</th>				
				<th >Periode</th>
				<th >IKU</th>
				<th width=100px>Aksi</th>
			</tr>
		</thead>
		<tbody>";
		$no=1;
		$tampil	= mysql_query("SELECT * FROM iku where user='$_SESSION[namauser]' ORDER BY  user DESC");
      while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr class='small'>
			<td align='center'>$no</td>			
			<td width='100px'>$r[periode]</td>
			<td >$r[iku]</td>
			<td align=center>
			 <a href=?op=iku&act=editiku&id=$r[id] class='btn btn-warning btn-circle btn-sm'>
                    <i class='fas fa-pencil-alt'></i>
          </a>
          <a href='$aksi?op=iku&act=delete&id=$r[id]' class='btn btn-danger btn-circle btn-sm'>
                    <i class='fas fa-trash-alt'></i>
          </a>
	         </td>
			 </tr>";
			 $no++;
			 }	
		echo "</tbody></table></div></div>
	</div>
</div>
</div>
</div>
";
	
  break;

  
  case "tambahiku":
  
	echo "  
  <div class='card shadow mb-4'>
	<div class='card-header py-3'><h6 class='m-0 font-weight-bold text-primary'>Rekam IKU</h6></div>

	
	<div class='card-body'>
	<div class='row'>    
	<div class='h6 mb-0 font-weight-normal text-gray-600'>
		<!-- informasi card -->		
		<div class='card shadow mb-4' style='width:600px;'>
		<div class='card-header py-3'>
         	
		<h6 class='m-0 font-weight-bold text-warning'>
		<i class='fas fa-exclamation-triangle text-danger'></i>
		Peringatan!!!</h6>
		</div>

		<div class='card-body'>
			
			Untuk mempermudah pengisian, silahkan copy paste dari Manual IKU Anda.<br>
			Jangan lupa untuk menambah satu kategori yaitu Non IKU, bila belum ada.<br>
		</div>
		</div>
				
		<form method=POST action='$aksi?op=iku&act=input'>
    		<div class='form-group'>
      		<label for='iku'>IKU:</label>
      		<textarea class='form-control' rows='2' id='iku' name='iku' cols='62'></textarea>
      	</div> 		
    		<button type='submit' class='btn btn-primary'>Simpan</button>
  		</form>
	</div>
	</div>
	</div>";

    break;
  

  case "editiku":
    $edit = mysql_query("SELECT * FROM riku WHERE id='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
	
	
	echo "<h1>Ubah iku</h1>
			<div class='line'></div>
			<div class='box'>";
    echo "
        <form method=POST action=$aksi?op=iku&act=update>
        <input type=hidden name=id value=$r[id]>		
		<label><span>WAKTU 		</span><input type='text' name='waktu' value='$r[waktu]' size='10'></label>
		<label><span>KEGIATAN	</span><input type='text' name='kegiatan' value='$r[kegiatan]' size='100'></label>
		<label><span>IKU</span>";
			//dropdown disposisi iku
			echo "<select name='iku' style='width: 515px;'>
					<option value='$r[iku]' selected>$r[iku]</OPTION>";
					$kueri=mysql_query("SELECT * FROM iku WHERE user='$_SESSION[namauser]' AND periode='$_SESSION[periode]' ORDER BY iku ASC");
					while ($k=mysql_fetch_array($kueri)){
					echo "<option value='$k[iku]'>$k[iku]</option>";		
					}
			echo "</select></label>
		<label><span>ESELON			</span><input type='text' name='kdEselon' value='$r[eselon]' size='4'></label>
		<label><span>KONTROL SURAT			</span><input type='text' name='nKontrol' value='$r[kontrol]' size='100'></label>    
		<input type=submit class=button value=Update>
        <input type=button class=button value=Batal onclick=self.history.back()></td></tr>
        </form></div>";
    break; 

}
}  
?>

