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
    <!-- Datatable -->
    <link href="/project_inventaris/vendors/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
	<link href="/project_inventaris/vendors/jquery-nice-select/css/nice-select.css" rel="stylesheet">
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
                                Pendataan Barang 
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item">
								<button type="button" class="btn btn-primary d-sm-inline-block d-none" id="btnTambahData">
                                    Tambah Data <i class="fa fa-plus ms-3 scale4"></i>
                                </button>
							</li>
                            <li class="nav-item">
								<button type="button" class="btn btn-primary d-sm-inline-block d-none" id="btnTambahData">
                                    Unduh PDF<i class="fa fa-download ms-3 scale4"></i>
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
    <div class="modal fade" id="modalPengadaanBarang" tabindex="-1" aria-labelledby="modalPengadaanBarangLabel" aria-hidden="true">
		<div class="modal-dialog  modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalPengadaanBarangLabel">Formulir Pendataan Barang</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="formPengadaanBarang">
						<div class="mb-3 d-flex justify-content-between">
							<div class="w-50 me-2">
								<label for="kodeBarang" class="form-label">Kode Barang</label>
								<input type="text" class="form-control" id="kodeBarang" required>
							</div>
							<div class="w-50">
								<label for="tanggalMasuk" class="form-label">Tanggal Masuk</label>
								<input type="date" class="form-control" id="tanggalMasuk" required>
							</div>
						</div>
						<div class="mb-3">
							<label for="namaBarang" class="form-label">Nama Barang</label>
							<input type="text" class="form-control" id="namaBarang" required>
						</div>
                        <div class="mb-3">
							<label for="deskripsi" class="form-label">Deskripsi</label>
							<input type="text" class="form-control" id="deskripsi" required>
						</div>
                        <div class="mb-3">
							<label for="stok" class="form-label">Stok</label>
							<input type="number" class="form-control" id="stok" required>
						</div>
						<div class="text-end">
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
    </div>
  
    <!-- Script untuk membuka modal -->
	<script>
	document.addEventListener("DOMContentLoaded", function() {
		document.getElementById("btnTambahData").addEventListener("click", function() {
			var modal = new bootstrap.Modal(document.getElementById("modalPengadaanBarang"));
			modal.show();
		});
	});
	</script>
		
  
    <!-- Required vendorss -->
    <script src="/project_inventaris/vendors/global/global.min.js"></script>
    <script src="/project_inventaris/vendors/chart.js/Chart.bundle.min.js"></script>
	<!-- Apex Chart -->
	<script src="/project_inventaris/vendors/apexchart/apexchart.js"></script>
	
    <!-- Datatable -->
    <script src="/project_inventaris/vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/project_inventaris/js/plugins-init/datatables.init.js"></script>

	<script src="/vendors/jquery-nice-select/js/jquery.nice-select.min.js"></script>

    <script src="/project_inventaris/js/custom.min.js"></script>
	<script src="/project_inventaris/js/dlabnav-init.js"></script>
	
    <script>
        $(document).ready(function () {
			if (!$.fn.DataTable.isDataTable('#mytable')) {
				var table = $('#mytable').DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": {
						"url": "backend/get_barang.php",
						"type": "POST"
					},
					"columns": [
						{ "data": "gambar", "orderable": false, "render": function(data) {
							return '<img src="'+ data +'" width="50">';
						}},
						{ "data": "ID_barang", "orderable": true },
						{ "data": "nama_barang", "orderable": true },
						{ "data": "ukuran", "orderable": false },
						{ "data": "jumlah_barang", "orderable": false },
						{ 
							"data": null, 
							"orderable": false,
							"render": function (data, type, row) {
								return `
									<div class="d-flex">
										<a href="edit_barang.php?id=${row.ID_barang}" 
											class="btn btn-primary shadow btn-xs sharp me-1 btn-edit" 
											data-id="${row.ID_barang}" title="Edit">
											<i class="fa fa-pencil"></i>
										</a>
										<a href="#" class="btn btn-danger shadow btn-xs sharp btn-delete" 
											data-id="${row.ID_barang}" title="Hapus">
											<i class="fa fa-trash"></i>
										</a>
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

				// Event Listener Hapus (dengan event delegation)
				$(document).on('click', '.btn-delete', function(e) {
					e.preventDefault();
					let id = $(this).data('id');
					
					if (confirm("Apakah Anda yakin ingin menghapus barang ini?")) {
						$.ajax({
							url: "backend/delete_barang.php",
							type: "POST",
							data: { ID_barang: id },
							success: function(response) {
								alert("Barang berhasil dihapus!");
								table.ajax.reload(null, false); // Refresh tabel tanpa reload halaman
							},
							error: function(xhr, status, error) {
								alert("Terjadi kesalahan: " + error);
							}
						});
					}
				});

				// Event Listener Edit (jika ingin pakai modal edit)
				$(document).on('click', '.btn-edit', function(e) {
					e.preventDefault();
					let id = $(this).data('id');
					
					// Contoh: Tampilkan modal edit dan isi dengan data dari server
					$.ajax({
						url: "backend/get_barang_detail.php",
						type: "POST",
						data: { ID_barang: id },
						success: function(response) {
							let data = JSON.parse(response);
							$("#editModal #nama_barang").val(data.nama_barang);
							$("#editModal #ukuran").val(data.ukuran);
							$("#editModal #jumlah_barang").val(data.jumlah_barang);
							$("#editModal #edit_id").val(data.ID_barang);
							$("#editModal").modal("show");
						},
						error: function(xhr, status, error) {
							alert("Gagal mengambil data barang: " + error);
						}
					});
				});

				// Event Listener untuk Submit Edit
				$("#editForm").submit(function(e) {
					e.preventDefault();
					$.ajax({
						url: "backend/update_barang.php",
						type: "POST",
						data: $(this).serialize(),
						success: function(response) {
							alert("Data berhasil diperbarui!");
							$("#editModal").modal("hide");
							table.ajax.reload(null, false);
						},
						error: function(xhr, status, error) {
							alert("Gagal memperbarui data: " + error);
						}
					});
				});
			}
		});

    </script>
</body>
</html>