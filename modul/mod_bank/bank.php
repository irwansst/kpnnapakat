<?php
if ($_SESSION['leveluser']=='admin'){

	include "../../config/koneksi.php";
	$aksi="modul/mod_bank/aksi_bank.php";
		//menampilkan halaman admin
	
	switch($_GET[act]){
		default:

	
	echo "
		<div class='card shadow mb-4'>
			<div class='card-header py-3'><h5 class='m-0 font-weight-bold text-primary'>DAFTAR BANK</h5></div>
	
			<div class='card-body'>
				<div class='row'>	
					<a href='?op=bank&act=tambahbank' class='btn btn-primary btn-icon-split'>
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
							<th >Kode Bank</th>
							<th >Nama Bank</th>
							<th width=100px>Aksi</th>
						</tr>
					</thead>
					
					<tbody>";
					$no=1;
					$tampil	= mysql_query("SELECT * FROM kpn_bank ORDER BY kode ASC ");
      while ($r=mysql_fetch_array($tampil)){
	
		echo "<tr class='small text-dark'>
			<td align='center'>$no</td>			
			<td >$r[kode]</td>
			<td width='250px'>$r[nama_bank]</td>
			<td align=center width='150px'>
			 <a href=?op=bank&act=editbank&id=$r[id] class='btn btn-warning btn-circle btn-sm'>
                    <i class='fas fa-pencil-alt'></i>
          </a>
          <a onclick='javascript:confirmationDelete($(this));return false;' href='$aksi?op=bank&act=delete&id=$r[id]' class='btn btn-danger btn-circle btn-sm' name='remove-levels'>
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
//menambah rekaman bank
case "tambahbank":

echo "		
	<div class='card shadow mb-4'>
	<div class='card-header py-3'><h5 class='m-0 font-weight-bold text-primary'>REKAM BANK</h5></div>

	
	<div class='card-body'>
	<div class='row'>    
	<div class='h5 mb-0 font-weight-normal text-gray-600'>
		<form method=POST action='$aksi?op=bank&act=input'>	

		<div class='form-group'>
		<label for='kode'>Kode Bank:</label>
		<input type='text' class='form-control' id='kode' name='kode'>
		</div>

		<div class='form-group'>
		 <label for='nama_bank'>Nama Bank:</label>
		<input type='text' class='form-control' id='nama_bank' name='nama_bank'>
		</div>
		  			  
		<button type='submit' class='btn btn-primary'>Simpan</button>
  		</form>
	</div>
	</div>
	</div>
	
	</div>
	";
	
break;
//mengubah data bank
case "editbank":

	$edit = mysql_query("SELECT * FROM kpn_bank WHERE id='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    
	echo "		
	<div class='card shadow mb-4'>
	<div class='card-header py-3'><h5 class='m-0 font-weight-bold text-primary'>UBAH BANK</h5></div>

	<div class='card-body'>
	<div class='row'>    
	<div class='h6 mb-0 font-weight-normal text-gray-600'>
		<form method=POST action='$aksi?op=bank&act=update'>
			
			<div class='form-group'>    		
    		<input type='hidden' name='id' value='$r[id]'>
			</div>	

			<div class='form-group'>
				<label for='kode'>Kode Bank:</label>
      			<input type='text' class='form-control'  value='$r[kode]' id='kode' name='kode'>
      		</div>

			<div class='form-group'>
				<label for='nama_bank'>Nama Bank:</label>
				<input type='text' class='form-control'  value='$r[nama_bank]' id='nama_bank' name='nama_bank'>
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
