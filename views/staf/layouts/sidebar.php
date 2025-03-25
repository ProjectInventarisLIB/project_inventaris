<section class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="dropdown header-profile">
                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                    <img src="/project_web/assets/user.png" width="20" alt=""/>
                    <div class="header-info ms-3">
                        <span class="font-w600"><b id="namaStaf1"></b></span>
                        <small class="text-end font-w400" id="emailStaf1"></small>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <div class="dropdown-item d-flex align-items-center">
                        <i class="fa fa-user-circle fa-sm text-primary"></i>
                        <span class="ms-3" id="namaStaf"></span>
                    </div>
                    <div class="dropdown-item d-flex align-items-center">
                        <i class="fa fa-envelope fa-sm text-primary"></i>
                        <span class="ms-3" id="emailStaf"></span>
                    </div>
                    <div class="dropdown-item d-flex align-items-center">
                        <i class="fa fa-money fa-sm text-primary"></i>                             
                        <span class="ms-3">
                            <span class="text-black" id="pengeluaranAnggaran"></span> / 
                            <span id="anggaran"></span>
                        </span>                                 
                    </div>
                    <div class="dropdown-item align-items-center">
                    <a href="/project_inventaris/login" class="btn btn-danger btn-xs">
                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-white" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        <span class="ms-2 fs-6 text-white">Keluar</span>
                    </a>  
                    </div>     
                </div>
            </li>
            <li><a href="index" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Halaman Utama</span>
                </a>
            </li>
            <li><a href="daftar_barang" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-022-copy"></i>
                    <span class="nav-text">Daftar Barang</span>
                </a>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-072-printer"></i>
                    <span class="nav-text">Formulir</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="./pengambilan">Pengambilan Barang</a></li>
                    <li><a href="./pengadaan">Pengadaan Barang</a></li>
                </ul>
            </li>
        </ul>
    </div>
</section>

 <!-- jquery-->
 <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- SCRIPT DATA STAF -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch("backend/get_staf")
            .then(response => response.json())
            .then(data => {
                if (!data.error) {
                    document.getElementById("namaStaf").innerText = data.nama_staf;
                    document.getElementById("emailStaf").innerText = data.email_staf;
                    document.getElementById("namaStaf1").innerText = data.nama_staf;
                    document.getElementById("emailStaf1").innerText = data.email_staf;
                    document.getElementById("pengeluaranAnggaran").innerText = formatRupiah(data.pengeluaran_anggaran);
                    document.getElementById("anggaran").innerText = formatRupiah(data.anggaran);
                    document.getElementById("pengeluaranAnggaran1").innerText = formatRupiah(data.pengeluaran_anggaran);
                    document.getElementById("anggaran1").innerText = formatRupiah(data.anggaran);
                } else {
                    console.error(data.error);
                }
            })
            .catch(error => console.error("Error:", error));
    });

    function formatRupiah(angka) {
    return "Rp. " + parseInt(angka).toLocaleString("id-ID");
}
</script>