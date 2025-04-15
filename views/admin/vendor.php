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

	<link href="/project_inventaris/vendors/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

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
                                Data Vendor
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item">
								<button type="button" class="btn btn-primary d-sm-inline-block d-none" id="btnTambahVendor">
                                    Tambah Vendor <i class="fa fa-plus ms-3 scale4"></i>
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
									<table id="tablevendor" class="display table table-bordered table-sm" style="width: 100%">
                                        <thead class="bg-tableheader">
                                            <tr class="text-center">
												<th>ID Vendor</th>
                                                <th>Nama Vendor</th>
												<th>No Telepon</th>
												<th>Alamat</th>
                                                <th>Hapus</th>
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

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="modalVendor" tabindex="-1" aria-labelledby="modalVendorLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalVendorLabel">Formulir Pendataan Vendor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formVendor">
                        <div class="mb-3">
                            <label for="idVendor" class="form-label">ID Vendor</label>
                            <input type="text" class="form-control" id="idVendor" name="idVendor" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="namaVendor" class="form-label">Nama Vendor</label>
                            <input type="text" class="form-control" id="namaVendor" name="namaVendor" required>
                        </div>
                        <div class="mb-3">
                            <label for="noTelepon" class="form-label">No Telepon</label>
                            <input type="number" class="form-control" id="noTelepon" name="noTelepon" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamatVendor" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamatVendor" name="alamatVendor" rows="2" required></textarea>
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
	<script src="/project_inventaris/vendors/jquery-nice-select/js/jquery.nice-select.min.js"></script>
	
    <script src="/project_inventaris/js/custom.min.js"></script>
	<script src="/project_inventaris/js/dlabnav-init.js"></script>

    <!-- Init file -->
    <script src="/project_inventaris/js/plugins-init/widgets-script-init.js"></script>

    <!-- Datatable -->
    <script src="/project_inventaris/vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/project_inventaris/js/plugins-init/datatables.init.js"></script>

	<script src="/project_inventaris/vendors/sweetalert2/dist/sweetalert2.min.js"></script>

    <!-- Script untuk membuka modal -->
	<script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("btnTambahVendor").addEventListener("click", function() {
                var modal = new bootstrap.Modal(document.getElementById("modalVendor"));
                modal.show();
            });
        });
	</script>

	
	<script>
		$(document).ready(function () {
            if (!$.fn.DataTable.isDataTable('#tablevendor')) {
                var table = $('#tablevendor').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "backend/get_vendor.php",
                        "type": "POST"
                    },
                    "columns": [
                        { "data": "ID_vendor", "orderable": false },
                        { "data": "nama_vendor", "orderable": false },
                        { "data": "no_telepon", "orderable": false },
                        { "data": "alamat_vendor", "orderable": false },
                        { 
                            "data": null, 
                            "orderable": false,
                            "render": function (data, type, row) {
                                return `
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a href="#" class="btn btn-danger shadow btn-xs sharp btn-delete" 
                                            data-id="${row.ID_vendor}" title="Hapus">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                `;
                            }
                        }
                    ],
                    "order": [[1, "asc"]],
                    "language": {
                        "lengthMenu": "Tampilkan _MENU_ data vendor",
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

                // Event listener untuk tombol delete
                $(document).on('click', '.btn-delete', function(e) {
					e.preventDefault();
					let id = $(this).data('id');
                    
                    $.ajax({
                        url: 'backend/delete_vendor.php',
                        type: 'POST',
                        dataType: "json",
                        data: { ID_vendor: id },
                        success: function (response) {
                            if (response.status === "success") {
                                swal("Berhasil!", "Data berhasil dihapus!", "success")
                                .then(() => {
                                    location.reload();
                                });
                            } else {
                                swal("Peringatan!", response.message, "warning");
                            }
                        },
                        error: function () {
                            alert('Terjadi kesalahan saat menghapus data');
                        }
                    });
                });
            }
        });
	</script>

    <script>
        $(document).ready(function() {
            // Fungsi untuk menghasilkan ID Barang secara otomatis
            function generateidVendor() {
                $.ajax({
                    url: 'backend/get_id_vendor.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.lastKode) {
                            let lastKode = response.lastKode;
                            let angkaKode = parseInt(lastKode.replace('VNDR', ''), 10); 
                            let newKode = 'VNDR' + (angkaKode + 1).toString().padStart(3, '0');

                            console.log("Kode baru:", newKode); 
                            $('#idVendor').val(newKode);
                        } else {
                            $('#idVendor').val('VNDR001');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error mengambil kode barang:", error);
                        $('#idVendor').val('VNDR001');
                    }
                });
            }

            $('#modalVendor').on('show.bs.modal', function() {
                generateidVendor();
            })
        })
    </script>

    <!-- INSERT BARANG -->
	<script>
		$("#formVendor").submit(function (e) {
			e.preventDefault();
			
			var formData = new FormData(this);
			
			$.ajax({
				type: "POST",
				url: "backend/insert_vendor.php",
				data: formData,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function (response) {
                    console.log(response);
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
                    console.error(xhr.responseText);
                    swal("Oops!", "Terjadi kesalahan dalam proses penyimpanan.", "error");
                }
			});
		});

	</script>


	
</body>
</html>