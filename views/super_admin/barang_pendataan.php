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
    <link href="/project_web/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
	<link href="/project_web/vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link href="/project_web/css/style.css" rel="stylesheet">

</head>

<body>

    <div id="main-wrapper">

        <!-- NAVBAR -->
		<div class="nav-header">
            <a href="index.php" class="brand-logo">
				<img class="logo-abbr" src="/project_web/assets/logo_gambar.png" alt="Logo Abbreviation" width="53" height="53">
				<img class="brand-title" src="/project_web/assets/logo_tulisan.png" alt="Brand Title" width="124" height="53">
			</a>
			
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>

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
        <div class="dlabnav">
            <div class="dlabnav-scroll">
				<ul class="metismenu" id="menu">
					<li class="dropdown header-profile">
						<a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
							<img src="/project_web/assets/user.png" width="20" alt=""/>
							<div class="header-info ms-3">
								<span class="font-w600 "><b>Super Admin</b></span>
								<small class="text-end font-w400">superadmin@gmail.com</small>
							</div>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<a href="/login.php" class="dropdown-item ai-icon">
								<svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
								<span class="ms-2">Keluar</span>
							</a>
						</div>
					</li>
                    <li><a href="index.php" class="ai-icon" aria-expanded="false">
							<i class="flaticon-025-dashboard"></i>
							<span class="nav-text">Halaman Utama</span>
						</a>
                    </li>
					<li><a href="anggaran.php" class="ai-icon" aria-expanded="false">
							<i class="flaticon-034-filter"></i>
							<span class="nav-text">Anggaran</span>
						</a>
					</li>
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
						<i class="flaticon-022-copy"></i>
						<span class="nav-text">Barang</span>
					</a>
					<ul aria-expanded="false">
						<li><a href="./barang_pendataan.php">Pendataan Barang</a></li>
						<li><a href="./barang_pengambilan.php">Data Pengambilan Barang</a></li>
						<li><a href="./barang_pengajuan.php">Data Pengajuan Barang</a></li>
					</ul>
				</li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-072-printer"></i>
							<span class="nav-text">Permohonan</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="./permohonan_pengambilan.php">Pengambilan Barang</a></li>
                            <li><a href="./permohonan_pengadaan.php">Pengadaan Barang</a></li>
                        </ul>
                    </li>
                </ul>
			</div>
        </div>

        <!-- CONTENT -->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example4" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Gambar</th>
                                                <th>Tanggal</th>
                                                <th>Kode</th>
                                                <th>Nama Barang</th>
                                                <th>Deskripsi</th>
                                                <th>Stok</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><img class="img-fluid" width="60" src="/project_web/images/profile/small/pic1.jpg" alt=""></td>
                                                <td>21/01/2025</td>
                                                <td>DI-098</td>
                                                <td>Baut Stainless</td>
                                                <td>XL x 2mm</td>
                                                <td>200</td>
                                                <td>
													<div class="d-flex">
														<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
														<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
													</div>
												</td>
                                            </tr>
                                            <tr>
                                                <td><img class="img-fluid" width="60" src="/project_web/images/profile/small/pic1.jpg" alt=""></td>
                                                <td>21/01/2025</td>
												<td>DI-098</td>
                                                <td>Baut Stainless</td>
                                                <td>XL x 2mm</td>
                                                <td>200</td>
                                                <td>
													<div class="d-flex">
														<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
														<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
													</div>
												</td>
                                            </tr>
                                            <tr>
                                                <td><img class="img-fluid" width="60" src="/project_web/images/profile/small/pic1.jpg" alt=""></td>
                                                <td>21/01/2025</td>
												<td>DI-098</td>
                                                <td>Baut Stainless</td>
                                                <td>XL x 2mm</td>
                                                <td>200</td>
                                                <td>
													<div class="d-flex">
														<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
														<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
													</div>
												</td>
                                            </tr>
                                            <tr>
                                                <td><img class="img-fluid" width="60" src="/project_web/images/profile/small/pic1.jpg" alt=""></td>
                                                <td>21/01/2025</td>
												<td>DI-098</td>
                                                <td>Baut Stainless</td>
                                                <td>XL x 2mm</td>
                                                <td>200</td>
                                                <td>
													<div class="d-flex">
														<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
														<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
													</div>
												</td>
                                            </tr>
                                            <tr>
                                                <td><img class="img-fluid" width="60" src="/project_web/images/profile/small/pic1.jpg" alt=""></td>
                                                <td>21/01/2025</td>
												<td>DI-098</td>
                                                <td>Baut Stainless</td>
                                                <td>XL x 2mm</td>
                                                <td>200</td>
                                                <td>
													<div class="d-flex">
														<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
														<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
													</div>
												</td>
                                            </tr>
                                            <tr>
                                                <td><img class="img-fluid" width="60" src="/project_web/images/profile/small/pic1.jpg" alt=""></td>
                                                <td>21/01/2025</td>
												<td>DI-098</td>
                                                <td>Baut Stainless</td>
                                                <td>XL x 2mm</td>
                                                <td>200</td>
                                                <td>
													<div class="d-flex">
														<a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
														<a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
													</div>
												</td>
                                            </tr>
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
		
  
    <!-- Required vendors -->
    <script src="/project_web/vendor/global/global.min.js"></script>
    <script src="/project_web/vendor/chart.js/Chart.bundle.min.js"></script>
	<!-- Apex Chart -->
	<script src="/project_web/vendor/apexchart/apexchart.js"></script>
	
    <!-- Datatable -->
    <script src="/project_web/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/project_web/js/plugins-init/datatables.init.js"></script>

	<script src="/vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

    <script src="/project_web/js/custom.min.js"></script>
	<script src="/project_web/js/dlabnav-init.js"></script>
	
    
</body>
</html>