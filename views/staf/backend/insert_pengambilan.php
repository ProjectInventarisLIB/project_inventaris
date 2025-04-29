<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/vendor/autoload.php");
use Mpdf\Mpdf;

session_start();
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idStaf = $_SESSION['ID_staf'];

    $queryStaf = "SELECT nama_staf FROM staf WHERE ID_staf = '$idStaf'";
    $resultStaf = $conn->query($queryStaf);

    if ($resultStaf->num_rows > 0) {
        $rowStaf = $resultStaf->fetch_assoc();
        $namaStaf = $rowStaf['nama_staf'];
    } else {
        echo json_encode(["status" => "error", "message" => "Data staf tidak ditemukan"]);
        exit();
    }

    $noSurat = $conn->real_escape_string($_POST['noSurat']);
    $tujuan = $conn->real_escape_string($_POST['tujuan']);
    $idPengambilan = $conn->real_escape_string($_POST['idPengambilan']);
    $tanggalDiperlukan = date('Y-m-d');
    $status = "Diproses";
    
    $barangData = json_decode($_POST['dataBarang'], true);
    if (!$barangData || !is_array($barangData)) {
        echo json_encode(["status" => "error", "message" => "Data barang tidak valid."]);
        exit();
    }

    // Tanggal sekarang
    setlocale(LC_TIME, 'id_ID.utf8', 'Indonesian_indonesia.1252');
    $tanggalSekarang = strftime('%d %B %Y');

    // PDF
    $pdfFileName = "surat_pengambilan_". str_replace("/", "-", $noSurat) .".pdf";
    $pdfFilePath = $_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/upload/surat_pengambilan/" . $pdfFileName;
    $linkSurat = "/project_inventaris/upload/surat_pengambilan/" . $pdfFileName;

    $mpdf = new Mpdf();

    $html = '
    <style>
        body { font-family: "Times New Roman", Times, serif; font-size: 12pt; }
        .header { text-align: left; margin-bottom: 20px; }
        .content { text-align: justify; }
        .signature { margin-top: 50px; text-align: right; } /* ubah jadi right */
        .bold { font-weight: bold; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; } /* kurangi margin-top */
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
    </style>

    <div class="header">
        <p><span class="bold">Nomor</span> : ' . $noSurat . '</p>
        <p><span class="bold">Perihal</span> : Permohonan Pengambilan Barang</p>
        <p><span class="bold">Lampiran</span> : -</p>
    </div>

    <p>Kepada Yth.</p>
    <p class="content"> <b> PT. Lintas Internasional Berkarya </b><br>
    Direktur Utama</p>
    <br>
    <p class="content">Dengan hormat,</p>
    <p class="content">
    Sehubungan dengan adanya kebutuhan ' . $tujuan . ' melalui surat ini kami dari divisi ' . $namaStaf . ' mengajukan permohonan pengambilan barang yang dibutuhkan pada tanggal ' . $tanggalSekarang . ' dengan rincian sebagai berikut:
    </p>
    <table>
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>';

    foreach ($barangData as $barang) {
        $kode = $conn->real_escape_string($barang['kodeBarang']);
        $nama = $conn->real_escape_string($barang['namaSaja']);
        $jumlah = (int) $barang['jumlah'];

        // Tambah ke HTML
        $html .= "<tr>
                    <td>$kode</td>
                    <td>$nama</td>
                    <td>$jumlah</td>
                  </tr>";
    }

    $html .= '
        </tbody>
    </table>

    <p class="content" style="margin-top: 20px;">Demikian surat permohonan ini kami sampaikan. Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.</p>

    <div class="signature">
        <p>Balikpapan, ' . $tanggalSekarang . '</p>
        <p>Hormat kami,</p>
        <br>
        <p>' . $namaStaf . '</p>
    </div>';


    $mpdf->WriteHTML($html);
    $mpdf->Output($pdfFilePath, "F");

    // Simpan satu record utama di surat_pengambilan
    $insertSurat = "INSERT INTO surat_pengambilan (no_surat, ID_pengambilan, tanggal, tujuan, status, link_surat, id_staf)
                    VALUES ('$noSurat', '$idPengambilan', '$tanggalDiperlukan', '$tujuan', '$status', '$linkSurat', '$idStaf')";
    if ($conn->query($insertSurat) === TRUE) {

        // Simpan setiap detail barang ke tabel detail_pengambilan
        foreach ($barangData as $barang) {
            $kode = $conn->real_escape_string($barang['kodeBarang']);
            $nama = $conn->real_escape_string($barang['namaSaja']);
            $jumlah = (int) $barang['jumlah'];

            $conn->query("INSERT INTO detail_pengambilan (ID_pengambilan, ID_barang, nama_barang, jumlah)
                          VALUES ('$idPengambilan', '$kode', '$nama', '$jumlah')");
        }

        echo json_encode(["status" => "success", "message" => "Data berhasil disimpan", "link_surat" => $linkSurat]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menyimpan data surat: " . $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Metode tidak valid"]);
}
?>
