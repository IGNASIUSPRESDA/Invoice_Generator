<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use Dompdf\Dompdf;
use Dompdf\Options;

if (isset($_POST['submit'])) {
    $templateChoice = $_POST['template']; // 'a', 'b', 'c', 'd', atau 'e'
    $uploadDir = 'uploads/';
    $invoiceDir = 'invoices/';

    // Buat folder jika belum ada
    if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);
    if (!file_exists($invoiceDir)) mkdir($invoiceDir, 0777, true);

    // Simpan file Excel yang diupload
    $excelFile = $_FILES['excel_file'];
    $filename = time() . '_' . basename($excelFile['name']);
    $targetPath = $uploadDir . $filename;

    if (move_uploaded_file($excelFile['tmp_name'], $targetPath)) {
        try {
            $spreadsheet = IOFactory::load($targetPath);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            // Buang baris header jika kolom pertama adalah "nomor invoice"
            if (strtolower(trim($rows[0][0])) === 'nomor invoice') {
                array_shift($rows);
            }

            $chunks = array_chunk($rows, 7); // Maksimal 7 baris per invoice
            $counter = 1;

            foreach ($chunks as $dataGroup) {
                // Ambil template HTML
                ob_start();
                include __DIR__ . "/templates/template_$templateChoice.php";
                $html = ob_get_clean();

                // Konfigurasi Dompdf
                $options = new Options();
                $options->set('isRemoteEnabled', true);
                $options->set('isHtml5ParserEnabled', true);
                $options->set('isPhpEnabled', true);
                $options->set('chroot', __DIR__);
                $dompdf = new Dompdf($options);

                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();

                // Simpan PDF
                $pdfFilename = $invoiceDir . 'invoice_' . date('Ymd') . '_' . $counter . '.pdf';
                file_put_contents($pdfFilename, $dompdf->output());

                $counter++;
            }

            // Redirect ke halaman utama
            header("Location: index.php");
            exit();

        } catch (Exception $e) {
            echo "<h3>❌ Terjadi kesalahan saat memproses file:</h3>";
            echo "<pre>" . $e->getMessage() . "</pre>";
            exit;
        }

    } else {
        echo "<h3>❌ Gagal mengunggah file.</h3>";
        echo "<pre>";
        print_r($_FILES);
        echo "</pre>";
        echo "<p>Pastikan folder <code>uploads/</code> bisa ditulis dan file Excel valid.</p>";
        exit;
    }
} else {
    echo "Akses tidak valid.";
}
