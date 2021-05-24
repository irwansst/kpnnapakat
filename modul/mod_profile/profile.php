<?php
if ($_SESSION['leveluser']=='admin'){
	echo "Ini Halaman Admin";
}else{
	include "../../config/koneksi.php";
	$aksi="modul/mod_profile/aksi_profile.php";
		//menampilkan halaman user
	
	switch($_GET[act]){
		default:

			$profil = mysql_query("SELECT a.id, a.nip, a.nama_peg, b.uraian, b.roman, c.jabatan 
 			from pegawai a left join golongan b on a.gol=b.kode
 			left join jabatan c on a.jabatan=c.id_jabatan		 			
 			 WHERE nip='$_SESSION[namauser]'");
  			$r    = mysql_fetch_array($profil);
echo "
	<div class='card shadow mb-4'>
	<div class='card-header py-3'><h6 class='m-0 font-weight-bold text-primary'>Profil Pegawai</h6></div>
	
	<div class='row'>	
	<div class='card-body'>
		<a href='?op=profile&act=editprofile' class='btn btn-warning btn-icon-split'>
          <span class='icon text-white-50'>
             <i class='fas fa-pencil-alt'></i>
          </span>
          <span class='text'>Ubah</span>	
      </a>     
   </div>
	</div>   
   <br />

		<div class='h6 mb-0 font-weight-normal'>		
		<div class='row'>
			<div class='card-body'>
			<table width='100%'>
				<tr><td width=15%>NIP</td><td>:</td><td>$r[nip]</td></tr>
				<tr><td>Nama</td><td>:</td><td>$r[nama_peg]</td></tr>
				<tr><td>Pangkat</td><td>:</td><td>$r[uraian] $r[roman]</td></tr>
				<tr><td>Jabatan</td><td>:</td><td>$r[jabatan]</td></tr>
			</table> 
			</div>
		</div>	

		</div>		
		</div>
	</div>
";

	break;
	
	case "editprofile":
	
	$profil = mysql_query("SELECT a.id, a.nip, a.nama_peg, a.gol, a.es2, c.es2 as eselon2, a.es3,
					a.es4, a.jabatan, b.uraian, b.roman from pegawai a left join golongan b 
					on a.gol=b.kode left join es2 c on a.es2=c.id_es2 WHERE nip='$_SESSION[namauser]'");
 	$r    = mysql_fetch_array($profil);

	echo "
	<div class='card shadow mb-4'>
	<div class='card-header py-3'><h6 class='m-0 font-weight-bold text-primary'>Profile</h6></div>

	
	<div class='card-body'>
	<div class='row'>    
	<div class='h6 mb-0 font-weight-normal text-gray-600'>
		<form method=POST action='$aksi?op=profile&act=update'>
			<div class='form-group'>    		
    		<input type='hidden' name='id' value='$r[id]'>
			</div>			
			
			<div class='form-group'>
      	<label for='nip'>N.I.P :</label>
      	<input type='text' class='form-control'  value='$r[nip]' id='nip' name='nip' readonly>
      	</div>
      	
      	<div class='form-group'>
      	<label for='nama_peg'>Nama Pegawai :</label>
      	<input type='text' class='form-control'  value='$r[nama_peg]' id='nama_peg' name='nama_peg' readonly>
      	</div>    		
    		     	
      	<div class='form-group'>
      	<label for='gol'>Pilih Golongan:</label>
    		<select class='form-control' id='gol' name='gol' style='width:850px;'>
    			<option value='$r[gol]' selected>$r[uraian] $r[roman]</OPTION>";
				$kueri=mysql_query("SELECT * FROM golongan ORDER BY kode ASC");
				while ($k=mysql_fetch_array($kueri)){
				echo "<option value='$k[kode]'>$k[uraian] $k[roman]</option>";		
				}
			echo "</select>	  		   	
   		</div>
   		
        	<div class='form-group'>
      	<label for='es2'>Unit Eselon II:</label>
 				<select class='form-control' id='es2' name='es2' style='width:850px;'>
				<option value='$r[es2]' selected>$r[eselon2]</OPTION>";
				$kueri1=mysql_query("SELECT * FROM es2 ORDER BY id_es2 ASC");
				while ($k=mysql_fetch_array($kueri1)){
					echo "<option value='$k[id_es2]'>$k[es2]</option>";
					}
			echo "</select>	  		   	
   		</div>
   		
   		<div class='form-group'>
      	<label for='es3'>Unit Eselon III:</label>
 				<select class='form-control' id='es3' name='es3' style='width:850px;'>
				<option value='$r[es3]' selected>-Pilih Eselon III-</OPTION>";
				$kueri2=mysql_query("SELECT * FROM es3 INNER JOIN es2 ON es3.id_es2_fk=es2.id_es2 ORDER BY es3.id_es3 ASC ");
				while ($l=mysql_fetch_array($kueri2)){
					echo "<option class='$l[id_es2]' value='$l[id_es3]'>$l[es3]</option>";
					}
			echo "</select>	  		   	
   		</div>
   		
   		<div class='form-group'>
      	<label for='es4'>Unit Eselon IV:</label>
 				<select class='form-control' id='es4' name='es4' style='width:850px;'>
				<option value='$r[es4]' selected>-Pilih Eselon IV-</OPTION>";
				$kueri3=mysql_query("SELECT * FROM es4 INNER JOIN es3 ON es4.id_es3_fk=es3.id_es3 ORDER BY es4.id_es4 ASC ");
				while ($m=mysql_fetch_array($kueri3)){
				echo "<option class='$m[id_es3]' value='$m[id_es4]'>$m[es4]</option>";
					}
			echo "</select>	  		   	
   		</div>
   		
   		<div class='form-group'>
      	<label for='jabatan'>Pilih Jabatan:</label>
 				<select class='form-control' id='jabatan' name='jabatan' style='width:850px;'>
				<option value='$r[jabatan]' selected>-Pilih Jabatan-</OPTION>";
				$kueri4=mysql_query("SELECT * FROM jabatan INNER JOIN es4 ON jabatan.id_es4_fk=es4.id_es4 ORDER BY jabatan.id_jabatan ASC ");
				while ($n=mysql_fetch_array($kueri4)){
				echo "<option class='$n[id_es4]' value='$n[id_jabatan]'>$n[jabatan]</option>";
					}
			echo "</select>	  		   	
   		</div>
   		
    		<button type='submit' class='btn btn-primary'>Simpan</button>
  		</form>
	</div>
	</div>
	</div>
	</div>
	
	</div>
	";

	break;

}
}
?>