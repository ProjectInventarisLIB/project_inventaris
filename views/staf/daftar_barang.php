<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Inventaris Lintas Internasional Berkarya" />
	<meta property="og:title" content="Inventaris Lintas Internasional Berkarya" />
	<meta property="og:description" content="Inventaris Lintas Internasional Berkarya" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- PAGE TITLE HERE -->
	<title>Inventaris Lintas Internasional Berkarya</title>
	
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="/project_web/assets/favicon_logo.png" />

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="/project_web/vendors/select2/css/select2.min.css">
    <link href="/project_web/css/style.css" rel="stylesheet">
    
    <!-- Datatable -->
    <link href="/project_web/vendors/datatables/css/jquery.dataTables.min.css" rel="stylesheet">


</head>

<body>

    <div id="main-wrapper">

        <!-- NAVBAR -->
		<?php include 'layouts/navbar.php'; ?>

        <!-- HEADER -->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
							<div class="dashboard_bar">
                                Daftar Barang
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item">
								<button type="button" class="btn btn-primary d-sm-inline-block d-none" id="btnTambahData">
                                    Cari Barang <i class="fa fa-search ms-3 scale4"></i>
                                </button>
							</li>
                        </ul>
                    </div>
				</nav>
			</div>
		</div>

        <!-- SIDEBAR -->
        <?php include 'layouts/sidebar.php'; ?>

        <!-- CONTENT -->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="mytable" class="display" style="min-width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Gambar</th>
                                                <th>ID Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Ukuran</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
            </div>
        </div>       
    </div>

    <!-- Modal Lihat Data -->
    <div class="modal fade" id="modalLihatBarang" tabindex="-1" aria-labelledby="modalLihatBarangLabel" aria-hidden="true">
		<div class="modal-dialog  modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalLihatBarangLabel">Lihat Barang</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="card-body">
                        <div class="d-flex align-items-center gap-2 mb-3 mb-md-4">
                            <label class="mb-0"><strong>Seleksi:</strong></label>
                            <select id="automatic-selection">
                                <option value="Solar">Solar</option>
                                <option value="Baut">Baut</option>
                                <option value="Rantai">Rantai</option>
                                <option value="Pelampung">Jaket Pelampung</option>
                            </select>
                        </div>                        
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th><strong>Gambar</strong></th>
                                        <th><strong>Barang</strong></th>
                                        <th><strong>Barang</strong></th>
                                        <th><strong>Ukuran</strong></th>
                                        <th><strong>Stok Barang</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- data disini -->
                                </tbody>
                            </table>
                        </div>
                    </div>
				</div>
			</div>
		</div>
    </div>


		
  
    <!-- Required vendorss -->
    <script src="/project_web/vendors/global/global.min.js"></script>
	
    <!-- Datatable -->
    <script src="/project_web/vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/project_web/js/plugins-init/datatables.init.js"></script>

    <script src="/project_web/js/custom.min.js"></script>
	<script src="/project_web/js/dlabnav-init.js"></script>

    <script src="/project_web/vendors/select2/js/select2.full.min.js"></script>
    <script src="/project_web/js/plugins-init/select2-init.js"></script>



    <!-- Script untuk membuka modal -->
	<script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("btnTambahData").addEventListener("click", function() {
                var modal = new bootstrap.Modal(document.getElementById("modalLihatBarang"));
                modal.show();
            });
        });
	</script>

    <script>
        $(document).ready(function () {
            if (!$.fn.DataTable.isDataTable('#mytable')) {
                $('#mytable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "backend/get_barang.php",
                        "type": "POST"
                    },
                    "columns": [
                        { "data": "gambar", "orderable": false }, // Gambar
                        { "data": "ID_barang", "orderable": true },  // ID Barang
                        { "data": "nama_barang", "orderable": true },  // Nama Barang
                        { "data": "ukuran", "orderable": false },  // Ukuran
                        { "data": "jumlah_barang", "orderable": false }  
                    ],
                    "order": [[1, "asc"]],
                    "language": {
                        "lengthMenu": "Tampilkan _MENU_ data barang",
                        "zeroRecords": "Data tidak ditemukan",
                        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        "infoEmpty": "Tidak ada data tersedia",
                        "search": "Cari:",
                        "paginate": {
                            "first": "Awal",
                            "last": "Akhir",
                            "next": "›",
                            "previous": "‹"
                        }
                    }
                });
            }
        });
    </script>

    
    
</body>
</html>