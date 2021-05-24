<?php
if ($_SESSION['leveluser']=='admin'){

	include "../../config/koneksi.php";
	$aksi="modul/mod_unit/aksi_unit.php";
		//menampilkan halaman admin
	
	switch($_GET[act]){
		default:

	
	echo "
		<div class='card shadow mb-4'>
			<div class='card-header py-3'><h5 class='m-0 font-weight-bold text-primary'>DAFTAR UNIT</h5></div>
	
			<div class='card-body'>
				<div class='row'>	
					<a href='?op=unit&act=tambahunit' class='btn btn-primary btn-icon-split'>
          				<span class='icon text-white-50'><i class='fas fa-plus'></i></span>
						<span class='text'>Tambah</span>	
      				</a>  
       			</div><br />

		<div class='row'>    
			<div class='h6 mb-0 font-weight-normal'>		
				<div class='table-responsive'>
					<table class='table table-bordered table-sm table-hover' id='dataTable' cellspacing='0' cellpadding='0' >
					<thead>
						<tr class='table-success text-dark'>
							<th >No</th>				
							<th >Kode Unit</th>
							<th >Nama Unit</th>
							<th width=100px>Aksi</th>
						</tr>
					</thead>
					
					<tbody>";
					$no=1;
					$tampil	= mysql_query("SELECT * FROM kpn_unit ORDER BY kode ASC ");
      while ($r=mysql_fetch_array($tampil)){
	
		echo "<tr class='small text-dark'>
			<td align='center'>$no</td>			
			<td >$r[kode]</td>
			<td width='250px'>$r[nama_unit]</td>
			<td align=center width='150px'>
			 <a href=?op=unit&act=editunit&id=$r[id] class='btn btn-warning btn-circle btn-sm'>
                    <i class='fas fa-pencil-alt'></i>
          </a>
          <a onclick='javascript:confirmationDelete($(this));return false;' href='$aksi?op=unit&act=delete&id=$r[id]' class='btn btn-danger btn-circle btn-sm' name='remove-levels'>
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
//menambah rekaman unit
case "tambahunit":

echo "		
	<div class='card shadow mb-4'>
	<div class='card-header py-3'><h5 class='m-0 font-weight-bold text-primary'>REKAM unit</h5></div>

	
	<div class='card-body'>
	<div class='row'>    
	<div class='h5 mb-0 font-weight-normal text-gray-600'>
		<form method=POST action='$aksi?op=unit&act=input'>	

		<div class='form-group'>
		<label for='kode'>Kode Unit:</label>
		<input type='text' class='form-control' id='kode' name='kode'>
		</div>

		<div class='form-group'>
		 <label for='nama_unit'>Nama Unit:</label>
		<input type='text' class='form-control' id='nama_unit' name='nama_unit'>
		</div>
		  			  
		<button type='submit' class='btn btn-primary'>Simpan</button>
  		</form>
	</div>
	</div>
	</div>
	
	</div>
	";
	
break;
//mengubah data unit
case "editunit":

	$edit = mysql_query("SELECT * FROM kpn_unit WHERE id='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    
	echo "		
	<div class='card shadow mb-4'>
	<div class='card-header py-3'><h5 class='m-0 font-weight-bold text-primary'>UBAH UNIT</h5></div>

	<div class='card-body'>
	<div class='row'>    
	<div class='h6 mb-0 font-weight-normal text-gray-600'>
		<form method=POST action='$aksi?op=unit&act=update'>
			
			<div class='form-group'>    		
    		<input type='hidden' name='id' value='$r[id]'>
			</div>	

			<div class='form-group'>
				<label for='kode'>Kode unit:</label>
      			<input type='text' class='form-control'  value='$r[kode]' id='kode' name='kode'>
      		</div>

			<div class='form-group'>
				<label for='nama_unit'>Nama unit:</label>
				<input type='text' class='form-control'  value='$r[nama_unit]' id='nama_unit' name='nama_unit'>
			</div>

  				
    		<button type='submit' class='btn btn-primary'>Simpan</button>
  		</form>
	</div>
	</div>
	</div>
	
	</div>
	";

break;

	}
	
	
}else{
	echo "Halaman khusus buat Admin!!! anda tidak punyak hak akses";
}
?>
