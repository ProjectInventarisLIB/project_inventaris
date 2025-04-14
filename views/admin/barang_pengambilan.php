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
                                Pengambilan Barang 
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item">
								<button type="button" class="btn btn-primary d-sm-inline-block d-none" id="btnTambahData">
                                    Ambil Barang<i class="fa fa-plus ms-3 scale4"></i>
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
                                    <table id="tabelbarangpengambilan" class="display table table-bordered table-sm" style="width: 100%">
                                        <thead class="bg-tableheader">
                                            <tr>
                                                <th>Surat Terkait</th>
                                                <th>Tanggal</th>
                                                <th>ID Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
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
    <div class="modal fade" id="modalPengadaanBarang" tabindex="-1" aria-labelledby="modalPengadaanBarangLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPengadaanBarangLabel">Formulir Pengambilan Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formPengadaanBarang">
                        <div class="mb-3 d-flex justify-content-between">
                            <div class="w-50 me-2">
                                <label for="noSurat" class="form-label">No Surat</label>
                                <select class="form-control" id="noSurat" name="noSurat" required>
                                    <option value="">Pilih No Surat</option>
                                </select>
                            </div>
                            <div class="w-50">
                                <label for="tanggalKeluar" class="form-label">Tanggal Keluar</label>
                                <input type="date" class="form-control" id="tanggalKeluar" name="tanggalKeluar" readonly>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                <tr class="text-center">
                                    <th class="fs-6">ID Pengambilan</th>
                                    <th class="fs-6">Kode</th>
                                    <th class="fs-6">Nama Barang</th>
                                    <th class="fs-6">Jumlah</th>
                                </tr>
                                </thead>
                                <tbody id="tabelBarangOtomatis">
                                    <!-- ISI BARANG YANG OTOMATIS -->
                                </tbody>
                            </table>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
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

	<script src="/project_inventaris/vendors/jquery-nice-select/js/jquery.nice-select.min.js"></script>

    <script src="/project_inventaris/js/custom.min.js"></script>
	<script src="/project_inventaris/js/dlabnav-init.js"></script>

    <script src="/project_inventaris/vendors/sweetalert2/dist/sweetalert2.min.js"></script>

    <script>
        $(document).ready(function () {
            if (!$.fn.DataTable.isDataTable('#tabelbarangpengambilan')) {
                $('#tabelbarangpengambilan').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "backend/get_pengambilan_barang.php",
                        "type": "POST"
                    },
                    "columns": [
                        { "data": "no_surat", "orderable": true },
                        { "data": "tanggal", "orderable": true },
                        { "data": "ID_barang", "orderable": false },
						{ "data": "nama_barang", "orderable": true },
                        { "data": "jumlah_diambil", "orderable": false },
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

    <script>
        $(document).ready(function () {
            $.ajax({
                url: "backend/get_nosurat_pengambilan.php",
                method: "GET",
                dataType: "json",
                success: function (data) {
                    let options = `<option value="">Pilih No Surat</option>`;
                    data.forEach(item => {
                        options += `<option value="${item.id_pengambilan}" data-tanggal="${item.tanggal}">${item.no_surat}</option>`;
                    });
                    $('#noSurat').html(options);
                }
            });

            // Saat No Surat dipilih
            $('#noSurat').change(function () {
                let selectedTanggal = $(this).find(':selected').data('tanggal');
                $('#tanggalKeluar').val(selectedTanggal);

                let no_surat = $(this).find('option:selected').text(); 
                let id_pengambilan = $(this).val(); 
                
                console.log('No Surat:', no_surat);
                console.log('ID Pengambilan:', id_pengambilan);

                if (!id_pengambilan) {
                    $('#tabelBarangOtomatis').html("");
                    return;
                }

                $.ajax({
                    url: "backend/get_detail_pengambilan.php",
                    method: "GET",
                    data: { id_pengambilan: id_pengambilan },
                    dataType: "json",
                    success: function (data) {
                        let rows = '';
                        data.forEach(item => {
                            rows += `
                                <tr>
                                    <td>${item.id_pengambilan}</td>
                                    <td><input type="hidden" name="kodeBarang[]" value="${item.ID_barang}">${item.ID_barang}</td>
                                    <td>${item.nama_barang}</td>
                                    <td>${item.jumlah}</td>
                                </tr>`;
                        });
                        $('#tabelBarangOtomatis').html(rows);
                    },
                    error: function () {
                        $('#tabelBarangOtomatis').html('<tr><td colspan="3">Gagal memuat data barang.</td></tr>');
                    }
                });
            });

            // AJAX Submit Form
            $('#formPengadaanBarang').submit(function (e) {
                e.preventDefault();

                const formData = new FormData();
                const no_surat = $('#noSurat').find('option:selected').text();
                const tanggalKeluar = $('#tanggalKeluar').val();
                
                formData.append("noSurat", no_surat);
                formData.append("tanggalKeluar", tanggalKeluar);

                let dataBarang = [];
                $('#tabelBarangOtomatis tr').each(function (index) {
                    const ID_barang = $(this).find('td:eq(1)').text().trim(); 
                    const jumlah = $(this).find('td:eq(3)').text().trim();

                    dataBarang.push({ ID_barang, jumlah });
                });

                // Masukkan data barang ke FormData
                dataBarang.forEach((item, i) => {
                    formData.append(`data[${i}][ID_barang]`, item.ID_barang);
                    formData.append(`data[${i}][jumlah]`, item.jumlah);
                });

                $.ajax({
                    type: "POST",
                    url: "backend/insert_pengambilan_barang.php",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        if (response.status === "success") {
                            Swal.fire("Berhasil!", response.message, "success").then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire("Peringatan!", response.message, "warning");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire("Oops!", "Terjadi kesalahan saat menyimpan data.", "error");
                    }
                });
            });
        }); 

    </script>

	
    
</body>
</html>