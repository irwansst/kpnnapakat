<?php
session_start();
error_reporting(0);
include "timeout.php";

$timezone = "Asia/Jakarta";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);

if($_SESSION[login]==1){
	if(!cek_login()){
		$_SESSION[login] = 0;
	}
}
if($_SESSION[login]==0){
  header('location:logout.php');
}
else{
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
  echo "<link href='css/style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{

//ambil tahun anggaran dari session_start
$tahun = $_SESSION[periode];
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="zodiac" >

  <title>KPN NAPAKAT</title>

  <!-- Custom fonts for this template-->
  <link rel="icon" type="image/png" href="img/favicon-16x16.png"/>
  <link rel="icon" type="image/png" href="http://localhost/kpnnapakat/img/favicon-16x16.png" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/fontawesome.min.css" rel="stylesheet" type="text/css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/brands.min.css" rel="stylesheet" type="text/css">


  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap-datetimepicker.css">
	<link rel="stylesheet" href="vendor/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?op=home">
        <div class="sidebar-brand-icon">
          <!-- <i class="fas fa-address-book"></i> -->
          <img src="img/logo-koperasi.png" width="48px" height="48px">
        </div>
        <div class="sidebar-brand-text mx-3">NAPAKAT</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">
			<p align="center"><img class="img-profile rounded-circle" src="<?php echo "photos/".$_SESSION[namauser].".jpg"; ?>" width="128px" height="140px" ></p>
			<hr class="sidebar-divider">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="?op=home">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Aplikasi
      </div>

      <!-- Nav Item - Anggota Collapse Menu -->


			<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i class="fas fa-fw fa-users"></i>
          <span>Frontliners</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
						<a class="collapse-item" href="?op=uraian">Uraian SPM</a>
						<a class="collapse-item" href="?op=bas">Bagan Akuntansi Standar</a>
						<a class="collapse-item" href="?op=blokir">Pemblokiran SPM</a>
        </div>
      </li>

			<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRekon" aria-expanded="true" aria-controls="collapseRekon">
          <i class="fas fa-fw fa-list-alt"></i>
          <span>LPJ Bendahara</span>
        </a>
        <div id="collapseRekon" class="collapse" aria-labelledby="headingRekon" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
						<a class="collapse-item" href="?op=elpj">LPJ Bend. Penerimaan</a>
						<a class="collapse-item" href="?op=elpj_out">LPJ Bend. Pengeluaran</a>
						<a class="collapse-item" href="?op=elpj_blu">LPJ Bend. BLU</a>
        </div>
      </li>

			<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBank" aria-expanded="true" aria-controls="collapseBank">
          <i class="fas fa-fw fa-list-alt"></i>
          <span>Rekening Satker</span>
        </a>
        <div id="collapseBank" class="collapse" aria-labelledby="headingBank" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
						<a class="collapse-item" href="?op=saldo">Saldo Bank</a>
						<a class="collapse-item" href="?op=upsaldo">Upload Lap. Saldo</a>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-address-book"></i>
          <span>Monitoring</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
						<a class="collapse-item" href="?op=tagihan">Persetujuan SPM</a>
						<a class="collapse-item" href="?op=cekgaji">Gaji Induk</a>
						<a class="collapse-item" href="?op=cekppnpn">PPNPN Induk</a>
						<!--<a class="collapse-item" href="?op=cekthr">THR Gaji PNS/TNI/Polri</a>-->
						<!--<a class="collapse-item" href="?op=cekthrppnpn">THR PPNPN</a>-->
            <a class="collapse-item" href="?op=koreksi">Koreksi SPM</a>
						<!-- <a class="collapse-item" href="?op=pnbp">MP PNBP</a> -->
        </div>
      </li>

			<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseFive">
				<i class="fas fa-fw fa-upload"></i>
				<span>Upload ADK</span>
			</a>
			<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="?op=kontrak">Kontrak</a>
					<a class="collapse-item" href="?op=supplier">Supplier</a>
			</div>
		</li>

		<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEdukasi" aria-expanded="true" aria-controls="collapseTwo">
			<i class="fas fa-fw fa-book"></i>
			<span>Edukasi</span>
		</a>
		<div id="collapseEdukasi" class="collapse" aria-labelledby="headingEdukasi" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="?op=video">Video Tutorial</a>
		</div>
	</li>

			<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseThree">
				<i class="fas fa-fw fa-suitcase"></i>
				<span>CRM</span>
			</a>
			<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="?op=kontak">Kontak Satker</a>
				</div>
		</li>

            <!-- Nav Item - referensi Collapse Menu -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-list"></i>
          <span>Referensi</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
						<a class="collapse-item" href="?op=blangko">Blangko dan Formulir</a>
            <a class="collapse-item" href="?op=users">Pengguna</a>
            <a class="collapse-item" href="?op=satker">Satuan Kerja</a>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Utilitas</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="?op=periode">Tahun Anggaran</a>
						<a class="collapse-item" href="?op=session">Cek Login & Sessions</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

			<p class='mr-2 d-none d-lg-inline text-gray-600 small'><b><a href='?op=periode' class='btn btn-success btn-icon-split '>
							<span class='icon text-white-50'><i class='fas fa-calendar'></i></span>
				<span class='text'><?php echo $tahun; ?></span>
					</a>
					<a href='#' class='btn btn-warning btn-circle btn-sm'>
	        	<i class='fas fa-exclamation-triangle masterTooltip' title='Bila data tidak muncul, ubah periode Tahun Anggaran'></i>
	      	</a>

			</b></p>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php  echo $_SESSION[namalengkap]; ?></span>
                <!-- <img class="img-profile rounded-circle" src="<?php echo "photos/".$_SESSION[namauser].".jpg"; ?>"> -->
								<i class="fas fa-fw fa-user"></i>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="?op=profile">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->


        <!-- Begin Page Content -->
        <div class="container-fluid">
			  <?php include "content.php"; ?>
          </div>
        <!-- /.container-fluid -->

		</div>
      </div>
</div>

      <!-- End of Main Content -->


      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Irwan Susanto@2021 </span>
          </div>
        </div>
      </footer>


      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Siap untuk logout?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Tekan tombol "Logout" jika Anda hendak mengakhiri session ini.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>

  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  <script src="js/bootstrap-datetimepicker.js"></script>
  <script src="js/jquery.chained.min.js"></script>

	<script src="vendor/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>

<!-- Pengaturan Datatables -->
  <script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		oTable = $('#example').dataTable({
			"scrollX": true,
			"sScrollXInner": "100%",
			"scrollY": true,
			"aaSorting": [],
			"sPaginationType": "full_numbers",
			"autoWidth": true
			});
		} );
	</script>


