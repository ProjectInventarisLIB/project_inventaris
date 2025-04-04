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
	<link href="/project_inventaris/vendors/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
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
                                    <table id="mytable" class="display" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Gambar</th>
                                                <th>ID Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Ukuran</th>
                                                <th>Jumlah</th>
												<th>Satuan</th>
												<th>Dana</th>
												<th>Tanggal</th>
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
    <div class="modal fade" id="modalPendataanBarang" tabindex="-1" aria-labelledby="modalPendataanBarangLabel" aria-hidden="true">
		<div class="modal-dialog  modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalPendataanBarangLabel">Formulir Pendataan Barang</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="formPendataanBarang" enctype="multipart/form-data">
						<div class="mb-3 d-flex justify-content-between">
                            <div class="w-50 me-2">
								<label for="id_barang" class="form-label">ID Barang</label>
								<input type="text" class="form-control" id="id_barang" name="id_barang" readonly>
                            </div>
                            <div class="w-50">
                                <label for="tanggalMasuk" class="form-label">Tanggal Masuk</label>
                                <input type="date" class="form-control" id="tanggalMasuk" name="tanggal" required>
                            </div>
                        </div>
						<div class="mb-3">
							<label for="gambarBarang" class="form-label">Gambar (opsional)</label>
							<div class="input-group">
								<button class="btn btn-secondary" type="button" onclick="document.getElementById('gambarBarang').click()">
									Pilih File
								</button>
								<input type="file" class="form-control" id="gambarBarang" name="gambarBarang" accept="image/*" style="display: none;">
								<input type="text" class="form-control" id="fileName" placeholder="No file chosen" readonly>
							</div>
						</div>
						<div class="mb-3">
							<label for="namaBarang" class="form-label">Nama Barang</label>
							<input type="text" class="form-control" id="namaBarang" name="namaBarang" required>
						</div>
						<div class="mb-3">
							<label for="ukuranBarang" class="form-label">Ukuran</label>
							<input type="text" class="form-control" id="ukuranBarang" name="ukuranBarang" required>
						</div>
						<div class="mb-3 d-flex justify-content-between">
                            <div class="w-50 me-2">
								<label for="jumlahBarang" class="form-label">Jumlah</label>
								<input type="number" class="form-control" id="jumlahBarang" name="jumlahBarang" required>
                            </div>
                            <div class="w-50">
                                <label for="satuan" class="form-label">Satuan</label>
                                <input type="text" class="form-control" id="satuan" name="satuan" required>
                            </div>
                        </div>
						<div class="mb-3">
							<label for="dana_final" class="form-label">Dana Final</label>
							<input type="number" class="form-control" id="dana_final" name="dana_final" required>
						</div>
						<div class="text-end">
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
    </div>

	<!-- Modal Edit Barang -->
	<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editModalLabel">Edit Data Barang</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="formEditBarang" enctype="multipart/form-data">
						<div class="mb-3 d-flex justify-content-between">
                            <div class="w-50 me-2">
								<label for="edit_id" class="form-label">ID Barang</label>
								<input type="text" class="form-control" id="edit_id" name="edit_id" readonly>
                            </div>
                            <div class="w-50">
                                <label for="edit_tanggal" class="form-label">Tanggal Masuk</label>
                                <input type="date" class="form-control" id="edit_tanggal" name="edit_tanggal" required>
                            </div>
                        </div>
						<div class="mb-3">
							<label class="form-label">Gambar Barang</label>
							<div class="text-center">
								<img id="editPreviewImage" src="" alt="Preview Gambar" class="img-thumbnail" style="max-width: 100px; display: none;">
							</div>
							<div class="input-group mt-2">
								<button class="btn btn-secondary" type="button" onclick="document.getElementById('editGambarBarang').click()">
									Pilih File
								</button>
								<input type="file" class="form-control" id="editGambarBarang" name="editGambarBarang" accept="image/*" style="display: none;">
								<input type="text" class="form-control" id="editFileName" name="editFileName" placeholder="No file chosen" readonly>
							</div>
						</div>
						<div class="mb-3">
							<label for="edit_nama_barang" class="form-label">Nama Barang</label>
							<input type="text" class="form-control" id="edit_nama_barang" name="edit_nama_barang" required>
						</div>
						<div class="mb-3">
							<label for="edit_ukuran" class="form-label">Ukuran</label>
							<input type="text" class="form-control" id="edit_ukuran" name="edit_ukuran" required>
						</div>
						<div class="mb-3 d-flex justify-content-between">
                            <div class="w-50 me-2">
								<label for="edit_jumlah_barang" class="form-label">Jumlah</label>
								<input type="number" class="form-control" id="edit_jumlah_barang" name="edit_jumlah_barang" required>
                            </div>
                            <div class="w-50">
                                <label for="edit_satuan" class="form-label">Satuan</label>
                                <input type="text" class="form-control" id="edit_satuan" name="edit_satuan" required>
                            </div>
                        </div>
						<div class="mb-3">
							<label for="edit_dana_final" class="form-label">Dana Final</label>
							<input type="number" class="form-control" id="edit_dana_final" name="edit_dana_final" required>
						</div>
						<div class="text-end">
							<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

		
  
    <!-- Required vendorss -->
    <script src="/project_inventaris/vendors/global/global.min.js"></script>
    <script src="/project_inventaris/vendors/chart.js/Chart.bundle.min.js"></script>
	<!-- Apex Chart -->
	<script src="/project_inventaris/vendors/apexchart/apexchart.js"></script>
	
    <!-- Datatable -->
    <script src="/project_inventaris/vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/project_inventaris/js/plugins-init/datatables.init.js"></script>

	<script src="/project_inventaris/vendors/jquery-nice-select/js/jquery.nice-select.min.js"></script>

    <script src="/project_inventaris/js/custom.min.js"></script>
	<script src="/project_inventaris/js/dlabnav-init.js"></script>

	<script src="/project_inventaris/vendors/sweetalert2/dist/sweetalert2.min.js"></script>

	<!-- Script untuk membuka modal -->
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			document.getElementById("btnTambahData").addEventListener("click", function() {
				var modal = new bootstrap.Modal(document.getElementById("modalPendataanBarang"));
				modal.show();
			});
		});
	</script>

	<!-- Input gambar di modal -->
	<script>
        document.getElementById('gambarBarang').addEventListener('change', function() {
            document.getElementById('fileName').value = this.files[0] ? this.files[0].name : '';
        });
    </script>

	<!-- INSERT BARANG -->
	<script>
		$("#formPendataanBarang").submit(function (e) {
			e.preventDefault();
			
			var formData = new FormData(this); // Gunakan FormData untuk mengirim file
			
			$.ajax({
				type: "POST",
				url: "backend/insert_barang.php",
				data: formData,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function (response) {
                    console.log(response); // Debug: lihat respon dari server
                    if (response.status === "success") {
                        swal("Berhasil!", "Data berhasil disimpan!", "success")
                        .then(() => {
                            location.reload();
                        });
                    } else {
                        swal("Peringatan!", response.message, "warning");
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText); // Debug: tampilkan error dari server
                    swal("Oops!", "Terjadi kesalahan dalam proses penyimpanan.", "error");
                }
			});
		});

	</script>


	
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
						{ 
							"data": "gambar",
							"render": function(data, type, row) {
                                return `<a href="${data}" target="_blank">
                                            <img src="${data}" alt="Gambar Barang" width="60" height="60"
                                                onerror="this.src='/project_inventaris/upload/gambar_barang/default_barang.jpg'">
                                        </a>`;
                            },
							"orderable": false
						},
						{ "data": "ID_barang", "orderable": true },
						{ "data": "nama_barang", "orderable": true },
						{ "data": "ukuran", "orderable": false },
						{ "data": "jumlah_barang", "orderable": false },
						{ "data": "satuan", "orderable": false },
						{ 
							"data": "dana_final", 
							"orderable": false,
							"render": function (data, type, row) {
								return formatRupiah(data);
							}
						},
						{ "data": "tanggal", "orderable": false },
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

				function formatRupiah(angka) {
					return 'Rp. ' + parseFloat(angka).toLocaleString('id-ID');
				}

				// Event Listener Hapus (dengan event delegation)
				$(document).on('click', '.btn-delete', function(e) {
					e.preventDefault();
					let id = $(this).data('id');

					Swal.fire({
						title: "Apakah Anda yakin?",
						text: "Barang yang dihapus tidak dapat dikembalikan!",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#d33",
						cancelButtonColor: "#3085d6",
						confirmButtonText: "Ya, hapus!",
						cancelButtonText: "Batal"
					}).then((result) => {
						console.log("SweetAlert result:", result);
						if (result.value) {
							$.ajax({
								url: "backend/delete_barang.php",
								type: "POST",
								data: { ID_barang: id },
								success: function(response) {
									Swal.fire({
										title: "Terhapus!",
										text: "Barang berhasil dihapus.",
										type: "success"
									}).then(() => {
										location.reload();
									});
								},
								error: function(xhr, status, error) {
									Swal.fire({
										title: "Gagal!",
										text: "Terjadi kesalahan: " + error,
										type: "error"
									});
								}
							});
						}
					});
				});

				// Event Listener Edit (jika ingin pakai modal edit)
				$(document).on("click", ".btn-edit", function (e) {
					e.preventDefault();
					let id = $(this).data("id");

					// Ambil data barang dari server
					$.ajax({
						url: "backend/get_detail_barang.php",
						type: "POST",
						data: { ID_barang: id },
						success: function (response) {
							let data = JSON.parse(response);
							$("#edit_id").val(data.ID_barang);
							$("#edit_tanggal").val(data.tanggal);
							$("#edit_nama_barang").val(data.nama_barang);
							$("#edit_ukuran").val(data.ukuran);
							$("#edit_jumlah_barang").val(data.jumlah_barang);
							$("#edit_satuan").val(data.satuan);
							$("#edit_dana_final").val(data.dana_final);
							$("#editFileName").val(data.gambar); // Menampilkan nama file gambar lama
							
							// Tampilkan gambar lama jika ada
							if (data.gambar) {
								$("#editPreviewImage").attr("src", "/project_inventaris/upload/gambar_barang/" + data.gambar).show();
							} else {
								$("#editPreviewImage").hide();
							}

							$("#editModal").modal("show");
						},
						error: function (xhr, status, error) {
							alert("Gagal mengambil data barang: " + error);
						}
					});
				});

				// Event listener untuk menampilkan preview gambar yang baru dipilih
				$("#editGambarBarang").on("change", function (event) {
					let file = event.target.files[0];
					if (file) {
						let reader = new FileReader();
						reader.onload = function (e) {
							$("#editPreviewImage").attr("src", e.target.result).show();
						};
						reader.readAsDataURL(file);
						$("#editFileName").val(file.name);
					}
				});


				// Event Listener untuk Submit Edit
				$("#formEditBarang").submit(function(e) {
					e.preventDefault();
					$.ajax({
						url: "backend/update_barang.php",
						type: "POST",
						data: $(this).serialize(),
						success: function(response) {
							swal("Berhasil!", "Data berhasil diperbarui!", "success").then(() => {
								$("#editModal").modal("hide");
								table.ajax.reload(null, false);
							});
						},
						error: function(xhr, status, error) {
							swal("Gagal!", "Gagal memperbarui data: " + error, "error");
						}
					});
				});
			}
		});

    </script>

	<script>
		fetch('backend/get_id_barang.php')
			.then(response => response.json())
			.then(data => {
				document.getElementById("id_barang").value = data.id_barang;
			});
	</script>
</body>
</html>