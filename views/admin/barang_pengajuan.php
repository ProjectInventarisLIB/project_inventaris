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
                                Pengajuan Barang 
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item">
								<button type="button" class="btn btn-primary d-sm-inline-block d-none" id="btnTambahData">
                                    Ajukan Barang<i class="fa fa-plus ms-3 scale4"></i>
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
                                    <table id="tabelbarangpengajuan" class="display table table-bordered table-sm" style="min-width: 100%">
                                        <thead class="bg-tableheader">
                                            <tr class="text-center">
                                                <th>ID Barang</th>
                                                <th>Surat Terkait</th>
                                                <th>Tanggal</th>
                                                <th>Nama Barang</th>
                                                <th>Deskripsi</th>
                                                <th>Jumlah</th>
                                                <th>Satuan</th>
                                                <th>Dana Final</th>
                                                <th>Vendor</th>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPengadaanBarangLabel">Formulir Pengajuan Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formPengadaanBarang">
                        <div class="mb-3 d-flex justify-content-between">
                            <div class="w-50 me-2">
                                <label for="kodeBarang" class="form-label">ID Barang</label>
                                <input type="text" class="form-control" id="kodeBarang" name="kodeBarang" readonly>
                            </div>
                            <div class="w-50">
                                <label for="tanggalKeluar" class="form-label">Tanggal Keluar</label>
                                <input type="date" class="form-control" id="tanggalKeluar" name="tanggalKeluar" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="noSurat" class="form-label">No Surat</label>
                            <select class="form-control" id="noSurat" name="noSurat" required>
                                <option value="">Pilih No Surat</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="namaBarang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="namaBarang" name="namaBarang" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="2" readonly></textarea>
                        </div>
                        <div class="mb-3 d-flex justify-content-between">
                            <div class="w-50 me-2">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" readonly>
                            </div>
                            <div class="w-50">
                                <label for="satuan" class="form-label">Satuan</label>
                                <input class="form-control" id="satuan"  name="satuan" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="anggaran" class="form-label">Estimasi Dana</label>
                            <input type="number" class="form-control" id="anggaran" name="anggaran" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="danaFinal" class="form-label">Dana Final</label>
                            <input type="number" class="form-control" id="danaFinal" name="danaFinal" required>
                        </div>
                        <div class="mb-3">
                            <label for="namaVendor" class="form-label">Vendor</label>
                            <select class="form-control" id="namaVendor" name="namaVendor" required>
                                <option value="">Pilih Vendor</option>
                            </select>
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

	<script src="/project_inventaris/vendors/jquery-nice-select/js/jquery.nice-select.min.js"></script>

    <script src="/project_inventaris/js/custom.min.js"></script>
	<script src="/project_inventaris/js/dlabnav-init.js"></script>

    <script src="/project_inventaris/vendors/sweetalert2/dist/sweetalert2.min.js"></script>


    <script>
        $(document).ready(function () {
            if (!$.fn.DataTable.isDataTable('#tabelbarangpengajuan')) {
                $('#tabelbarangpengajuan').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "backend/get_pengajuan_barang.php",
                        "type": "POST"
                    },
                    "columns": [
                        { "data": "ID_barang", "orderable": true },
                        { "data": "no_surat", "orderable": true },
						{ "data": "tanggal", "orderable": true },
                        { "data": "nama_barang", "orderable": true },
                        { "data": "deskripsi", "orderable": false },
                        { "data": "jumlah_diperlukan", "orderable": false },
                        { "data": "satuan", "orderable": false },
                        { 
							"data": "dana_final", 
							"orderable": false,
							"render": function (data, type, row) {
								return formatRupiah(data);
							}
						},
                        { "data": "nama_vendor", "orderable": false },
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

    <script>
        $(document).ready(function() {
            // Fungsi untuk menghasilkan ID Barang secara otomatis
            function generateKodeBarang() {
                $.ajax({
                    url: 'backend/get_kodebarang_pengajuan.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.lastKode) {
                            let lastKode = response.lastKode;
                            let angkaKode = parseInt(lastKode.replace('BRGPGDN', ''), 10); 
                            let newKode = 'BRGPGDN' + (angkaKode + 1).toString().padStart(3, '0');

                            console.log("Kode baru:", newKode); 
                            $('#kodeBarang').val(newKode);
                        } else {
                            $('#kodeBarang').val('BRGPGDN001');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error mengambil kode barang:", error);
                        $('#kodeBarang').val('BRGPGDN001');
                    }
                });
            }

            $('#modalPengadaanBarang').on('show.bs.modal', function() {
                generateKodeBarang();

                $.ajax({
                    url: "backend/get_nosurat_pengajuan.php",
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        let options = "<option value=''>Pilih No Surat</option>";
                        data.forEach(item => {
                            options += `<option value='${item.no_surat}' 
                                            data-nama='${item.nama_barang}' 
                                            data-deskripsi='${item.deskripsi}' 
                                            data-jumlah='${item.jumlah}'
                                            data-satuan='${item.satuan}' 
                                            data-anggaran='${item.anggaran}'>${item.no_surat}</option>`;
                        });
                        $('#noSurat').html(options);
                    }
                });

                $.ajax({
                    url: "backend/get_nama_vendor.php",
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        let options = "<option value=''>Pilih Vendor</option>";
                        $.each(data, function(index, vendor) {
                            options += `<option value="${vendor.nama_vendor}">${vendor.nama_vendor}</option>`;
                        });
                        $('#namaVendor').html(options);
                    },
                    error: function(xhr, status, error) {
                        console.error("Gagal mengambil data vendor:", error);
                    }
                });
            });

            // Auto-fill input berdasarkan pilihan No Surat
            $('#noSurat').change(function () {
                var selectedOption = $(this).find('option:selected');
                $('#namaBarang').val(selectedOption.data('nama') || '');
                $('#deskripsi').val(selectedOption.data('deskripsi') || '');
                $('#jumlah').val(selectedOption.data('jumlah') || '');
                $('#satuan').val(selectedOption.data('satuan') || '');
                $('#anggaran').val(selectedOption.data('anggaran') || '');
            });



            // AJAX Submit Form
            $('#formPengadaanBarang').submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "backend/insert_pengajuan_barang.php",
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
        });
    </script>
	
    
</body>
</html>