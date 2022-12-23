<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_sArsip/aksi_sArsip.php";

switch($_GET[act]){
  
  default:
  
    echo "<h1>Dokumen Arsip periode $_SESSION[periode]</h1>";
    
	echo "<input type=button class='button' value='Tambah Arsip Non Surat' onclick=location.href='?op=sArsip&act=tambahsArsip'><br><br>";
	
	echo "
	<div class='demo_jui'>
	<table cellpadding='0' cellspacing='0' border='0' class='display' id='example'>
		<thead>
			<tr>
				<th width=20px align=center>No</th>
				<th >Tgl. Arsip</th>
				<th >Klasifikasi</th>
				<th >Jenis</th>				
				<th >Status</th>
				<th >Tgl. Inaktif</th>
				<th>R-B-F-B-K</th>			
				<th>Keterangan</th>
				<th>No. Arsip</th>
				<th>File</th>
				<th align=center>Aksi</th>
			</tr>
		</thead>
		<tbody>";
		
	$no=1;
    $tampil	= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM sarsip WHERE  periode='$_SESSION[periode]' ORDER BY stamp DESC");
    while ($r=mysqli_fetch_array($tampil)){
	
       echo "<tr>
			 <td align=center>$no</td>
			 <td width='95px' align=center>$r[tArsip]</td>
			 <td align=center>$r[jKlasifikasi]</td>
			 <td align=center>$r[jArsip]</td>
             <td align=left>$r[status]</td>
             <td width='80px' align=center>$r[inaktif]</td>
             <td width='100px' align=center>$r[rak]-$r[box]-$r[folder]-$r[baris]-$r[kolom]</td>		 
			 <td width='300px'>$r[keterangan]</td>
			 <td>$r[nArsip]</td>
			 <td align=center><a href='arsip/$r[file]' target='_blank'><img src='images/archive16.png'></img></a></td>
		     <td align='center' width='100px'>";
			 
			 
			 echo "<a href='modul/mod_laporan/reg_arsip.php?id=$r[id_sArsip]' target='_blank' ><img class='masterTooltip'  src='images/printer.png' border='0' title='Cetak Register'></a>
			 <a href=?op=sArsip&act=lihatsArsip&id=$r[id_sArsip]><img class='masterTooltip'  src='images/show.png' border='0' title='Lihat Detil Arsip'></a>
			 <a href=?op=sArsip&act=editsArsip&id=$r[id_sArsip]><img class='masterTooltip'  src='images/edit.png' border='0' title='Ubah Data'></a>";
					
	echo "</td>
			 </tr>";
      $no++;
    }	
		echo"</tbody></table></div><div class='spacer'></div>";
	
  break;

  
  case "tambahsArsip":
	     echo "<h1>PENGARSIPAN SURAT MASUK</h1>
			<div class='line'></div>
			<div class='box'>";
  echo "	
	        <form method='POST' enctype='multipart/form-data' action='$aksi?op=sArsip&act=input'>
			<input type='hidden' name='id' value='$_GET[id]' size='6'>
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
            echo "<option value='$m[kode]'>$m[kode]&emsp;|&emsp;$m[bidang]</option>";
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
			
			echo "</select></label>
			
			<label  ><span>FILE ARSIP	</span><input name='img' type='file' style='width:450px'  /></label>";
			
			$show	= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM smasuk WHERE  id_sMasuk='$_GET[id]'");
    
	if ($s=mysqli_fetch_array($show)){
		echo "<label><span>KETERANGAN</span><textarea align='left' name='ket' style='width:450px' rows='7'>Surat \nTanggal Agenda: $s[tMasuk] \nNomor Agenda: $s[nAgenda] \nNomor Surat: $s[nSurat] \nTanggal Surat: $s[tSurat] \nPerihal Surat: $s[hal] \nAsal Surat: $s[dari]</textarea></label>";
		}else{
		echo "<label><span>KETERANGAN</span><textarea align='left' name='ket' cols='58' rows='7'></textarea></label>";
		};		
			
		echo "<input type=submit class=button value=Simpan name=btn-upload>
		<input type=button value=Batal class=button onclick=self.history.back()>
          </form> 
		  </div>";
		  

    break;
  

  case "editsArsip":
    $edit = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM sArsip WHERE id_sArsip='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);
	
	
	echo "<h1>Ubah sArsip</h1>
			<div class='line'></div>
			<div class='box'>";
    echo "
        <form method=POST action=$aksi?op=sArsip&act=update>
        <input type=hidden name=id value=$r[id_sArsip]>
		
		<label><span>TANGGAL SURAT MASUK	</span><input type='text' value='".tgl_indo(date("Y m d"))."' size='15' style='text-align:right;' disabled></label>
		<label><span>NOMOR AGENDA			</span><input type='text' name='nagenda' value='$r[nAgenda]' size='6'></label>
		<label><span>JENIS SURAT</span>";
		    echo  "<select name='jsurat'>
            <option value=$r[jSurat] selected>$r[jSurat]</option>";
            $tampil=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM jenis ORDER BY kodejenis ASC");
            while($t=mysqli_fetch_array($tampil)){
            echo "<option value='$t[kodejenis]'>$t[kodejenis]</option>";
            }
		  echo "</select></label>";
		  
			//dropdown sifat surat
			echo "	<label><span>SIFAT SURAT</span>";
		    echo  "<select name='usifat'>
            <option value='$r[uSifat]' selected>$r[uSifat]</option>";
            $metu=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rSifat ORDER BY id ASC");
            while($m=mysqli_fetch_array($metu)){
            echo "<option value='$m[sifat]'>$m[sifat]</option>";
            }
			echo "</select></label>
		
		<label><span>NOMOR SURAT			</span><input type='text' name='nsurat' value='$r[nSurat]' size='40'></label>
		<label><span>TANGGAL SURAT			</span><input type='text' name='tsurat' value='$r[tSurat]' id='datepicker' size='15'></label>
			<label><span>LAMPIRAN			</span><input type='text' name='jlampiran' value='$r[jLampiran]' size='10'></label>
		
		<div class='autocomplete'><label for='kantor'><span>SURAT TERIMA DARI			</span><input type='text' name='dari' size='70' id='kantor' value='$r[dari]'></label></div>		
					
		
		<label><span>PERIHAL SURAT			</span><input type='text' name='hal' value='$r[hal]' size='70'></label>
		
		<label><span>DISPOSISI SURAT KEPADA	</span>";
			
			//dropdown disposisi surat
			echo "<select name='dispo'>
					<option value='$r[dispo]' selected>$r[dispo]</OPTION>";
					$jabatan=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rJabatan ORDER BY kode ASC");
					while ($jb=mysqli_fetch_array($jabatan)){
					echo "<option value='$jb[jabatan]'>$jb[jabatan]</option>";		
					}
			echo "</select></label>
			
			<label><span>STATUS	</span>";
			
			//dropdown status surat
			echo "<select name='status'>
					<option value=$r[status] selected>$r[status]</OPTION>";
					$status=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rStatus ORDER BY id ASC");
					while ($st=mysqli_fetch_array($status)){
					echo "<option value='$st[status]'>$st[status]</option>";		
					}
			echo "</select></label>
	 
		<input type=submit class=button value=Update>
        <input type=button class=button value=Batal onclick=self.history.back()></td></tr>
        </form></div>";
    break;
	
	case "lihatsArsip":
    $edit = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT a.stamp,a.periode,a.nArsip,a.tArsip,a.`jKlasifikasi`,b.`jenis` as urKlasifikasi,a.`jArsip`,a.status,a.inaktif,a.bidang,c.`urbidang` as urBidang,a.rak,a.`folder`,a.`baris`,a.`kolom`,a.file,a.`keterangan` FROM sarsip a LEFT JOIN rklasifikasi b ON TRIM(a.jKlasifikasi)=TRIM(b.kode) LEFT JOIN rjabatan c ON a.`bidang`=c.kode");
    $r    = mysqli_fetch_array($edit);
	
	$tgl	= tgl_indo($r[tSurat]);
	$tgl1	= tgl_indo($r[tMasuk]);
	
	
	echo "<h1>Detail Informasi</h1>
			<div class='line'></div>
			<div class='box'>";
			
    echo "
          <form method=POST action=$aksi?op=sArsip&act=update>
                   
		  <label><span>TERAKHIR DIBUAT/UPDATE</span>: <b>$r[stamp]</b></label>
		  <label><span>PERIODE</span>: <b>$r[periode]</b></label><br>
		  <label><span>NOMOR ARSIP</span>: <b>$r[nArsip]</b></label>
		  <label><span>TANGGAL ARSIP</span>: $r[tArsip]</label><br>
		  		  	  
		  <label><span>KLASIFIKASI ARSIP</span>: $r[jKlasifikasi] - $r[urKlasifikasi]</label>
		  <label><span>JENIS ARSIP</span>: $r[jArsip]</label>
		  <label><span>STATUS ARSIP</span>: $r[status]</label>
		  <label><span>TANGGAL INAKTIF</span>: $r[inaktif]</label>
		  <label><span>UNIT PENGELOLA ARSIP</span>: $r[bidang] - $r[urBidang]</label>
		  
		  <label><span>RAK-FOLDER-BARIS-KOLOM</span>: $r[rak]-$r[folder]-$r[baris]-$r[kolom]</label>
		  <label><span>NAMA FILE</span>: $r[file]</label><br>
		  
		  <label><span>KETERANGAN ARSIP</span>: $r[keterangan]</label><br>   
          <br><br><input type=button class=button value=Kembali onclick=self.history.back()></td></tr>
          </form></div>";
    break; 
	

}
}
?>
