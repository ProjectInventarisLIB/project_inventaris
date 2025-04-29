<?php
include($_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/config/konfigurasi.php");
require_once $_SERVER['DOCUMENT_ROOT'] .  "/project_inventaris/library/fpdf.php";
require_once $_SERVER['DOCUMENT_ROOT'] .  "/project_inventaris/vendor/autoload.php";
use setasign\Fpdi\Fpdi;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_surat = $_POST['no_surat'];
    $status = $_POST['status'];

    // Update status surat
    $query = "UPDATE surat_pengambilan SET status = ? WHERE no_surat = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $status, $no_surat);

    if ($stmt->execute()) {
        echo "Status untuk No. Surat " . $no_surat;

        $pdfFile = $_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/upload/surat_pengambilan/surat_pengambilan_" . str_replace("/", "-", $no_surat) . ".pdf";
        $ttdPath = $_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/assets/approved_stempel.png"; 

        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($pdfFile);
        $templateId = $pdf->importPage(1);
        $pdf->addPage();
        $pdf->useTemplate($templateId);
        
        // Menambahkan TTD di PDF
        $imageWidth = 90;
        $pageWidth = $pdf->GetPageWidth();
        $centerX = ($pageWidth - $imageWidth) / 2;

        $pdf->Image($ttdPath, $centerX, 240, $imageWidth);


        $updatedPdfPath = $_SERVER['DOCUMENT_ROOT'] . "/project_inventaris/upload/surat_pengambilan/surat_pengambilan_" . str_replace("/", "-", $no_surat) . ".pdf";
        $pdf->Output($updatedPdfPath, 'F');

        echo " berhasil disetujui";
    } else {
        echo "Gagal memperbarui status.";
    }

    $stmt->close();
    $conn->close();
}
?>
