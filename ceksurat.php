<?php
require_once __DIR__ . '/vendor/autoload.php';


$mpdf = new \Mpdf\Mpdf();

// Konten HTML untuk surat
$html = '
<style>
    body { font-family: "Times New Roman", Times, serif; font-size: 12pt; }
    .header { text-align: left; margin-bottom: 20px; }
    .content { text-align: justify; }
    .signature { margin-top: 50px; text-align: left; }
    .bold { font-weight: bold; }
</style>

<div class="header">
    <p><span class="bold">Nomor</span> : 01/SPB/SNJ/I/2018</p>
    <p><span class="bold">Perihal</span> : Pengantar Pengambilan Barang</p>
    <p><span class="bold">Lampiran</span> : -</p>
</div>

<p>Kepada Yth.</p>
<p class="bold">PT. PP (PERSERO) TBK.<br>
Proyek Manhattan Mall & Condominium</p>
<p>Up. Bpk. Antok Saptodewo</p>

<p class="content">Dengan hormat,</p>
<p class="content">
Melalui surat ini kami sampaikan bahwa Kami PT. Srikandhi Nusantara Jaya bertujuan melakukan pengambilan barang kami yang masih tersisa di gudang SNJ area proyek <span class="bold">Manhattan Mall & Condominium</span> dengan rincian barang dan jumlah terlampir bersama surat ini.
</p>

<p class="content">Demikian kami sampaikan. Atas perhatian Bapak, kami ucapkan terima kasih.</p>

<div class="signature">
    <p>Medan, 05 Januari 2018</p>
    <p>Hormat kami,</p>
    <p><span class="bold">PT. Srikandhi Nusantara Jaya</span></p>
    <br><br><br>
    <p><span class="bold">Eko Purwanto</span></p>
    <p>Project Manager</p>
</div>
';

// Generate PDF
$mpdf->WriteHTML($html);
$mpdf->Output('Surat_Pengambilan_Barang.pdf', 'I'); // 'I' untuk tampilkan di browser, 'D' untuk download

?>
