<?php
session_start();
?>

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
                                Halaman Utama 
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
				<div class="row invoice-card-row">
					<div class="col-xl-3 col-xxl-6 col-sm-6">
						<div class="card bg-utama invoice-card">
							<div class="card-body d-flex">
								<div class="icon me-3">
									<svg  width="33px" height="32px">
									<path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
									 d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z"/>
									</svg>
								</div>
								<div>
									<h2 id="invoiceNum" class="text-white invoice-num">0</h2>
									<span class="text-white fs-18">Total Surat Permohonan Pengambilan</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-6 col-sm-6">
						<div class="card bg-utama invoice-card">
							<div class="card-body d-flex">
								<div class="icon me-3">
									<svg width="35px" height="34px">
									<path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
									 d="M32.482,9.730 C31.092,6.789 28.892,4.319 26.120,2.586 C22.265,0.183 17.698,-0.580 13.271,0.442 C8.843,1.458 5.074,4.140 2.668,7.990 C0.255,11.840 -0.509,16.394 0.514,20.822 C1.538,25.244 4.224,29.008 8.072,31.411 C10.785,33.104 13.896,34.000 17.080,34.000 L17.286,34.000 C20.456,33.960 23.541,33.044 26.213,31.358 C26.991,30.866 27.217,29.844 26.725,29.067 C26.234,28.291 25.210,28.065 24.432,28.556 C22.285,29.917 19.799,30.654 17.246,30.687 C14.627,30.720 12.067,29.997 9.834,28.609 C6.730,26.671 4.569,23.644 3.752,20.085 C2.934,16.527 3.546,12.863 5.486,9.763 C9.488,3.370 17.957,1.418 24.359,5.414 C26.592,6.808 28.360,8.793 29.477,11.157 C30.568,13.460 30.993,16.016 30.707,18.539 C30.607,19.448 31.259,20.271 32.177,20.371 C33.087,20.470 33.911,19.820 34.011,18.904 C34.363,15.764 33.832,12.591 32.482,9.730 L32.482,9.730 Z"/>
									<path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
									 d="M22.593,11.237 L14.575,19.244 L11.604,16.277 C10.952,15.626 9.902,15.626 9.250,16.277 C8.599,16.927 8.599,17.976 9.250,18.627 L13.399,22.770 C13.725,23.095 14.150,23.254 14.575,23.254 C15.001,23.254 15.427,23.095 15.753,22.770 L24.940,13.588 C25.592,12.937 25.592,11.888 24.940,11.237 C24.289,10.593 23.238,10.593 22.593,11.237 L22.593,11.237 Z"/>
									</svg>
								</div>
								<div>
									<h2 id="invoiceNum3" class="text-white invoice-num">0</h2>
									<span class="text-white fs-18">Total Persetujuan Surat Permohonan Pengambilan</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-6 col-sm-6">
						<div class="card bg-kedua invoice-card">
							<div class="card-body d-flex">
								<div class="icon me-3">
									<svg  width="33px" height="32px">
									<path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
									d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z"/>
									</svg>
								</div>
								<div>
									<h2 id="invoiceNum2" class="text-white invoice-num">0</h2>
									<span class="text-white fs-18">Total Surat Permohonan Pengadaan</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-6 col-sm-6">
						<div class="card bg-kedua invoice-card">
							<div class="card-body d-flex">
								<div class="icon me-3">
									<svg width="35px" height="34px">
									<path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
									d="M32.482,9.730 C31.092,6.789 28.892,4.319 26.120,2.586 C22.265,0.183 17.698,-0.580 13.271,0.442 C8.843,1.458 5.074,4.140 2.668,7.990 C0.255,11.840 -0.509,16.394 0.514,20.822 C1.538,25.244 4.224,29.008 8.072,31.411 C10.785,33.104 13.896,34.000 17.080,34.000 L17.286,34.000 C20.456,33.960 23.541,33.044 26.213,31.358 C26.991,30.866 27.217,29.844 26.725,29.067 C26.234,28.291 25.210,28.065 24.432,28.556 C22.285,29.917 19.799,30.654 17.246,30.687 C14.627,30.720 12.067,29.997 9.834,28.609 C6.730,26.671 4.569,23.644 3.752,20.085 C2.934,16.527 3.546,12.863 5.486,9.763 C9.488,3.370 17.957,1.418 24.359,5.414 C26.592,6.808 28.360,8.793 29.477,11.157 C30.568,13.460 30.993,16.016 30.707,18.539 C30.607,19.448 31.259,20.271 32.177,20.371 C33.087,20.470 33.911,19.820 34.011,18.904 C34.363,15.764 33.832,12.591 32.482,9.730 L32.482,9.730 Z"/>
									<path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
									d="M22.593,11.237 L14.575,19.244 L11.604,16.277 C10.952,15.626 9.902,15.626 9.250,16.277 C8.599,16.927 8.599,17.976 9.250,18.627 L13.399,22.770 C13.725,23.095 14.150,23.254 14.575,23.254 C15.001,23.254 15.427,23.095 15.753,22.770 L24.940,13.588 C25.592,12.937 25.592,11.888 24.940,11.237 C24.289,10.593 23.238,10.593 22.593,11.237 L22.593,11.237 Z"/>
									</svg>
								</div>
								<div>
									<h2 id="invoiceNum4" class="text-white invoice-num">0</h2>
									<span class="text-white fs-18">Total Persetujuan Surat Permohonan Pengadaan</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-3 col-xxl-5">
						<div class="card">
							<div class="card-header border-0 pb-0">
								<div>
									<h4 class="card-title mb-2">Pengeluaran Periode <span id="periodeStaf"></span></h4>
									<span class="fs-12">persenan pengeluaran <span id="divisiStaf"></span></span>
								</div>
							</div>
							<div class="card-body">	
								<div class="progress default-progress mt-4">
									<div class="progress-bar bg-gradient-4 progress-animated" style="width: 0%; height:20px;" role="progressbar" id="progressBar">
										<span class="sr-only" id="progressText">0% Complete</span>
									</div>
								</div>
								<div class="d-flex align-items-end mt-2 pb-3 justify-content-between">
									<span class="fs-18"><span class="text-black pe-2" id="pengeluaranAnggaran1"></span></span>
									<span class="fs-18"><span class="text-black pe-2"></span>/</span>
									<span class="fs-18"><span class="pe-2" id="anggaran1"></span></span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-xxl-7">
						<div class="card">
							<div class="card-header d-flex flex-wrap border-0 pb-0">
								<div class="me-auto mb-sm-0 mb-3">
									<h4 class="card-title mb-2">Tinjau Pengelolaan</h4>
									<span class="fs-12">Bagan pengelolaan surat tiap bulan departemen pergudangan</span>
								</div>
								<a href="backend/laporan_surat.php" class="btn btn-rounded btn-md btn-utama mr-3 me-3 text-white"><i class="las la-download scale5 me-3"></i>Unduh Laporan</a>
							</div>
							<div class="card-body pb-2">
								<div class="row  mt-xl-0 mt-4">
									<div class="col-md-6">
										<canvas id="chartsurat"></canvas>
									</div>
									<div class="col-md-6">
										<ul class="card-list mt-4" id="surat-status-list">
											<!-- Data akan diisi secara dinamis oleh JavaScript -->
										</ul>
									</div>
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
	

    <!-- Required vendorss -->
    <script src="/project_inventaris/vendors/global/global.min.js"></script>
	<script src="/project_inventaris/vendors/chart.js/Chart.bundle.min.js"></script>
	<script src="/project_inventaris/vendors/jquery-nice-select/js/jquery.nice-select.min.js"></script>
	
	<!-- Apex Chart -->
	<script src="/project_inventaris/vendors/apexchart/apexchart.js"></script>
	<script src="/project_inventaris/vendors/nouislider/nouislider.min.js"></script>
	<script src="/project_inventaris/vendors/wnumb/wNumb.js"></script>
	
	<!-- Dashboard 1 -->
	<!-- <script src="/project_inventaris/js/dashboard/dashboard-1.js"></script> -->

    <script src="/project_inventaris/js/custom.min.js"></script>
	<script src="/project_inventaris/js/dlabnav-init.js"></script>

    <!-- Init file -->
    <script src="/project_inventaris/js/plugins-init/widgets-script-init.js"></script>


	<!-- SCRIPT PERSENAN PROGRESS BAR -->
	<script>
		$(document).ready(function() {
			$.ajax({
				url: "backend/get_staf.php", 
				method: "GET",
				dataType: "json",
				success: function(response) {
					if (response.error) {
						console.error(response.error);
						$("#progressText").text("Error: " + response.error);
						return;
					}

					var pengeluaranAnggaran = parseFloat(response.pengeluaran_anggaran1) || 0;
					var anggaran = parseFloat(response.anggaran1) || 1;

					var persen = (pengeluaranAnggaran / anggaran) * 100;
					persen = persen.toFixed(2);

					// Update progress bar
					$("#progressBar").css("width", persen + "%");
					$("#progressText").text(persen + "% Complete");
				},
				error: function(xhr, status, error) {
					console.error("Error mengambil data:", error);
					$("#progressText").text("Error mengambil data");
				}
			});
		});
	</script>


	<!-- SCRIPT JUMLAH SURAT -->
	<script>
		$(document).ready(function() {
			$.ajax({
				url: "backend/get_surat.php", // Panggil API yang sudah digabung
				method: "GET",
				dataType: "json",
				success: function(response) {
					console.log(response);
					$("#invoiceNum2").text(response.total_pengadaan); // Total surat pengadaan
					$("#invoiceNum").text(response.total_peminjaman); // Total surat peminjaman
					$("#invoiceNum4").text(response.pengadaan_disetujui); // Surat pengadaan disetujui
					$("#invoiceNum3").text(response.peminjaman_disetujui); // Surat peminjaman disetujui
				},
				error: function(xhr, status, error) {
					console.error("Error mengambil data:", error);
				}
			});
		});
	</script>

	<script>
		$(document).ready(function() {
			$.ajax({
				url: "backend/get_staf.php", // Panggil API yang sudah digabung
				method: "GET",
				dataType: "json",
				success: function(response) {
					console.log(response);
					$("#divisiStaf").text(response.nama_staf);
					$("#periodeStaf").text(response.periode_anggaran);
				},
				error: function(xhr, status, error) {
					console.error("Error mengambil data:", error);
				}
			});
		});
	</script>

	<script>
		(function($) {
			var dlabChartlist = function(){
				var screenWidth = $(window).width();    

				var chartsurat = function(){
					$.ajax({
						url: 'backend/get_chart.php', // Sesuaikan dengan path backend
						type: 'GET',
						dataType: 'json',
						success: function(response) {
							var ctx = document.getElementById("chartsurat").getContext('2d');
							Chart.defaults.global.legend.display = false;

							// Warna yang sesuai untuk setiap status
							var colorMap = {
								'Diproses': "#ffa755",
								'Disetujui': "#68e365",
								'Ditolak': "#f72b50"
							};

							var labels = Object.keys(response);
							var dataValues = Object.values(response);
							var backgroundColors = labels.map(label => colorMap[label] || "#cccccc"); // Default warna abu-abu jika tidak dikenali

							var myChart = new Chart(ctx, {
								type: 'polarArea',
								data: {
									labels: labels,
									datasets: [{
										backgroundColor: backgroundColors,
										data: dataValues
									}]
								},
								options: {
									weight: 1,    
									cutoutPercentage: 70,
									responsive: true,
									maintainAspectRatio: false,
									scale: {
										scaleShowLine:false,
										display:false,
										pointLabels:{
											fontSize: 0       
										},
									},
									tooltips:{
										enabled:false,
									}
								}
							});
						},

						error: function(xhr, status, error) {
							console.error("Gagal mengambil data:", error);
						}
					});
				};

				/* Function ============ */
				return {
					init:function(){},            
					load:function(){
						chartsurat();                
					},    
					resize:function(){}
				};

			}();    

			jQuery(window).on('load',function(){
				setTimeout(function(){
					dlabChartlist.load();
				}, 1000); 
			});

		})(jQuery);
	</script>

	<script>
		(function($) {
			var updateSuratStatus = function(){
				$.ajax({
					url: 'backend/get_chart.php', // Sesuaikan dengan path backend
					type: 'GET',
					dataType: 'json',
					success: function(response) {
						var total = Object.values(response).reduce((a, b) => a + b, 0); // Total semua surat
						var listElement = $("#surat-status-list");
						listElement.empty(); // Hapus elemen lama sebelum update

						var statusMap = {
							"Disetujui": "bg-success",
							"Diproses": "bg-warning",
							"Ditolak": "bg-danger"
						};

						Object.entries(response).forEach(([status, count]) => {
							var percentage = total > 0 ? ((count / total) * 100).toFixed(1) + "%" : "0%";
							var statusClass = statusMap[status] || "bg-secondary"; // Default jika tidak ditemukan

							var listItem = `
								<li>
									<span class="${statusClass} circle"></span>
									Surat ${status} <span>${percentage}</span>
								</li>
							`;
							listElement.append(listItem);
						});
					},
					error: function(xhr, status, error) {
						console.error("Gagal mengambil data:", error);
					}
				});
			};

			jQuery(window).on('load', function(){
				setTimeout(updateSuratStatus, 1000); 
			});

		})(jQuery);
	</script>

	
</body>
</html>