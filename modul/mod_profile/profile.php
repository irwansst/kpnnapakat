<?php
if ($_SESSION['leveluser']=='admin'){

	include "../../config/koneksi.php";
	$aksi="modul/mod_profile/aksi_profile.php";
		//menampilkan halaman admin

	switch($_GET[act]){
		default:

		$show = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM one_users WHERE username='$_SESSION[namauser]'");
			$r    = mysqli_fetch_array($show);

		echo "
		<div class='card shadow mb-4'>
		<div class='card-header py-3'><h5 class='m-0 font-weight-bold text-primary'>PROFIL PENGGUNA</h5></div>

		<div class='card-body'>
		<div class='row'>
		<div class='h6 mb-0 font-weight-normal text-gray-600'>
		<img src='photos/".$_SESSION[namauser].".jpg' height='300px' width='250px'>
		<br>
		<a href=?op=profile&act=uploadfoto class='btn btn-success'>GANTI FOTO</a>

			<form method=POST action='$aksi?op=users&act=update'>
				<div class='form-group'>
					<input type='hidden' name='id' value='$r[id]'>
				</div>

				<div class='form-group'>
					<label for='username'>Username:</label>
							<input type='text' class='form-control'  value='$r[username]' id='username' name='username' size='75' readonly='readonly'>
						</div>

				<!--
				<div class='form-group'>
					<label for='password'>Password:</label>
					<input type='text' class='form-control'  value='$r[password]' id='password' name='password'>
				</div>
				-->

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
					<label for='kd_satker'>Kode Satker:</label>
					<input type='text' class='form-control'  value='$r[kd_satker]' id='kd_satker' name='kd_satker'>
				</div>

				<div class='form-group'>
					<label for='level'>Level:</label>
					<input type='text' class='form-control'  value='$r[level]' id='level' name='level' disabled>
				</div>

				<div class='form-group'>
					<label for='blokir'>Status Blokir:</label>
					<input type='text' class='form-control'  value='$r[blokir]' id='blokir' name='blokir' disabled>
				</div>


				<!--
				<div class='form-group'>
				<label for='level'>Level Pengguna:</label>
					<select class='form-control' name ='level' style='width:850px;' disabled='disabled' >
						<option value='$r[level]' selected >$r[level]</OPTION>
						<option value='user'>user</option>
						<option value='admin'>admin</option>
					</select>
				</div>

				<div class='form-group'>
				<label for='blokir'>Status Blokir:</label>
					<select class='form-control' name='blokir' style='width:850px;' disabled='disabled'>
						<option value='$r[blokir]' selected disabled>$r[blokir]</OPTION>
						<option value='N'>N</option>
						<option value='Y'>Y</option>
					</select>
				</div>
				-->
					<button type='submit' class='btn btn-primary'>Simpan</button>
				</form>
		</div>
		</div>
		</div>

		</div>
		";

break;

//Upload FOTO
case "uploadfoto":

echo "
	<div class='card shadow mb-4'>
	<div class='card-header py-3'><h5 class='m-0 font-weight-bold text-primary'>UPLOAD FOTO PENGGUNA</h5></div>

	<div class='card-body'>
	<div class='row'>
	<div class='h6 mb-0 font-weight-normal text-gray-600'>
		<form method='POST' action='$aksi?op=profile&act=uploadpics' enctype='multipart/form-data' >

		<div class='form-group'>
			<label for='foto'>Upload Foto</label>
			<input type='file' class='form-control' id='foto' name='foto' >
			 <p style='color: red'>Hanya file ekstensi .jpg dengan ukuran maksimal 2 MB</p>
		</div>

		<button type='submit' class='btn btn-primary' name='uploadfoto' value='Upload'>Upload</button>
  		</form>
	</div>
	</div>
	</div>

	</div>
	";

break;

//mengubah data users
case "editprofile":

	$edit = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM one_users WHERE id='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);

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
      			<input type='text' class='form-control'  value='$r[username]' id='username' name='username' size='75'>
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
				<label for='kd_satker'>Kode Satker:</label>
				<input type='text' class='form-control'  value='$r[kd_satker]' id='kd_satker' name='kd_satker'>
			</div>

			<div class='form-group'>
				<label for='level'>Level:</label>
				<input type='text' class='form-control'  value='$r[level]' id='level' name='level' disabled>
			</div>

			<div class='form-group'>
				<label for='blokir'>Status Blokir:</label>
				<input type='text' class='form-control'  value='$r[blokir]' id='blokir' name='blokir' disabled>
			</div>


			<!--
			<div class='form-group'>
			<label for='level'>Level Pengguna:</label>
			  <select class='form-control' name ='level' style='width:850px;' disabled='disabled' >
				  <option value='$r[level]' selected >$r[level]</OPTION>
				  <option value='user'>user</option>
				  <option value='admin'>admin</option>
				</select>
			</div>

			<div class='form-group'>
			<label for='blokir'>Status Blokir:</label>
			  <select class='form-control' name='blokir' style='width:850px;' disabled='disabled'>
				  <option value='$r[blokir]' selected disabled>$r[blokir]</OPTION>
				  <option value='N'>N</option>
				  <option value='Y'>Y</option>
				</select>
			</div>
			-->
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

//HALAMAN USER
include "../../config/koneksi.php";
$aksi="modul/mod_profile/aksi_profile.php";
	//menampilkan halaman admin

switch($_GET[act]){
	default:

	$show = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM one_users WHERE username='$_SESSION[namauser]'");
		$r    = mysqli_fetch_array($show);

	echo "
	<div class='card shadow mb-4'>
	<div class='card-header py-3'><h5 class='m-0 font-weight-bold text-primary'>PROFIL PENGGUNA</h5></div>

	<div class='card-body'>
	<div class='row'>
	<div class='h6 mb-0 font-weight-normal text-gray-600'>
	<img src='photos/".$_SESSION[namauser].".jpg' height='300px' width='250px'>
	<br>
	<a href=?op=profile&act=uploadfoto class='btn btn-success'>GANTI FOTO</a>

		<form method=POST action='$aksi?op=users&act=update'>
			<div class='form-group'>
				<input type='hidden' name='id' value='$r[id]'>
			</div>

			<div class='form-group'>
				<label for='username'>Username:</label>
						<input type='text' class='form-control'  value='$r[username]' id='username' name='username' size='75' readonly='readonly'>
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
				<label for='kd_satker'>Kode Satker:</label>
				<input type='text' class='form-control'  value='$r[kd_satker]' id='kd_satker' name='kd_satker'>
			</div>

			<div class='form-group'>
				<label for='level'>Level:</label>
				<input type='text' class='form-control'  value='$r[level]' id='level' name='level' disabled>
			</div>

			<div class='form-group'>
				<label for='blokir'>Status Blokir:</label>
				<input type='text' class='form-control'  value='$r[blokir]' id='blokir' name='blokir' disabled>
			</div>


			<!--
			<div class='form-group'>
			<label for='level'>Level Pengguna:</label>
				<select class='form-control' name ='level' style='width:850px;' disabled='disabled' >
					<option value='$r[level]' selected >$r[level]</OPTION>
					<option value='user'>user</option>
					<option value='admin'>admin</option>
				</select>
			</div>

			<div class='form-group'>
			<label for='blokir'>Status Blokir:</label>
				<select class='form-control' name='blokir' style='width:850px;' disabled='disabled'>
					<option value='$r[blokir]' selected disabled>$r[blokir]</OPTION>
					<option value='N'>N</option>
					<option value='Y'>Y</option>
				</select>
			</div>
			-->
				<button type='submit' class='btn btn-primary'>Simpan</button>
			</form>
	</div>
	</div>
	</div>

	</div>
	";

break;

//Upload FOTO
case "uploadfoto":

echo "
<div class='card shadow mb-4'>
<div class='card-header py-3'><h5 class='m-0 font-weight-bold text-primary'>UPLOAD FOTO PENGGUNA</h5></div>

<div class='card-body'>
<div class='row'>
<div class='h6 mb-0 font-weight-normal text-gray-600'>
	<form method='POST' action='$aksi?op=profile&act=uploadpics' enctype='multipart/form-data' >

	<div class='form-group'>
		<label for='foto'>Upload Foto</label>
		<input type='file' class='form-control' id='foto' name='foto' >
		 <p style='color: red'>Hanya file ekstensi .jpg dengan ukuran maksimal 2 MB</p>
	</div>

	<button type='submit' class='btn btn-primary' name='uploadfoto' value='Upload'>Upload</button>
		</form>
</div>
</div>
</div>

</div>
";

break;

//mengubah data users
case "editprofile":

$edit = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM one_users WHERE id='$_GET[id]'");
	$r    = mysqli_fetch_array($edit);

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
					<input type='text' class='form-control'  value='$r[username]' id='username' name='username' size='75'>
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
			<label for='kd_satker'>Kode Satker:</label>
			<input type='text' class='form-control'  value='$r[kd_satker]' id='kd_satker' name='kd_satker'>
		</div>

		<div class='form-group'>
			<label for='level'>Level:</label>
			<input type='text' class='form-control'  value='$r[level]' id='level' name='level' disabled>
		</div>

		<div class='form-group'>
			<label for='blokir'>Status Blokir:</label>
			<input type='text' class='form-control'  value='$r[blokir]' id='blokir' name='blokir' disabled>
		</div>


		<!--
		<div class='form-group'>
		<label for='level'>Level Pengguna:</label>
			<select class='form-control' name ='level' style='width:850px;' disabled='disabled' >
				<option value='$r[level]' selected >$r[level]</OPTION>
				<option value='user'>user</option>
				<option value='admin'>admin</option>
			</select>
		</div>

		<div class='form-group'>
		<label for='blokir'>Status Blokir:</label>
			<select class='form-control' name='blokir' style='width:850px;' disabled='disabled'>
				<option value='$r[blokir]' selected disabled>$r[blokir]</OPTION>
				<option value='N'>N</option>
				<option value='Y'>Y</option>
			</select>
		</div>
		-->
			<button type='submit' class='btn btn-primary'>Simpan</button>
		</form>
</div>
</div>
</div>

</div>
";

break;


	}
}
?>
