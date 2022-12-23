<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
		 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";
include "../../plugin/var.php";

$aksi="modul/mod_periode/aksi_periode.php";

switch($_GET[act]){
  // Tampil User

  default:

  $tahun = $_SESSION[periode];
echo "
	<div class='card shadow mb-4'>
		<div class='card-header py-3'><h6 class='m-0 font-weight-bold text-primary'>Ganti Periode</h6></div>

			<div class='card-body'>
			<div class='row'>
			<div class='h6 mb-0 font-weight-normal text-gray-600'>
				<form method=POST action='$aksi?op=periode&act=update'>
					<div class='form-group'>
      				<label for='kegiatan'>Periode:</label>
      				<select class='form-control' id='periode' name='periode'>
      					<option value='$tahun' selected>$tahun</option>
							<option value='2019'>2019</option>
      					<option value='2020'>2020</option>
      					<option value='2021'>2021</option>
      					<option value='2022'>2022</option>
      					<option value='2023'>2023</option>
    					</select>
      			</div>
    					<button type='submit' class='btn btn-primary'>Ganti Periode</button>
  				</form>
			</div>
			</div>
			</div>
	</div>
";

	/**
   echo "<h1>Periode</h1>
			<div class='line'></div>
			<div class='box'>";
   echo "
          <form class='dm_form' method=POST action=$aksi?op=periode&act=update>";
	echo "
	<div class='clear'></div>";
	?>
	<label><span>Ubah Periode</span><input type="text" name="periode" value="<?php  echo $_SESSION['periode'] ?>"></label>
	<label><span></span><font color=red>Ubah Tahun Periode diatas sesuai dengan Tahun Periode yang Anda inginkan</font></label>



	<?php
	ECHO "</div>";	  ?>
	<div id=clear></div>
	<br><input class="button" id="submit" type="submit" onClick="" value="Rubah Periode !!">
    <?php echo "</form>";

    **/

  break;
}
}
?>
