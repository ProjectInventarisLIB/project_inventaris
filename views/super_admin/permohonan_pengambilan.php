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
	
	<link href="/project_web/vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
	<link rel="stylesheet" href="/project_web/vendor/nouislider/nouislider.min.css">

	<!-- Chartist -->
	<link rel="stylesheet" href="/project_web/vendor/chartist/css/chartist.min.css">
	
    <link href="/project_web/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
	<link href="/project_web/vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">

    <!-- Datatable -->
    <link href="/project_web/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

	<!-- Style css -->
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
                                Permohonan Pengambilan Barang 
                            </div>
                        </div>
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
            <!-- row -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>No Surat</th>
                                                <th>Nama Barang</th>
                                                <th>Deskripsi</th>
												<th>Tujuan</th>
                                                <th>Link Surat</th>
                                                <th>Persetujuan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>OPS-2025/001</td>
                                                <td>Radio HT</td>
												<td>2 buah</td>
                                                <td>Untuk komunikasi antar petugas</td>
                                                <td><a href=""><strong>Lihat Surat</strong></a></td>
												<td>
													<div class="d-flex">
														<a class="btn btn-success btn-xs px-3 py-2 rounded-0">Setujui</a>
														<a class="btn btn-danger btn-xs px-3 py-2 rounded-0">Tolak</a>
													</div>											
												</td>												
                                            </tr>
											<tr>
                                                <td>ADM-2025/002</td>
                                                <td>Printer LaserJet</td>
												<td>2 buah</td>
                                                <td>Untuk pencetakan dokumen kantor</td>
                                                <td><a href="javascript:void(0);"><strong>Lihat Surat</strong></a></td>
												<td>
													<div class="d-flex">
														<a class="btn btn-success btn-xs px-3 py-2 rounded-0">Setujui</a>
														<a class="btn btn-danger btn-xs px-3 py-2 rounded-0">Tolak</a>
													</div>											
												</td>												
                                            </tr>
											<tr>
                                                <td>K3-2025/003</td>
                                                <td>Helm Safety</td>
												<td>2 buah</td>
                                                <td>Untuk perlindungan pekerja lapangan</td>
                                                <td><a href="javascript:void(0);"><strong>Lihat Surat</strong></a></td>
												<td>
													<div class="d-flex">
														<a class="btn btn-success btn-xs px-3 py-2 rounded-0">Setujui</a>
														<a class="btn btn-danger btn-xs px-3 py-2 rounded-0">Tolak</a>
													</div>											
												</td>												
                                            </tr>
											<tr>
                                                <td>SEC-2025/004</td>
                                                <td>Rompi Safety</td>
												<td>2 buah</td>
												<td>Untuk petugas Keamanan</td>
                                                <td><a href="javascript:void(0);"><strong>Lihat Surat</strong></a></td>
												<td>
													<div class="d-flex">
														<a class="btn btn-success btn-xs px-3 py-2 rounded-0">Setujui</a>
														<a class="btn btn-danger btn-xs px-3 py-2 rounded-0">Tolak</a>
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


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="/project_web/vendor/global/global.min.js"></script>
	<script src="/project_web/vendor/chart.js/Chart.bundle.min.js"></script>
	<script src="/vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
	
	<!-- Apex Chart -->
	<script src="/project_web/vendor/apexchart/apexchart.js"></script>
	<script src="/project_web/vendor/nouislider/nouislider.min.js"></script>
	<script src="/project_web/vendor/wnumb/wNumb.js"></script>
	
	<!-- Dashboard 1 -->
	<script src="/project_web/js/dashboard/dashboard-1.js"></script>

    <script src="/project_web/js/custom.min.js"></script>
	<script src="/project_web/js/dlabnav-init.js"></script>


    <!-- Init file -->
    <script src="/project_web/js/plugins-init/widgets-script-init.js"></script>

	
    <!-- Datatable -->
    <script src="/project_web/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/project_web/js/plugins-init/datatables.init.js"></script>

	
</body>
</html>