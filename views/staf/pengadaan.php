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
    <!-- Datatable -->
    <link href="/project_web/vendors/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
	<link href="/project_web/vendors/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link href="/project_web/css/style.css" rel="stylesheet">

</head>

<body>


    <!--**********************************
        Main wrapper start
    ***********************************-->
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
                                Data Pengadaan 
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item">
								<button type="button" class="btn btn-primary d-sm-inline-block d-none" id="btnTambahData">
                                    Buat Pengadaan <i class="fa fa-plus ms-3 scale4"></i>
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
                                    <table id="tabelpengadaan" class="display" style="min-width: 100%">
                                        <thead>
                                            <tr>
                                                <th>No Surat</th>
                                                <th>Tanggal</th>
                                                <th>Nama Barang</th>
                                                <th>Anggaran</th>
                                                <th>Link Surat</th>
                                                <th>Status</th>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPengadaanBarangLabel">Formulir Pengadaan Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formPengadaanBarang">
                        <div class="mb-3 d-flex justify-content-between">
                            <div class="w-50 me-2">
                                <label for="noSurat" class="form-label">No. Surat</label>
                                <input type="text" class="form-control" id="noSurat" name="noSurat" readonly>
                            </div>
                            <div class="w-50">
                                <label for="tanggalDiperlukan" class="form-label">Tanggal diperlukan</label>
                                <input type="date" class="form-control" id="tanggalDiperlukan" name="tanggalDiperlukan" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="namaBarang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="namaBarang" name="namaBarang" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Barang</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="anggaran" class="form-label">Perkiraan Anggaran</label>
                            <input type="number" class="form-control" id="anggaran" name="anggaran" min="1" required>
                        </div>
                        <div class="mb-3 d-flex justify-content-between">
                            <div class="w-50 me-2">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" required>
                            </div>
                            <div class="w-50">
                                <label for="satuan" class="form-label">Satuan</label>
                                <input type="text" class="form-control" id="satuan" name="satuan" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="tujuan" class="form-label">Tujuan Diperlukan</label>
                            <textarea class="form-control" id="tujuan" name="tujuan" rows="2" required></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

		
  
    <!-- Required vendorss -->
    <script src="/project_web/vendors/global/global.min.js"></script>
    <script src="/project_web/vendors/chart.js/Chart.bundle.min.js"></script>
	<!-- Apex Chart -->
	<script src="/project_web/vendors/apexchart/apexchart.js"></script>
	
    <!-- Datatable -->
    <script src="/project_web/vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/project_web/js/plugins-init/datatables.init.js"></script>

	<script src="/vendors/jquery-nice-select/js/jquery.nice-select.min.js"></script>

    <script src="/project_web/js/custom.min.js"></script>
	<script src="/project_web/js/dlabnav-init.js"></script>

	
    <!-- Script untuk membuka modal -->
	<script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("btnTambahData").addEventListener("click", function() {
                var modal = new bootstrap.Modal(document.getElementById("modalPengadaanBarang"));
                modal.show();
            });
        });
	</script>
    
<!-- TAMPILKAN TABEL SURAT -->
    <script>
        $(document).ready(function () {
            if (!$.fn.DataTable.isDataTable('#tabelpengadaan')) {
                $('#tabelpengadaan').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "backend/get_pengadaan.php",
                        "type": "POST"
                    },
                    "columns": [
                        { "data": 0, "orderable": true },
                        { "data": 1, "orderable": true },
                        { "data": 2, "orderable": true },
                        { 
							"data": 3, 
							"orderable": false,
							"render": function (data, type, row) {
								return formatRupiah(data);
							}
						},
                        { "data": 4, "orderable": false },
                        { 
                            "data": 5, 
                            "orderable": false,
                            "render": function (data, type, row) {
                                let badgeClass = "badge-secondary";
                                if (data === "Diproses") badgeClass = "badge-warning";
                                if (data === "Disetujui") badgeClass = "badge-success";
                                if (data === "Ditolak") badgeClass = "badge-danger";

                                return `<span class="badge ${badgeClass}">${data}</span>`;
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
            }
        });
        function formatRupiah(angka) {
            return 'Rp. ' + parseFloat(angka).toLocaleString('id-ID');
        }
    </script>

<!-- TAMBAHKAN SURAT -->
    <script>
        $("#formPengadaanBarang").submit(function (e) {
            e.preventDefault();
            var formData = $(this).serialize();
            
            console.log(formData); // Debug: lihat apakah form data sudah ada

            $.ajax({
                type: "POST",
                url: "backend/insert_pengadaan.php",
                data: formData,
                dataType: "json",
                success: function (response) {
                    console.log(response); // Debug: lihat respon dari server
                    if (response.status === "success") {
                        alert("Data berhasil disimpan!");
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText); // Debug: tampilkan error dari server
                    alert("Terjadi kesalahan dalam proses penyimpanan.");
                }
            });
        });

    </script>

 <!-- AMBIL NOMOR SURAT -->
    <script>
       document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("btnTambahData").addEventListener("click", function () {
                fetch("backend/nosurat_ajukan.php")
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("noSurat").value = data.no_surat;
                    })
                    .catch(error => console.error("Error:", error));
            });
        });
    </script>

    <script>
        // Set minimum date 
        var today = new Date().toISOString().split('T')[0];
            $('#tanggalDiperlukan').attr('min', today);
    </script>
    
</body>
</html>