<!-- PENGATURAN KONFIRMASI DELETE -->
<script>
		function confirmationDelete(anchor)
		{
		   var conf = confirm('Anda yakin akan menghapus data ini?');
		   if(conf)
			  window.location=anchor.attr("href");
		}
</script>

<script>
  $(document).ready(function(){
    $(“#nip").change(function(){
      $(“#username").val($(this). Val());
    });
  });
</script>

	<!-- Pengaturan Alert Button -->
	<script type="text/javascript" >
	$(document).ready(function(){
    $('button').click(function(){
        $('.alert').show()
    })
	});
	</script>

	<!-- pengaturan datetimepicker -->
	<script>
		// Default date and time picker
		$('#my_dtp').datetimepicker({
        format: 'yyyy-mm-dd hh:ii:ss',
        fontAwesome: true,
        wheelViewModeNavigation: true
      })
      //$('#my_dtp').datetimepicker('update', new Date())
	</script>

  <!-- pengaturan datetimepicker -->
	<script>
		// Default date and time picker
		$('#my_dtp1').datetimepicker({
        minView:2,
        pickTime: false,
        format: 'yyyy-mm-dd',
        fontAwesome: true,
        wheelViewModeNavigation: true
      })
      //$('#my_dtp1').datetimepicker('update', new Date())
	</script>

  <script>
		// Default date and time picker
		$('#my_dtp2').datetimepicker({
        minView:2,
        pickTime: false,
        format: 'yyyy-mm-dd',
        fontAwesome: true,
        wheelViewModeNavigation: true
      })
      //$('#my_dtp2').datetimepicker('update', new Date())
	</script>



<script type="text/javascript" >
	$(document).ready(function() {
    /* For jquery.chained.js */
	    $("#klprek").chained("#jnsrek");
    });
</script>

<!-- Pengaturan nicEdit  -->
<script src="//js.nicedit.com/nicEdit-latest.js"></script>
<!-- <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script> -->

<script type="text/javascript">
  bkLib.onDomLoaded(function() {
				nicEditors.allTextAreas({buttonList : ['fontSize','fontFamily','fontFormat',
				'bold','italic','underline','left','center','right','justify',
				'strikeThrough','subscript','superscript','ol','ul','indent','outdent',
				'forecolor','bgcolor']});
    });
  </script>

<!-- akhir dari body html -->
</body>
</html>
<?php
	}
}
?>
