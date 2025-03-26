<section class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="dropdown header-profile">
                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                    <img src="/project_inventaris/assets/user.png" width="20" alt=""/>
                    <div class="header-info ms-3">
                        <span class="font-w600"><b id="namaAdmin"></b></span>
                        <small class="text-end font-w400" id="emailAdmin"></small>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="/project_inventaris/login" class="dropdown-item ai-icon">
                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        <span class="ms-2">Keluar</span>
                    </a>
                </div>
            </li>
            <li><a href="index" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Halaman Utama</span>
                </a>
            </li>
            <li><a href="anggaran" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-034-filter"></i>
                    <span class="nav-text">Anggaran</span>
                </a>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                <i class="flaticon-022-copy"></i>
                <span class="nav-text">Barang</span>
            </a>
            <ul aria-expanded="false">
                <li><a href="./barang_pendataan">Pendataan Barang</a></li>
                <li><a href="./barang_pengambilan">Data Pengambilan Barang</a></li>
                <li><a href="./barang_pengajuan">Data Pengajuan Barang</a></li>
            </ul>
        </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-072-printer"></i>
                    <span class="nav-text">Permohonan</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="./permohonan_pengambilan">Pengambilan Barang</a></li>
                    <li><a href="./permohonan_pengadaan">Pengadaan Barang</a></li>
                </ul>
            </li>
        </ul>
    </div>
</section>


 <!-- jquery-->
 <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->

<!-- SCRIPT DATA STAF -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch("backend/get_admin")
            .then(response => response.json())
            .then(data => {
                if (!data.error) {
                    document.getElementById("namaAdmin").innerText = data.nama_admin;
                    document.getElementById("emailAdmin").innerText = data.email_admin;
                } else {
                    console.error(data.error);
                }
            })
            .catch(error => console.error("Error:", error));
    });
</script>