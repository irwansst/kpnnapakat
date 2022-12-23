<?php
if ($_SESSION['leveluser']=='admin'){
	echo "Ini Halaman Admin";
}else{
	include "../../config/koneksi.php";
	$aksi="modul/mod_lembur/aksi_lembur.php";
		//menampilkan halaman user
	
	switch($_GET[act]){
		default:

echo "
	<div class='card shadow mb-4'>
	<div class='card-header py-3'><h6 class='m-0 font-weight-bold text-primary'>Potensi Lembur</h6></div>
	
	<div class='card-body'>
	<div class='row'>    
	<div class='h6 mb-0 font-weight-normal'>		
		<div class='table-responsive'>
		<table class='table table-bordered table-sm table-hover' id='dataTable' cellspacing='0' cellpadding='0' >
		<thead>
			<tr class='table-success text-dark'>
				<th >No</th>				
				<th >Waktu</th>
				<th >IKU</th>
				<th >Kegiatan</th>
				<th >Keterangan</th>
			</tr>
		</thead>
		<tbody>";
		$no=1;
		$tampil	= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM log where user='$_SESSION[namauser]' AND hour(waktu) > '17:00:00' OR dayofweek(waktu)=1 OR dayofweek(waktu)=7 AND periode='$_SESSION[periode]' ORDER BY  waktu DESC");
      while ($r=mysqli_fetch_array($tampil)){
	
       echo "<tr class='small text-dark'>
			<td align='center'>$no</td>			
			<td width='100px'>$r[waktu]</td>
			<td >$r[iku]</td>
			<td >$r[kegiatan]</td>
			<td >$r[ket]</td>
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
//menambah rekaman log
case "tambahlog":

echo "		
	<div class='card shadow mb-4'>
	<div class='card-header py-3'><h6 class='m-0 font-weight-bold text-primary'>Rekam Log</h6></div>

	
	<div class='card-body'>
	<div class='row'>    
	<div class='h6 mb-0 font-weight-normal text-gray-600'>
		<form method=POST action='$aksi?op=log&act=input'>
    		
    		<div class='form-group'>
      	<label for='kegiatan'>Kegiatan:</label>
      	<textarea class='form-control' rows='2' id='kegiatan' name='kegiatan' cols='85'></textarea>
      	</div>
      	
      	<div class='form-group'>
      	<label for='iku'>Pilih IKU:</label>
    		<select class='form-control' id='iku' name='iku' style='width:850px;'>
    			<option value=0 selected>Pilih IKU/ Non IKU</OPTION>";
				$kueri=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM iku WHERE user='$_SESSION[namauser]' AND periode='$_SESSION[periode]'  ORDER BY iku ASC");
				while ($k=mysqli_fetch_array($kueri)){
				echo "<option value='$k[iku]'>$k[iku]</option>";		
				}
			echo "</select>	  		   	
   		</div>
   		
   		<div class='form-group'>
      	<label for='ket'>Keterangan:</label>
      	<textarea class='form-control' rows='2' id='ket' name='ket' cols='85'></textarea>
      	</div> 		
    		<button type='submit' class='btn btn-primary'>Simpan</button>
  		</form>
	</div>
	</div>
	</div>
	
	</div>
	";
	
break;
//menambah rekaman log
case "editlog":

	$edit = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM log WHERE id='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);
    
	echo "		
	<div class='card shadow mb-4'>
	<div class='card-header py-3'><h6 class='m-0 font-weight-bold text-primary'>Ubah Log</h6></div>

	
	<div class='card-body'>
	<div class='row'>    
	<div class='h6 mb-0 font-weight-normal text-gray-600'>
		<form method=POST action='$aksi?op=log&act=update'>
			<div class='form-group'>    		
    		<input type='hidden' name='id' value='$r[id]'>
			</div>			
			<div class='form-group'>
      	<label for='waktu'>Waktu:</label>
      	<input type='text' class='form-control'  value='$r[waktu]' id='my_dtp' name='waktu'>
      	</div>    		
    		
    		<div class='form-group'>
      	<label for='kegiatan'>Kegiatan:</label>
      	<textarea class='form-control' rows='2' id='kegiatan' name='kegiatan' cols='85'>$r[kegiatan]</textarea>
      	</div>
      	
      	<div class='form-group'>
      	<label for='iku'>Pilih IKU:</label>
    		<select class='form-control' id='iku' name='iku' style='width:850px;'>
    			<option value='$r[iku]' selected>$r[iku]</OPTION>";
				$kueri=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM iku WHERE user='$_SESSION[namauser]'  ORDER BY iku ASC");
				while ($k=mysqli_fetch_array($kueri)){
				echo "<option value='$k[iku]'>$k[iku]</option>";		
				}
			echo "</select>	  		   	
   		</div>
   		
   		<div class='form-group'>
      	<label for='ket'>Keterangan:</label>
      	<textarea class='form-control' rows='2' id='ket' name='ket' cols='85'>$r[ket]</textarea>
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
}
?>
