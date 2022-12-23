<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_sKeluar/aksi_sKeluar.php";

switch($_GET[act]){
  
  default:
  
    echo "<h1>Surat Keluar periode $_SESSION[periode]</h1>";
    
	echo "<input type=button class='button' value='Tambah Data' onclick=location.href='?op=sKeluar&act=tambahsKeluar'><br><br>";
	
	echo "
	<div class='demo_jui'>
	<table cellpadding='0' cellspacing='0' border='0' class='display' id='example'>
		<thead>
			<tr>
				<th width=20px align=center>No</th>
				<th >Tanggal</th>
				<th >Nomor Agenda</th>
				<th >Jenis Surat</th>				
				<th >Sifat Surat</th>
				<th >Penerbit</th>
				<th>Kepada</th>
				<th>Perihal</th>
				<th>Keterangan</th>
				<th>File</th>
				<th width=100px>Lihat/<br>Ubah</th>
			</tr>
		</thead>
		<tbody>";
		
	$no=1;
    $tampil	= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM sKeluar WHERE  periode='$_SESSION[periode]' ORDER BY stamp DESC");
    while ($r=mysqli_fetch_array($tampil)){
	$noagd=sprintf("%06d",$r[nAgenda]);
	
       echo "<tr>
			 <td align=center>$no</td>
			 <td align=center>$r[tKeluar]</td>
			 <td align=center><b>$noagd</b></td>
			 <td>$r[jSurat]</td>
             <td>$r[uSifat]</td>
             <td>$r[penerbit]</td>
             <td>$r[kepada]</td>
             <td>$r[hal]</td>
             <td>$r[ket]</td>
			 ";
			 
			 // PILIHAN UNTUK UPLOAD FILE
			if (empty($r[nfile])){
				echo "<td><a href=?op=sKeluar&act=uploadFile&id=$r[id_sKeluar]><img class='masterTooltip'  src='images/upload_file.png' border='0' title='Upload File'></a></td>";
				}else{
				echo "<td><a href='arsip/$r[nfile]' target='_blank'><img class='masterTooltip'  src='images/berkas.png' border='0' title='Lihat File'></a></td>";
				}					     
// BATAS UNTUK SCRIPT UPLOAD FILE
			 
			 
        echo "<td align='center' width='100px'>";

		if (empty($r[nArsip])){
			 echo "
			 <a href=?op=sKeluar&act=lihatsKeluar&id=$r[id_sKeluar]><img class='masterTooltip'  src='images/show.png' border='0' title='Lihat Data'></a>
			 <a href=?op=sKeluar&act=editsKeluar&id=$r[id_sKeluar]><img class='masterTooltip'  src='images/edit.png' border='0' title='Ubah Data'></a>
			 <a href=?op=sKeluar&act=tambahsArsip&id=$r[id_sKeluar]><img class='masterTooltip'  src='images/arsip.png' border='0' title='Simpan Arsip'></a>";
			}else{
			echo "
			 <a href=?op=sKeluar&act=lihatsMasuk&id=$r[id_sKeluar]><img class='masterTooltip'  src='images/show.png' border='0' title='Lihat Data'></a>
			 <a href=?op=sKeluar&act=editsMasuk&id=$r[id_sKeluar]><img class='masterTooltip'  src='images/edit.png' border='0' title='Ubah Data'></a>
			 <a href=?op=sArsip&act=lihatsArsip&id=$r[id_sKeluar]><img class='masterTooltip'  src='images/drawer.png' border='0' title='Lihat Arsip'></a>";
			 }
			
	echo "</td>
			 </tr>";
      $no++;
    }	
		echo"</tbody></table></div><div class='spacer'></div>";
	
  break;

  
  case "tambahsKeluar":
      echo "<h1>Tambah SURAT KELUAR</h1>
			<div class='line'></div>
			<div class='box'>";
    echo "	
	        <form method=POST action='$aksi?op=sKeluar&act=input'>
			<label><span>TANGGAL REKAM			</span><input type='text' value='".tgl_indo(date("Y m d"))."' size='15' style='text-align:right;' disabled></label>";	
			
				
			//dropdown jenis surat			
			echo "	<label><span>JENIS SURAT</span>";
		    echo  "<select name='jsurat'>
            <option value=0 selected>- JENIS SURAT -</option>";
            $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM jenis ORDER BY kodejenis ASC");
            while($t=mysqli_fetch_array($tampil)){
            echo "<option value='$t[kodejenis]'>$t[kodejenis]</option>";
            }
			echo "</select></label>";
			
			//dropdown kontrol surat			
			echo "	<label><span>KONTROL SURAT</span>";
		    echo  "<select name='nkontrol'>
            <option value=0 selected>- KONTROL SURAT -</option>";
            $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT kontrol FROM rjabatan ORDER BY kode ASC");
            while($t=mysqli_fetch_array($tampil)){
            echo "<option value='$t[kontrol]'>$t[kontrol]</option>";
            }
			echo "</select></label>";
			
			//dropdown sifat surat
			echo "	<label><span>SIFAT SURAT</span>";
		    echo  "<select name='usifat'>
            <option value=0 selected>- SIFAT SURAT -</option>";
            $metu=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rSifat ORDER BY id ASC");
            while($m=mysqli_fetch_array($metu)){
            echo "<option value='$m[sifat]'>$m[sifat]</option>";
            }
			echo "</select></label>
			
			<label><span>LAMPIRAN			</span><input type='text' name='jlampiran' size='10'></label>";			
			//dropdown bidang penerbit
			echo "	<label><span>PENERBIT SURAT</span>";
		    echo  "<select name='penerbit'>
            <option value=0 selected>- BIDANG ATAU SEKSI-</option>";
            $melu=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rjabatan ORDER BY id ASC");
            while($ml=mysqli_fetch_array($melu)){
            echo "<option value='$ml[jabatan]'>$ml[jabatan]</option>";
            }
			echo "</select></label>		
		
		<div class='autocomplete'><label for='kantor'><span>TUJUAN SURAT			</span><input type='text' name='kepada' size='70' id='kantor'></label></div>
			
			<label><span>PERIHAL SURAT			</span><input type='text' name='hal' size='70'></label>
			<label><span>KETERANGAN SURAT			</span><input type='text' name='ket' size='70'></label>	
							
		<input type=submit class=button value=Simpan>
		<input type=button value=Batal class=button onclick=self.history.back()>
          </form></div>";

    break;
  

  case "editsKeluar":
    $edit = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM skeluar WHERE id_sKeluar='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);
	
	
	echo "<h1>Ubah Surat Keluar</h1>
			<div class='line'></div>
			<div class='box'>";
    echo "
        <form method=POST action=$aksi?op=sKeluar&act=update>
        <input type=hidden name=id value=$r[id_sKeluar]>
		
		<label><span>TANGGAL SURAT KELUAR	</span><input type='text' value='$r[tKeluar]' size='15' style='text-align:right;' id='datepicker' name='tkeluar'></label>
		<label><span>NOMOR AGENDA			</span><input type='text' name='nagenda' value='$r[nAgenda]' size='6'></label>
		<label><span>JENIS SURAT</span>";
		    echo  "<select name='jsurat'>
            <option value=$r[jSurat] selected>$r[jSurat]</option>";
            $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM jenis ORDER BY kodejenis ASC");
            while($t=mysqli_fetch_array($tampil)){
            echo "<option value='$t[kodejenis]'>$t[kodejenis]</option>";
            }
		  echo "</select></label>";
		  
			//dropdown kontrol surat			
			echo "	<label><span>KONTROL SURAT</span>";
		    echo  "<select name='nkontrol'>
            <option value=$r[nKontrol] selected>$r[nKontrol]</option>";
            $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT kontrol FROM rjabatan ORDER BY kode ASC");
            while($t=mysqli_fetch_array($tampil)){
            echo "<option value='$t[kontrol]'>$t[kontrol]</option>";
            }
			echo "</select></label>";

			//dropdown sifat surat
			echo "	<label><span>SIFAT SURAT</span>";
		    echo  "<select name='usifat'>
            <option value=$r[uSifat] selected>$r[uSifat]</option>";
            $metu=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rSifat ORDER BY id ASC");
            while($m=mysqli_fetch_array($metu)){
            echo "<option value='$m[sifat]'>$m[sifat]</option>";
            }
			echo "</select></label>
		
		<label><span>LAMPIRAN			</span><input type='text' name='jlampiran' value='$r[jLampiran]' size='40'></label>";
		
			//dropdown bidang penerbit
			echo "	<label><span>PENERBIT SURAT</span>";
		    echo  "<select name='penerbit'>
            <option value='$r[penerbit]' selected>$r[penerbit]</option>";
            $melu=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rjabatan ORDER BY id ASC");
            while($ml=mysqli_fetch_array($melu)){
            echo "<option value='$ml[jabatan]'>$ml[jabatan]</option>";
            }
			echo "</select></label>			
		
<div class='autocomplete'><label for='kantor'><span>DITUJUKAN KEPADA			</span><input type='text' name='kepada' size='70' id='kantor' value='$r[kepada]'></label></div>			
		
		<label><span>PERIHAL SURAT			</span><input type='text' name='hal' value='$r[hal]' size='70'></label>

		<label><span>KETERANGAN	</span><input type='text' name='ket' value='$r[ket]' size='70'></label>		
		
	 
		<input type=submit class=button value=Update>
        <input type=button class=button value=Batal onclick=self.history.back()></td></tr>
        </form></div>";
    break;
	
	case "lihatsKeluar":
    $edit = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM sKeluar as a left join jenis as b on a.jSurat=b.kodejenis WHERE id_sKeluar='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);
	
	$tgl	= tgl_indo($r[tSurat]);
	$tgl1	= tgl_indo($r[tMasuk]);
	
	//memformat nomor agenda
	$noagd 	= sprintf("%06d",$r[nAgenda]);
	

	echo "<h1>Detail Informasi</h1>
			<div class='line'></div>
			<div class='box'>";
			
    echo "
          <form method=POST action=$aksi?op=sKeluar&act=update>
                   
		  <label><span>TERAKHIR DIBUAT/UPDATE</span>: <b>$r[stamp]</b></label>
		  <label><span>PERIODE</span>: <b>$r[periode]</b></label><br>

		  <label><span>NOMOR SURAT</span>: <b>$r[jSurat]-$noagd$r[nKontrol]$r[periode]</b></label>
		  <label><span>TANGGAL REKAM SURAT</span>: $r[tKeluar]</label><br>
		  
		  <label><span>JENIS SURAT</span>: $r[urjenis]</label>
		  <label><span>SIFAT SURAT </span>: $r[uSifat]</label>
		  <label><span>JUMLAH LAMPIRAN SURAT</span>: $r[jLampiran]</label>
		  <label><span>PENERBIT SURAT</span>: $r[penerbit]</label>
		  <label><span>TUJUAN SURAT</span>: $r[kepada]</label>
		  <label><span>PERIHAL SURAT</span>: $r[hal]</label>
		  <label><span>KETERANGAN TAMBAHAN</span>: $r[ket]</label>     

          <br><br><input type=button class=button value=Kembali onclick=self.history.back()></td></tr>
          </form></div>";
    break; 

  case "tambahsArsip":
	     echo "<h1>PENGARSIPAN SURAT KELUAR</h1>
			<div class='line'></div>
			<div class='box'>";
  echo "	
	        <form method='POST' enctype='multipart/form-data' action='modul/mod_sArsip/aksi_sArsip_out.php?op=sArsip&act=input'>
			<input  type='hidden' name='id' value='$_GET[id]' size='6'>
			<label><span>TANGGAL REKAM			</span><input type='text' name='tarsip' value='".tgl_indo(date("Y m d"))."' size='15' style='text-align:right;' disabled></label>";	
			
		
			//dropdown klasifikasi arsip		
			echo "	<label><span>KLASIFIKASI ARSIP</span>";
		    echo  "<select name='jklasifikasi' style='width:450px'>
            <option value=0 selected>- KLASIFIKASI -</option>";
            $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rklasifikasi ORDER BY kode ASC");
            while($t=mysqli_fetch_array($tampil)){
            echo "<option value='$t[kode]'>$t[kode]&emsp;&emsp;|&emsp;$t[jenis]</option>";
            }
			echo "</select></label>";
			
			//dropdown jenis arsip
			echo "	<label><span>JENIS ARSIP</span>";
		    echo  "<select name='jarsip' style='width:155px'>
            <option value=0 selected>- JENIS -</option>";
            $metu=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rarsip ORDER BY jnsarsip ASC");
            while($m=mysqli_fetch_array($metu)){
            echo "<option value='$m[jnsarsip]'>$m[jnsarsip]</option>";
            }
			echo "</select></label>
			
			<label><span>TANGGAL INAKTIF		</span><input type='text' name='inaktif' id='datepicker' size='15'></label>";
			
			//dropdown bidang pengelola arsip
			echo "	<label><span>BAGIAN/BIDANG</span>";
		    echo  "<select name='bidang' style='width:450px'>
            <option value=0 selected>- BAGIAN/BIDANG -</option>";
            $metu=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rjabatan ");
            while($m=mysqli_fetch_array($metu)){
            echo "<option value='$m[kode]'>$m[kode]&emsp;|&emsp;$m[urbidang]</option>";
            }
			echo "</select></label>";
			
			//dropdown nomor rak
			echo "	<label><span>NOMOR RAK</span>";
		    echo  "<select name='nrak' style='width:155px'>
            <option value=0 selected>- RAK -</option>";
				$no=0;
				while ($no++ < 20){
					$norak=sprintf("%02d",$no);
					echo "<option value='$norak'>$norak</option>";
				}
			echo "</select></label>";
			
			echo "	<label><span>NOMOR BOX</span>";
		    echo  "<select name='nbox' style='width:155px'>
            <option value=0 selected>- BOX -</option>";
				$no=0;
				while ($no++ < 20){
					$nobox=sprintf("%02d",$no);
					echo "<option value='$nobox'>$nobox</option>";
				}
			echo "</select></label>";
			
			//dropdown nomor folder
			echo "	<label><span>NOMOR FOLDER/DOSIR</span>";
		    echo  "<select name='nfolder' style='width:155px'>
            <option value=0 selected>- FOLDER -</option>";
				$no=0;
				while ($no++ < 50){
					$norak=sprintf("%02d",$no);
					echo "<option value='$norak'>$norak</option>";
				}
			echo "</select></label>";
			
			//dropdown nomor baris
			echo "	<label><span>NOMOR BARIS</span>";
		    echo  "<select name='nbaris' style='width:155px'>
            <option value=0 selected>- BARIS -</option>";
				$no=0;
				while ($no++ < 20){
					$nobar=sprintf("%02d",$no);
					echo "<option value='$nobar'>$nobar</option>";
				}
			echo "</select></label>";
			
			//dropdown nomor rak
			echo "	<label><span>NOMOR KOLOM</span>";
		    echo  "<select name='nkolom' style='width:155px'>
            <option value=0 selected>- KOLOM -</option>";
				$no=0;
				while ($no++ < 20){
					$nokol=sprintf("%02d",$no);
					echo "<option value='$nokol'>$nokol</option>";
				}
			
			echo "</select></label>";
			
			$show	= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM skeluar WHERE  id_sKeluar='$_GET[id]'");
    
	if ($s=mysqli_fetch_array($show)){
		echo "<label ><span >BERKAS FILE</span><input type='text' name='nmFile' value='$s[nfile]'></label>";
		echo "<label><span>KETERANGAN</span><textarea align='left' name='ket' style='width:450px' rows='7'>Surat \nTanggal Agenda: $s[tKeluar] \nNomor Surat: $s[nAgenda]$s[nKontrol]$s[periode] \nPenerbit: $s[penerbit] \nKepada: $s[kepada] \nHal Surat: $s[hal] \nKeterangan: $s[ket]</textarea></label>";
		}else{
		echo "<label ><span >BERKAS FILE</span><input type='text' name='nmFile' value='$s[nfile]'></label>";
		echo "<label><span>KETERANGAN</span><textarea align='left' name='ket' cols='58' rows='7'></textarea></label>";
		};		
			
		echo "<input type=submit class=button value=Simpan name=btn-upload>
		<input type=button value=Batal class=button onclick=self.history.back()>
          </form> 
		  </div>";
		  

    break;

//PROSEDUR UPLOAD FILE
case "uploadFile":
	
	echo "<h1>Upload Berkas File</h1>
			<div class='line'></div>
			<div class='demo-jui'>
			<form method='post' enctype='multipart/form-data' action='$aksi?op=sKeluar&act=upload'>
				<table width=50% cellpadding='0' cellspacing='0' border='0' class='display' id='example'>
				<input type='hidden' name='id' value='$_GET[id]' size='6'>
				<tr>
				<td style='font-size:16px; font-weight:bold;'><font color='red'>Pastikan file yang akan diunggah tidak memiliki spasi!!!</font></td>
				</tr>
				<tr>
				<td><input type='file' name='img' /></td>
				</tr>
				<tr>
				<td><button type='submit' name='btn-upload'>upload</button></td>
				</tr>
				</table>
			</form></div>";
break;


//batas kurung kurawal
}
}
?>
