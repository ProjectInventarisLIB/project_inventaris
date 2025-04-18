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
	<link rel="shortcut icon" type="image/png" href="/project_inventaris/assets/favicon_logo.png" />

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="/project_inventaris/vendors/select2/css/select2.min.css">
    <link href="/project_inventaris/css/style.css" rel="stylesheet">
    
    <!-- Datatable -->
    <link href="/project_inventaris/vendors/datatables/css/jquery.dataTables.min.css" rel="stylesheet">


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
								<button type="button" class="btn btn-primary d-sm-inline-block d-none" id="reloadData">
                                    Perbarui Data <i class="fa fa-refresh ms-3 scale4"></i>
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
                                    <table id="mytable" class="display table table-bordered table-sm" style="width: 100%">
                                        <thead class="bg-tableheader">
                                            <tr>
                                                <th>Gambar</th>
                                                <th>ID Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Ukuran</th>
                                                <th>Jumlah</th>
                                                <th>Satuan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark">
                                            <!-- isi data dari database -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
            </div>
        </div>       
    </div>
		
  
    <!-- Required vendorss -->
    <script src="/project_inventaris/vendors/global/global.min.js"></script>
	
    <!-- Datatable -->
    <script src="/project_inventaris/vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/project_inventaris/js/plugins-init/datatables.init.js"></script>

    <script src="/project_inventaris/js/custom.min.js"></script>
	<script src="/project_inventaris/js/dlabnav-init.js"></script>

    <script src="/project_inventaris/vendors/select2/js/select2.full.min.js"></script>
    <script src="/project_inventaris/js/plugins-init/select2-init.js"></script>

    <script>
        $(document).ready(function () {
            var table; // Tambahkan ini

            if (!$.fn.DataTable.isDataTable('#mytable')) {
                table = $('#mytable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "backend/get_barang.php",
                        "type": "POST"
                    },
                    "columns": [
                        { 
                            "data": "gambar",
                            "render": function(data, type, row) {
                                return `<a href="${data}" target="_blank">
                                            <img src="${data}" alt="Gambar Barang" width="60" height="60"
                                                onerror="this.src='/project_inventaris/upload/gambar_barang/contohbarang.jpg'">
                                        </a>`;
                            },
                            "orderable": false
                        },
                        { "data": "ID_barang", "orderable": true },
                        { "data": "nama_barang", "orderable": true },
                        { "data": "ukuran", "orderable": false },
                        { "data": "jumlah_barang", "orderable": false },
                        { "data": "satuan", "orderable": false }    
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

            // Event klik tombol reload
            document.getElementById("reloadData").addEventListener("click", function () {
                if (table) {
                    table.ajax.reload(null, false);
                }
            });
        });
    </script>
    
</body>
</html>