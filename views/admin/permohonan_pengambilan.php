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
	
	<link href="/project_inventaris/vendors/jquery-nice-select/css/nice-select.css" rel="stylesheet">
	<link rel="stylesheet" href="/project_inventaris/vendors/nouislider/nouislider.min.css">

	<!-- Chartist -->
	<link rel="stylesheet" href="/project_inventaris/vendors/chartist/css/chartist.min.css">
	
    <link href="/project_inventaris/vendors/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
	<link href="/project_inventaris/vendors/jquery-nice-select/css/nice-select.css" rel="stylesheet">
	<link href="/project_inventaris/vendors/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Datatable -->
    <link href="/project_inventaris/vendors/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

	<!-- Style css -->
    <link href="/project_inventaris/css/style.css" rel="stylesheet">
	
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
                                Permohonan Pengambilan Barang 
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
            <!-- row -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
									<table id="tabelpengambilan" class="display table table-bordered table-sm" style="width: 100%">
                                        <thead class="bg-tableheader">
                                            <tr class="text-center">
												<th>No Surat</th>
                                                <th>Tanggal</th>
												<th>Pengirim</th>
                                                <th style="width: 250px;">Nama Barang</th>
                                                <th>Link Surat</th>
                                                <th>Tindakan</th>
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


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendorss -->
    <script src="/project_inventaris/vendors/global/global.min.js"></script>
	<script src="/project_inventaris/vendors/chart.js/Chart.bundle.min.js"></script>
	<script src="/project_inventaris/vendors/jquery-nice-select/js/jquery.nice-select.min.js"></script>
	
	<!-- Apex Chart -->
	<script src="/project_inventaris/vendors/nouislider/nouislider.min.js"></script>
	<script src="/project_inventaris/vendors/wnumb/wNumb.js"></script>


    <script src="/project_inventaris/js/custom.min.js"></script>
	<script src="/project_inventaris/js/dlabnav-init.js"></script>


    <!-- Init file -->
    <script src="/project_inventaris/js/plugins-init/widgets-script-init.js"></script>

	
    <!-- Datatable -->
    <script src="/project_inventaris/vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/project_inventaris/js/plugins-init/datatables.init.js"></script>

	<script src="/project_inventaris/vendors/sweetalert2/dist/sweetalert2.min.js"></script>

	
    <!-- TAMPILKAN TABEL SURAT -->
    <script>
	$(document).ready(function () {
		var table; // Deklarasi di luar supaya bisa dipakai global dalam scope ini

		if (!$.fn.DataTable.isDataTable('#tabelpengambilan')) {
			table = $('#tabelpengambilan').DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": {
					"url": "backend/get_pengambilan.php",
					"type": "POST"
				},
				"columns": [
					{ "data": 0, "orderable": true }, 
					{ "data": 1, "orderable": true },
					{ "data": 2, "orderable": false },
					{ "data": 3, "orderable": true },
					{ "data": 4, "orderable": false },
					{ 
						"data": 5, 
						"orderable": false,
						"render": function (data, type, row) {
							return `
								<div class="d-flex">
									<button class="btn btn-success btn-xs px-3 py-2 rounded-0 btn-setujui" data-no_surat="${row[0]}">Setujui</button>
									<button class="btn btn-danger btn-xs px-3 py-2 rounded-0 btn-tolak" data-no_surat="${row[0]}">Tolak</button>
								</div>
							`;
						}
					}
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

			// Event klik untuk Setujui
			$('#tabelpengambilan tbody').on('click', '.btn-setujui', function () {
				var no_surat = $(this).data('no_surat');
				updateStatus(no_surat, 'Disetujui');
			});

			// Event klik untuk Tolak
			$('#tabelpengambilan tbody').on('click', '.btn-tolak', function () {
				var no_surat = $(this).data('no_surat');
				updateStatus(no_surat, 'Ditolak');
			});

			// Fungsi untuk update status lewat AJAX
			function updateStatus(no_surat, status) {
				$.ajax({
					url: "backend/update_status.php",
					type: "POST",
					data: { no_surat: no_surat, status: status },
					success: function (response) {
						swal("Berhasil!", response, "success")
						.then(() => {
							table.ajax.reload(null, false);
						});
					},
					error: function () {
						swal("Oops!", "Terjadi kesalahan saat memperbarui status.", "error");
					}
				});
			}
		}

		// Event klik tombol reload, ini harus tetap bisa jalan meskipun datatable sudah terinisialisasi sebelumnya
		document.getElementById("reloadData").addEventListener("click", function () {
			if (table) {
				table.ajax.reload(null, false);
			}
			});
		});
	</script>

	
</body>
</html>