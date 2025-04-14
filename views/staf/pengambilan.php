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
    <link rel="stylesheet" href="/project_inventaris/vendors/select2/css/select2.min.css">
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
                                Data Pengambilan 
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item">
								<button type="button" class="btn btn-primary d-sm-inline-block d-none" id="btnTambahData">
                                    Tambah Pengambilan <i class="fa fa-plus ms-3 scale4"></i>
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
                                    <table id="tabelPengambilan" class="display table table-bordered table-sm" style="width: 100%">
                                        <thead class="bg-tableheader">
                                            <tr class="text-center">
                                                <th>No Surat</th>
                                                <th>Tanggal</th>
                                                <th style="width: 300px;">Nama Barang</th>
                                                <th>Link Surat</th>
                                                <th>Status</th>
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
    <div class="modal fade" id="modalPengambilanBarang" tabindex="-1" aria-labelledby="modalPengambilanBarangLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPengambilanBarangLabel">Formulir Pengambilan Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formPengambilanBarang">
                        <div class="mb-3 d-flex justify-content-between">
                            <div class="w-50 me-2">
                                <label for="noSurat" class="form-label">No. Surat</label>
                                <input type="text" class="form-control" id="noSurat" name="noSurat" readonly>
                            </div>
                            <div class="w-50">
                                <label for="idPengambilan" class="form-label">ID pengambilan</label>
                                <input type="text" class="form-control" id="idPengambilan" name="idPengambilan" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <div class="flex-grow-1">
                                    <label for="namaBarang" class="form-label">Nama Barang</label>
                                    <select class="form-select" id="namaBarang" name="namaBarang"></select>
                                </div>
                                <div class="col-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" id="jumlah" name="jumlah" min="1">
                                </div>
                                <div class="d-flex align-items-center mt-4">
                                    <button type="button" class="btn p-0 border-0 bg-transparent" id="btnTambahBarangKeTabel" title="Tambah">
                                        <i class="fa fa-plus fs-5 text-primary"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                <tr class="text-center">
                                    <th class="fs-6">Kode</th>
                                    <th class="fs-6">Nama Barang</th>
                                    <th class="fs-6">Stok</th>
                                    <th class="fs-6">Jumlah</th>
                                    <th class="fs-6">Hapus</th>
                                </tr>
                                </thead>
                                <tbody id="tabelBarangDipilih">
                                    <!-- ISI BARANG YANG DIPILIH -->
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-3">
                            <label for="tujuan" class="form-label">Tujuan</label>
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
    <script src="/project_inventaris/vendors/global/global.min.js"></script>

    <!-- Datatable -->
    <script src="/project_inventaris/vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/project_inventaris/js/plugins-init/datatables.init.js"></script>

    <script src="/project_inventaris/js/custom.min.js"></script>
	<script src="/project_inventaris/js/dlabnav-init.js"></script>
	
    <script src="/project_inventaris/vendors/select2/js/select2.full.min.js"></script>
    <script src="/project_inventaris/js/plugins-init/select2-init.js"></script>

    <script src="/project_inventaris/vendors/jquery-nice-select/js/jquery.nice-select.min.js"></script>

    <script src="/project_inventaris/vendors/sweetalert2/dist/sweetalert2.min.js"></script>



    <!-- Script untuk membuka modal -->
	<script>
	document.addEventListener("DOMContentLoaded", function() {
		document.getElementById("btnTambahData").addEventListener("click", function() {
			var modal = new bootstrap.Modal(document.getElementById("modalPengambilanBarang"));
			modal.show();
		});
	});
	</script>
		
    <!-- TAMPILKAN TABEL SURAT -->
    <script>
        $(document).ready(function () {
            if (!$.fn.DataTable.isDataTable('#tabelPengambilan')) {
                $('#tabelPengambilan').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "backend/get_pengambilan.php",
                        "type": "POST"
                    },
                    "columns": [
                        { "data": "no_surat", "orderable": true },
                        { "data": "tanggal", "orderable": true },
                        { "data": "nama_barang", "orderable": true },
                        { "data": "link_surat", "orderable": false },
                        { 
                            "data": "status", 
                            "orderable": true,
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
    </script>

    <!-- TAMPILKAN PILIHAN NAMA BARANG DI SELECT2 -->
    <script>
        function getKodeBarangFromText(text) {
            return text.split(' - ')[0];
        }

        $('#modalPengambilanBarang').on('shown.bs.modal', function () {
            $('#namaBarang').select2({
                dropdownParent: $('#modalPengambilanBarang'),
                ajax: {
                    url: 'backend/get_namabarang.php',
                    type: 'GET',
                    dataType: 'json',
                    processResults: function (data) {
                        const filtered = data.filter(item => {
                            const kode = getKodeBarangFromText(item.text);
                            return !dataBarang.some(b => b.kodeBarang === kode);
                        });

                        return {
                            results: filtered
                        };
                    }
                },
                templateResult: function (data) {
                    if (!data.id) return data.text;

                    var $item = $('<span>' + data.text + '</span>');
                    if (data.disabled) {
                        $item.addClass('text-light');
                    }

                    return $item;
                }
            });
            $('#namaBarang').val(null).trigger('change');
        });
    </script>


     <!-- AMBIL NOMOR SURAT -->
     <script>
       document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("btnTambahData").addEventListener("click", function () {
                fetch("backend/nosurat_ambil.php")
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("noSurat").value = data.no_surat;
                    })
                    .catch(error => console.error("Error:", error));
            });
        });
    </script>

    <!-- AMBIL ID PENGAMBILAN -->
    <script>
       document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("btnTambahData").addEventListener("click", function () {
                fetch("backend/get_id_pengambilan")
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("idPengambilan").value = data.id_pengambilan;
                    })
                    .catch(error => console.error("Error:", error));
            });
        });
    </script>


    <!-- TAMBAH BARANG KE TABEL MODAL -->
    <script>
        let dataBarang = [];
        $('#btnTambahBarangKeTabel').on('click', function () {
            var namaBarangFull = $('#namaBarang').select2('data')[0].text;
            var jumlah = parseInt($('#jumlah').val());

            var kodeBarang = namaBarangFull.split(' - ')[0];
            var namaDanStok = namaBarangFull.split(' - ')[1];
            var namaSaja = namaDanStok.split(' (')[0];
            var stokBarang = parseInt(namaDanStok.match(/\d+/)[0]);

            // Validasi jumlah
            if (isNaN(jumlah) || jumlah < 1) {
                swal("Oops!", "Jumlah barang minimal 1!", "warning");
                return;
            }
            if (jumlah > stokBarang) {
                swal("Stok tidak cukup!", "Jumlah melebihi stok yang tersedia (" + stokBarang + ")", "error");
                return;
            }
            dataBarang.push({
                kodeBarang: kodeBarang,
                namaSaja: namaSaja,
                jumlah: jumlah
            });

            console.log("Isi dataBarang setelah ditambah:", dataBarang);

            var row = '<tr>';
            row += '<td class="text-center">' + kodeBarang + '</td>';
            row += '<td class="text-center">' + namaSaja + '</td>';
            row += '<td class="text-center">' + stokBarang + '</td>';
            row += '<td class="text-center">' + jumlah + '</td>';
            row += `<td class="text-center">
                        <a href="#" class="btn btn-danger shadow btn-xs sharp btn-delete" title="Hapus">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>`;
            row += '</tr>';

            $('#tabelBarangDipilih').append(row);

            $('#jumlah').val('');
            $('#namaBarang').val(null).trigger('change');
        });
    </script>

        
    <!-- TAMBAHKAN SURAT -->
    <script>
        $("#formPengambilanBarang").submit(function (e) {
            e.preventDefault();

            var formData = $(this).serializeArray();
            var dataForm = {};
            $.each(formData, function(i, field) {
                dataForm[field.name] = field.value;
            });

            $('#tabelBarangDipilih tbody tr').each(function () {
                var kodeBarang = $(this).find('td:eq(0)').text();
                var namaSaja = $(this).find('td:eq(1)').text();
                var jumlah = parseInt($(this).find('td:eq(3)').text());

                dataBarang.push({
                    kodeBarang: kodeBarang,
                    namaSaja: namaSaja,
                    jumlah: jumlah
                });
            });

            console.log("Isi dataBarang:", dataBarang);
            if (dataBarang.length === 0) {
                swal("Oops!", "Silakan tambahkan minimal satu barang.", "warning");
                return;
            }
            $.ajax({
                type: "POST",
                url: "backend/insert_pengambilan.php",
                data: {
                    ...dataForm, 
                    dataBarang: JSON.stringify(dataBarang)
                },
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