<?php
if ($_SESSION['leveluser']=='admin'){

	include "../../config/koneksi.php";
	$aksi="modul/mod_anggota/aksi_anggota.php";
		//menampilkan halaman admin
	
	switch($_GET[act]){
		default:

		echo "
		<div class='card shadow mb-4'>
			<div class='card-header py-3'><h6 class='m-0 font-weight-bold text-primary'>DAFTAR ANGGOTA</h6></div>
	
			<div class='card-body'>
			<!--	
			<div class='row'>	
					<a href='?op=anggota&act=tambahanggota' class='btn btn-primary btn-icon-split'>
          				<span class='icon text-white-50'><i class='fas fa-plus'></i></span>
						<span class='text'>Tambah</span>	
      				</a>  
       			</div><br />
			-->

		<div class='row'>    
			<div class='h6 mb-0 font-weight-normal'>		
				<div class='table-responsive'>
					<table class='table table-bordered table-sm table-hover' id='dataTable' cellspacing='0' cellpadding='0' >
					<thead>
						<tr class='table-success text-dark'>
							<th class='text-center'>No</th>				
							<th class='text-center'>NIP</th>
							<th class='text-center'>Nama Lengkap</th>
							<th class='text-center'>Unit</th>
							<th class='text-center'>Email</th>
							<th class='text-center'>No. Telpon</th>
							<th class='text-center'>Aktif</th>

							<th width=100px class='text-center'>Aksi</th>
						</tr>
					</thead>
					
					<tbody>";
					$no=1;
					$tampil	= mysql_query("SELECT a.id, a.nip, a.nama_lengkap, a.tempat_lhr, a.tgl_lhr, a.alamat, a.email, a.no_telp, b.nama_unit, a.bank, a.norek, a.tgl_daftar, a.aktif FROM kpn_anggota a LEFT JOIN kpn_unit b ON a.unit = b.kode WHERE LENGTH(a.nip) = 18 ORDER BY a.unit, a.nama_lengkap ASC ");
      while ($r=mysql_fetch_array($tampil)){
	
		$number = $r[no_telp];
			if(ctype_digit($number) && strlen($number) !== 5) {
  			$number = substr($number, 0, 4) .'-'.
            substr($number, 4, 4) .'-'.
            substr($number, 8);
			}
		

		echo "<tr class='small text-dark'>
			<td align='center'>$no</td>			
			<td >$r[nip]</td>
			<td >$r[nama_lengkap]</td>
			<td >$r[nama_unit]</td>
			<td >$r[email]</td>
			<td >$number</td>
			<td class='font-weight-bold text-center'>$r[aktif]</td>
			<td align=center width='150px'>
			 
			<a href=?op=anggota&act=detailanggota&id=$r[id] class='btn btn-success btn-circle btn-sm'>
                    <i class='fas fa-eye'></i>
         	 </a>
			
			<a href=?op=anggota&act=editanggota&id=$r[id] class='btn btn-warning btn-circle btn-sm'>
                    <i class='fas fa-pencil-alt'></i>
         	 </a>

          	<a onclick='javascript:confirmationDelete($(this));return false;' href='$aksi?op=anggota&act=delete&id=$r[id]' class='btn btn-danger btn-circle btn-sm' name='remove-levels'>
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

//melihat detail anggota
case "detailanggota":

	
	$q_anggota	= mysql_query("SELECT a.id, a.nip, a.nama_lengkap, a.tempat_lhr, a.tgl_lhr, a.alamat, a.email, a.no_telp, a.unit, b.nama_unit, a.bank, a.norek, a.tgl_daftar, a.aktif FROM kpn_anggota a LEFT JOIN kpn_unit b ON a.unit = b.kode WHERE LENGTH(a.nip) = 18 AND a.id='$_GET[id]' ");
    $qa    = mysql_fetch_array($q_anggota);

	$namabank = mysql_query("SELECT nama_bank from kpn_bank WHERE kode = '$qa[bank]' ");
	$nb    = mysql_fetch_array($namabank);
    

	echo "		
	<div class='card shadow mb-4'>
	<div class='card-header py-3'><h6 class='m-0 font-weight-bold text-primary'>DETAIL ANGGOTA</h6></div>

	<div class='card-body'>
	<div class='row'>	
		<a href='?op=anggota' class='btn btn-success btn-icon-split'>
          	<span class='icon text-white-50'><i class='fas fa-backward'></i></span>
			<span class='text'>Kembali</span>	
      	</a>
	</div><br />
	
	<div class='row'>    
	<div class='h6 mb-0 font-weight-normal text-gray-600'>
		<form method=POST action='#'>
			
			<div class='form-group'>    		
    		<input type='hidden' name='id' value='$qa[id]'>
			</div>	

			<div class='form-group'>
				<label for='nip'>NIP:</label>
      			<input type='text' class='form-control'  value='$qa[nip]' id='nip' name='nip' style='width:850px;' disabled>
      		</div>
			  
			<div class='form-group'>
				<label for='nama_lengkap'>Nama Lengkap:</label>
				<input type='text' class='form-control'  value='$qa[nama_lengkap]' id='nama_lengkap' name='nama_lengkap' disabled>
			</div>

			<div class='form-group'>
			<label for='tempat_lhr'>Tempat Lahir:</label>
			<input type='text' class='form-control'  value='$qa[tempat_lhr]' id='tempat_lhr' name='tempat_lhr' disabled>
			</div>

			<div class='form-group'>
			<label for='alamat'>Alamat:</label>
			<input type='text' class='form-control'  value='$qa[alamat]' id='alamat' name='alamat' disabled>
			</div>

			<div class='form-group'>
				<label for='email'>Email:</label>
				<input type='text' class='form-control'  value='$qa[email]' id='email' name='email' disabled>
			</div>

			<div class='form-group'>
				<label for='no_telp'>Nomor HP/ Telpon:</label>
				<input type='text' class='form-control'  value='$qa[no_telp]' id='no_telp' name='no_telp' disabled>
			</div>

			<div class='form-group'>
			<label for='unit'>Unit Kerja:</label>
			<input type='text' class='form-control'  value='$qa[unit] | $qa[nama_unit]' id='unit' name='unit' disabled>
			</div>

			<div class='form-group'>
			<label for='bank'>Bank:</label>
			<input type='text' class='form-control'  value='$qa[bank] | $nb[nama_bank]' id='bank' name='bank' disabled>
			</div>

			<div class='form-group'>
			<label for='norek'>Nomor Rekening:</label>
			<input type='text' class='form-control'  value='$qa[norek]' id='norek' name='norek' disabled>
			</div>

			<div class='form-group'>
			<label for='tgl_daftar'>Tanggal Pendaftaran:</label>
			<input type='text' class='form-control'  value='$qa[tgl_daftar]' id='tgl_daftar' name='tgl_daftar' disabled>
			</div>

			<div class='form-group'>
			<label for='aktif'>Status Aktif:</label>
			<input type='text' class='form-control'  value='$qa[aktif]' id='aktif' name='aktif' disabled>
			</div>

   		</form>
	</div>
	</div>
	</div>
	
	</div>
	";

	
break;

//menambah rekaman anggota

case "tambahanggota":

echo "		
	<div class='card shadow mb-4'>
	<div class='card-header py-3'><h6 class='m-0 font-weight-bold text-primary'>Rekam anggota</h6></div>

	
	<div class='card-body'>
	<div class='row'>    
	<div class='h6 mb-0 font-weight-normal text-gray-600'>
		<form method=POST action='$aksi?op=anggota&act=input'>	

		<div class='form-group'>
			<label for='nip'>NIP:</label>
			  <input type='text' class='form-control' id='nip' name='nip' placeholder='Isikan NIP 18 digit Anda'>
		  </div>
		  
		<div class='form-group'>
			<label for='nama_lengkap'>Nama Lengkap:</label>
			<input type='text' class='form-control'  id='nama_lengkap' name='nama_lengkap' placeholder='Isikan nama lengkap Anda tanpa gelar'>
		</div>

		<div class='form-group'>
			<label for='tempat_lhr'>Tempat Lahir:</label>
			<input type='text' class='form-control'  id='tempat_lhr' name='tempat_lhr' placeholder='Isikan tempat lahir Anda'>
		</div>

		<div class='form-group'>
			<label for='tgl_lhr'>Tanggal Lahir:</label>
			<input type='text' class='form-control'  id='my_dtp1' name='tgl_lhr' placeholder='Isikan tanggal lahir Anda'>
		</div>

		<div class='form-group'>
		<label for='alamat'>Alamat:</label>
		<textarea class='form-control'  id='alamat' name='alamat' rows='2' placeholder='Isikan alamat Anda sesuai Kartu Tanda Penduduk'></textarea>
		</div>

		<div class='form-group'>
			<label for='email'>Email:</label>
			<input type='text' class='form-control'  id='email' name='email' placeholder='Isikan alamat email yang berlaku'>
		</div>

		<div class='form-group'>
			<label for='no_telp'>Nomor HP/ Telpon:</label>
			<input type='text' class='form-control'  id='no_telp' name='no_telp' placeholder='Isikan no. telp yang didaftarkan pada Whatsapp'>
		</div>

		<div class='form-group'>
		<label for='unit'>Unit Kerja:</label>
		  <select class='form-control' name ='unit' style='width:850px;'>
		  ";
			$qunit=mysql_query("SELECT * FROM kpn_unit ORDER BY kode ASC");
		  	while ($qu=mysql_fetch_array($qunit)){
		  	echo "<option value='$qu[kode]'>$qu[kode] | $qu[nama_unit]</option>";	
			}
			echo "
		  	</select>	  		   	
		</div>

		<div class='form-group'>
		<label for='bank'>Bank:</label>
		  <select class='form-control' name ='bank' style='width:850px;'>
		  ";
			$qbank=mysql_query("SELECT * FROM kpn_bank ORDER BY kode ASC");
		  	while ($qb=mysql_fetch_array($qbank)){
		  	echo "<option value='$qb[kode]'>$qb[kode] | $qb[nama_bank]</option>";	
			}
			echo "
		  	</select>	  		   	
		</div>

		<div class='form-group'>
		<label for='norek'>Nomor Rekening:</label>
			<input type='text' class='form-control'  id='norek' name='norek' placeholder='Isikan no. rekening sesuai dengan Bank'>
		</div>

		<div class='form-group'>
		<label for='tgl_daftar'>Tanggal Pendaftaran Anggota:</label>
			<input type='text' class='form-control'  id='my_dtp2' name='tgl_daftar' placeholder='Isikan tanggal pendaftaran Anda menjadi anggota'>
		</div>

		<div class='form-group'>
		<label for='aktif'>Status Aktif:</label>
		  <select class='form-control' name ='aktif' style='width:850px;'>
			  <option value='Y'>Y</option>
			  <option value='N'>N</option>		
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


//mengubah data anggota
case "editanggota":
	
	$q_anggota	= mysql_query("SELECT a.id, a.nip, a.nama_lengkap, a.tempat_lhr, a.tgl_lhr, a.alamat, a.email, a.no_telp, a.unit, b.nama_unit, a.bank, a.norek, a.tgl_daftar, a.aktif FROM kpn_anggota a LEFT JOIN kpn_unit b ON a.unit = b.kode WHERE LENGTH(a.nip) = 18 AND a.id='$_GET[id]' ");
    $qa    = mysql_fetch_array($q_anggota);

	$namabank = mysql_query("SELECT nama_bank from kpn_bank WHERE kode = '$qa[bank]' ");
	$nb    = mysql_fetch_array($namabank);

	$namaunit = mysql_query("SELECT nama_unit from kpn_unit WHERE kode = '$qa[unit]' ");
	$nu    = mysql_fetch_array($namaunit);
    

	echo "		
	<div class='card shadow mb-4'>
	<div class='card-header py-3'><h6 class='m-0 font-weight-bold text-primary'>DETAIL ANGGOTA</h6></div>

	<div class='card-body'>

	<div class='row'>    
	<div class='h6 mb-0 font-weight-normal text-gray-600'>
		<form method=POST action='$aksi?op=anggota&act=update'>
			
			<div class='form-group'>    		
    		<input type='hidden' name='id' value='$qa[id]'>
			</div>	

			<div class='form-group'>
				<label for='nip'>NIP:</label>
      			<input type='text' class='form-control'  value='$qa[nip]' id='nip' name='nip' style='width:850px;' disabled>
      		</div>
			  
			<div class='form-group'>
				<label for='nama_lengkap'>Nama Lengkap:</label>
				<input type='text' class='form-control'  value='$qa[nama_lengkap]' id='nama_lengkap' name='nama_lengkap' disabled >
			</div>

			<div class='form-group'>
			<label for='tempat_lhr'>Tempat Lahir:</label>
			<input type='text' class='form-control'  value='$qa[tempat_lhr]' id='tempat_lhr' name='tempat_lhr' >
			</div>

			<div class='form-group'>
			<label for='tgl_lhr'>Tanggal Lahir:</label>
			<input type='text' class='form-control'  value='$qa[tgl_lhr]' id='my_dtp1' name='tgl_lhr' >
			</div>
			
			<div class='form-group'>
			<label for='alamat'>Alamat:</label>
			<input type='text' class='form-control'  value='$qa[alamat]' id='alamat' name='alamat' >
			</div>

			<div class='form-group'>
				<label for='email'>Email:</label>
				<input type='text' class='form-control'  value='$qa[email]' id='email' name='email' disabled>
			</div>

			<div class='form-group'>
				<label for='no_telp'>Nomor HP/ Telpon:</label>
				<input type='text' class='form-control'  value='$qa[no_telp]' id='no_telp' name='no_telp' disabled>
			</div>
			
			<div class='form-group'>
				<label for='unit'>Unit Kerja:</label>
				
			  	<select class='form-control' name ='unit' style='width:850px;'>
			  <option value='$qa[unit]' selected>$qa[unit] | $qa[nama_unit]</OPTION>
			  ";
				$qunit=mysql_query("SELECT * FROM kpn_unit ORDER BY kode ASC");
				  while ($qu=mysql_fetch_array($qunit)){
				  echo "<option value='$qu[kode]'>$qu[kode] | $qu[nama_unit]</option>";	
				}
				echo "
				  </select>	  		   	
			</div>


			<div class='form-group'>
				<label for='bank'>Bank:</label>
				
			  	<select class='form-control' name ='bank' style='width:850px;'>
			  <option value='$qa[bank]' selected>$qa[bank] | $nb[nama_bank]</OPTION>
			  ";
				$qbank=mysql_query("SELECT * FROM kpn_bank ORDER BY kode ASC");
				  while ($qb=mysql_fetch_array($qbank)){
				  echo "<option value='$qb[kode]'>$qb[kode] | $qb[nama_bank]</option>";	
				}
				echo "
				  </select>	  		   	
			</div>

			<div class='form-group'>
			<label for='norek'>Nomor Rekening:</label>
			<input type='text' class='form-control'  value='$qa[norek]' id='norek' name='norek' >
			</div>

			<div class='form-group'>
			<label for='tgl_daftar'>Tanggal Pendaftaran:</label>
			<input type='text' class='form-control'  value='$qa[tgl_daftar]' id='my_dtp2' name='tgl_daftar' >
			</div>

			<div class='form-group'>
				<label for='aktif'>Status Aktif:</label>
				
			  	<select class='form-control' name ='aktif' style='width:850px;'>
			  		<option value='$qa[aktif]' selected>$qa[aktif]</OPTION>
					<option value='Y'>Y</OPTION>
					<option value='N'>N</OPTION>
			  
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
