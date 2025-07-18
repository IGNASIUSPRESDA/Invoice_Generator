<?php
// Cek jika ada file PDF di folder invoices
$pdfFiles = glob("invoices/*.pdf");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Generator</title>
    <link rel="stylesheet" href="assets/css/style.css"> <!-- opsional -->
    <style>
        body { font-family: Arial, sans-serif; padding: 30px; background: #f7f7f7; }
        .container { max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; }
        label { font-weight: bold; display: block; margin-top: 20px; }
        input[type="file"], select, button {
            width: 100%; padding: 10px; margin-top: 10px; border-radius: 4px; border: 1px solid #ccc;
        }
        .pdf-list { margin-top: 40px; }
        .pdf-item { background: #f0f0f0; padding: 10px; margin-bottom: 10px; border-radius: 4px; display: flex; justify-content: space-between; align-items: center; }
        .download-btn {
            background: #007BFF; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Invoice Generator dari Excel</h2>
        <form action="process.php" method="POST" enctype="multipart/form-data">
            <label for="excel">Upload File Excel (.xlsx atau .xls)</label>
            <input type="file" name="excel_file" id="excel" accept=".xlsx,.xls" required>

            <label for="template">Pilih Template Perusahaan</label>
            <select name="template" id="template" required>
                <option value="">-- Pilih Template --</option>
                <option value="a">Template A (Perusahaan A)</option>
                <option value="b">Template B (Perusahaan B)</option>
                <option value="c">Template C (Perusahaan C)</option>
                <option value="d">Template D (Perusahaan D)</option>
                <option value="e">Template E (Perusahaan E)</option>
            </select>

            <button type="submit" name="submit">Proses Invoice</button>
        </form>

        <?php if (!empty($pdfFiles)): ?>
        <div class="pdf-list">
            <h3>Hasil Invoice PDF:</h3>
            <?php foreach ($pdfFiles as $file): ?>
                <div class="pdf-item">
                    <span><?= basename($file); ?></span>
                    <a href="<?= $file; ?>" class="download-btn" download>Download</a>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
