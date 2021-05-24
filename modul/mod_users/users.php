<?php
if ($_SESSION['leveluser']=='admin'){

	include "../../config/koneksi.php";
	$aksi="modul/mod_users/aksi_users.php";
		//menampilkan halaman admin
	
	switch($_GET[act]){
		default:

	
	
	echo "
		<div class='card shadow mb-4'>
			<div class='card-header py-3'><h5 class='m-0 font-weight-bold text-primary'>DAFTAR PENGGUNA</h5></div>
	
			<div class='card-body'>

				<div class='row'>	
					<a href='?op=users&act=tambahusers' class='btn btn-primary btn-icon-split '>
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
							<th >Username</th>
							<th >Password</th>
							<th >Nama Lengkap</th>
							<th >Email</th>
							<th >No. Telpon</th>
							<th >Level</th>
							<th >Blokir</th>
							<th width=100px>Aksi</th>
						</tr>
					</thead>
					
					<tbody>";
					$no=1;
					$tampil	= mysql_query("SELECT * FROM kpn_users ORDER BY nama_lengkap ASC ");
      while ($r=mysql_fetch_array($tampil)){
	
		$number = $r[no_telp];
			if(ctype_digit($number) && strlen($number) !== 5) {
  			$number = substr($number, 0, 4) .'-'.
            substr($number, 4, 4) .'-'.
            substr($number, 8);
			}

		echo "<tr class='small text-dark'>
			<td align='center'>$no</td>			
			<td >$r[username]</td>
			<td width='50px'>$r[password]</td>
			<td width='250px'>$r[nama_lengkap]</td>
			<td >$r[email]</td>
			<td width='150px'>$number</td>
			<td >$r[level]</td>
			<td >$r[blokir]</td>
			<td align=center width='150px'>
			 <a href=?op=users&act=editusers&id=$r[id] class='btn btn-warning btn-circle btn-sm'>
                    <i class='fas fa-pencil-alt'></i>
          </a>
          <a onclick='javascript:confirmationDelete($(this));return false;' href='$aksi?op=users&act=delete&id=$r[id]' class='btn btn-danger btn-circle btn-sm' name='remove-levels'>
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
//menambah rekaman users
case "tambahusers":

echo "		
	<div class='card shadow mb-4'>
	<div class='card-header py-3'><h5 class='m-0 font-weight-bold text-primary'>TAMBAH PENGGUNA</h5></div>

	
	<div class='card-body'>
	<div class='row'>    
	<div class='h6 mb-0 font-weight-normal text-gray-600'>
		<form method=POST action='$aksi?op=users&act=input'>	

		<div class='form-group'>
			<label for='username'>Username:</label>
				<input type='text' class='form-control' id='username' name='username' required>
		  </div>
		  
		<div class='form-group'>
			<label for='password'>Password:</label>
			<input type='text' class='form-control' id='password' name='password' required>
		</div> 

		<div class='form-group'>
			<label for='nama_lengkap'>Nama Lengkap:</label>
			<input type='text' class='form-control'  id='nama_lengkap' name='nama_lengkap' required>
		</div>

		<div class='form-group'>
			<label for='email'>Email:</label>
			<input type='text' class='form-control'  id='email' name='email' required>
		</div>

		<div class='form-group'>
			<label for='no_telp'>Nomor HP/ Telpon:</label>
			<input type='text' class='form-control'  id='no_telp' name='no_telp' required>
		</div>

		<div class='form-group'>
		<label for='level'>Level Pengguna:</label>
		  <select class='form-control' name ='level' style='width:850px;'>
			  <option value='user'>user</option>
			  <option value='admin'>admin</option>		
			</select>	  		   	
		</div>

		<div class='form-group'>
		<label for='blokir'>Status Blokir:</label>
		  <select class='form-control' name='blokir' style='width:850px;'>
			  <option value='N'>N</option>
			  <option value='Y'>Y</option>		
			</select>	  		   	
		</div>
			  
		<button type='submit' class='btn btn-primary'>Simpan</button>
  		</form>
	</div>
	</div>
	</div>
	
	</div>
	";
	
break;
//mengubah data users
case "editusers":

	$edit = mysql_query("SELECT * FROM kpn_users WHERE id='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    
	echo "		
	<div class='card shadow mb-4'>
	<div class='card-header py-3'><h5 class='m-0 font-weight-bold text-primary'>UBAH PENGGUNA</h5></div>

	<div class='card-body'>
	<div class='row'>    
	<div class='h6 mb-0 font-weight-normal text-gray-600'>
		<form method=POST action='$aksi?op=users&act=update'>
			
			<div class='form-group'>    		
    		<input type='hidden' name='id' value='$r[id]'>
			</div>	

			<div class='form-group'>
				<label for='username'>Username:</label>
      			<input type='text' class='form-control'  value='$r[username]' id='username' name='username'>
      		</div>
			  
			<div class='form-group'>
				<label for='password'>Password:</label>
				<input type='text' class='form-control'  value='$r[password]' id='password' name='password'>
			</div> 

			<div class='form-group'>
				<label for='nama_lengkap'>Nama Lengkap:</label>
				<input type='text' class='form-control'  value='$r[nama_lengkap]' id='nama_lengkap' name='nama_lengkap'>
			</div>

			<div class='form-group'>
				<label for='email'>Email:</label>
				<input type='text' class='form-control'  value='$r[email]' id='email' name='email'>
			</div>

			<div class='form-group'>
				<label for='no_telp'>Nomor HP/ Telpon:</label>
				<input type='text' class='form-control'  value='$r[no_telp]' id='no_telp' name='no_telp'>
			</div>

	

			<div class='form-group'>
			<label for='level'>Level Pengguna:</label>
			  <select class='form-control' name ='level' style='width:850px;'>
				  <option value='$r[level]' selected>$r[level]</OPTION>
				  <option value='user'>user</option>
				  <option value='admin'>admin</option>		
				</select>	  		   	
			</div>

			<div class='form-group'>
			<label for='blokir'>Status Blokir:</label>
			  <select class='form-control' name='blokir' style='width:850px;'>
				  <option value='$r[blokir]' selected>$r[blokir]</OPTION>
				  <option value='N'>N</option>
				  <option value='Y'>Y</option>		
				</select>	  		   	
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
