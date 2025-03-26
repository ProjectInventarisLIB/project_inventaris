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
                                Anggaran Departemen
                            </div>
                        </div>
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
                                    <table id="tableanggaran" class="display" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>ID Staf</th>
                                                <th>Nama Staf</th>
												<th>Email Staf</th>
												<th>Pengeluaran</th>
                                                <th>Anggaran</th>
												<th>Tindakan</th>
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


    <!-- Modal Tambah Data -->
    <div class="modal fade" id="modalAnggaran" tabindex="-1" aria-labelledby="modalAnggaranLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalAnggaranLabel">Formulir Perbarui Anggaran</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="formPerbaruiAnggaran">
						<div class="mb-3">
							<label for="idNamaStaf" class="form-label">Nama Staf</label>
							<input type="text" class="form-control" name="idNamaStaf" id="idNamaStaf" readonly>
						</div>
						<div class="mb-3">
							<label for="nilaiAnggaran" class="form-label">Nilai Anggaran</label>
							<input type="number" class="form-control" name="nilaiAnggaran" id="nilaiAnggaran" required>
						</div>
						<div class="text-end">
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
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
	<script src="/vendors/jquery-nice-select/js/jquery.nice-select.min.js"></script>
	
	<!-- Dashboard 1 -->
	<script src="/project_inventaris/js/dashboard/dashboard-1.js"></script>

    <script src="/project_inventaris/js/custom.min.js"></script>
	<script src="/project_inventaris/js/dlabnav-init.js"></script>


    <!-- Init file -->
    <script src="/project_inventaris/js/plugins-init/widgets-script-init.js"></script>

	
    <!-- Datatable -->
    <script src="/project_inventaris/vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/project_inventaris/js/plugins-init/datatables.init.js"></script>


	<!-- Script untuk membuka modal -->
	<script>
		$(document).on("click", ".updateanggaran", function() {
			var row = $(this).closest("tr");
			var table = $("#tableanggaran").DataTable();
			var rowData = table.row(row).data();
			
			// Mengisi data otomatis ke dalam modal
			$("#modalAnggaran #idNamaStaf").val(rowData.ID_staf + " - " + rowData.nama_staf);
			$("#modalAnggaran #nilaiAnggaran").val(rowData.anggaran);
			
			// Menampilkan modal
			var modal = new bootstrap.Modal(document.getElementById("modalAnggaran"));
			modal.show();
		});
	</script>
	
	<script>
		$(document).ready(function () {
			if (!$.fn.DataTable.isDataTable('#tableanggaran')) {
				$('#tableanggaran').DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": {
						"url": "backend/get_anggaran.php",
						"type": "POST"
					},
					"columns": [
						{ "data": "ID_staf", "orderable": false },
						{ "data": "nama_staf", "orderable": false },
						{ "data": "email_staf", "orderable": false },
						{ 
							"data": "pengeluaran_anggaran", 
							"orderable": false,
							"render": function (data, type, row) {
								return formatRupiah(data);
							}
						},
						{ 
							"data": "anggaran", 
							"orderable": false,
							"render": function (data, type, row) {
								return formatRupiah(data);
							}
						},
						{ 
							"data": null, 
							"orderable": false,
							"render": function () {
								return '<a class="btn btn-utama btn-xs px-3 py-2 text-white updateanggaran">Perbarui</a>';
							}
						}
					],
					"order": [[1, "asc"]],
					"language": {
						"lengthMenu": "Tampilkan _MENU_ data staf",
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

		function formatRupiah(angka) {
			return 'Rp. ' + parseFloat(angka).toLocaleString('id-ID');
		}
    </script>

	<script>
		$(document).ready(function () {
			$("#formPerbaruiAnggaran").submit(function (event) {
				event.preventDefault();

				$.ajax({
					url: "backend/update_anggaran.php", // Sesuaikan dengan nama file PHP backend
					type: "POST",
					data: $(this).serialize(),
					dataType: "json",
					success: function (response) {
						if (response.status === "success") {
							alert(response.message);
							$("#modalAnggaran").modal("hide");
							$("#tableanggaran").DataTable().ajax.reload();
						} else {
							alert(response.message);
						}
					},
					error: function () {
						alert("Terjadi kesalahan saat memperbarui anggaran.");
					}
				});
			});
		});
	</script>


	
</body>
</html>