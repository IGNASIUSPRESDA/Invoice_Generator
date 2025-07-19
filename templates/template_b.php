<?php
$company = [
    'nama'   => 'PT Karya Mandiri Bangun Prima',
    'alamat' => 'Jl. Slamet Riyadi, Kota Surakarta',
    'telp'   => '+62 851 7899 5567',
];

$invoiceNumber = $dataGroup[0][0] ?? 'INV-XXXX';
$invoiceDate   = $dataGroup[0][1] ?? date('Y-m-d');
$totalAll = 0;
foreach ($dataGroup as $row) $totalAll += (int) $row[4];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #111;
            padding: 40px;
            font-size: 14px;
        }
        h1 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .company-name {
            font-weight: bold;
            margin-bottom: 20px;
        }
        hr.dotted {
            border: none;
            border-top: 2px dotted #111;
            margin: 20px 0;
        }
        .invoice-info {
            margin-bottom: 20px;
        }
        .invoice-info p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px 14px;
        }
        thead th {
            text-align: center;
        }
        tbody td:nth-child(1) {
            text-align: left;
        }
        tbody td:nth-child(2),
        tbody td:nth-child(3) {
            text-align: center;
        }
        .total-label {
            font-weight: bold;
            text-align: right;
            padding-top: 10px;
            font-size: 16px;
        }
        .total-value {
            font-weight: bold;
            font-size: 16px;
            text-align: right;
        }
        .footer {
            margin-top: 40px;
        }
        .footer p {
            margin: 5px 0;
        }
        .thankyou {
            margin-top: 30px;
            font-family: 'Brush Script MT', cursive;
            font-size: 28px;
        }
    </style>
</head>
<body>

<h1>INVOICE</h1>
<div class="company-name"><?= $company['nama'] ?></div>

<div class="invoice-info">
    <p><strong>Nomor Invoice:</strong> <?= $invoiceNumber ?></p>
    <p><strong>Tanggal:</strong> <?= date('d/m/Y', strtotime($invoiceDate)) ?></p>
</div>

<hr class="dotted">

<table>
    <thead>
        <tr>
            <th style="width: 60%;">Item</th>
            <th style="width: 20%;">Qty</th>
            <th style="width: 20%;">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataGroup as $row): ?>
        <tr>
            <td><?= $row[2] ?></td>
            <td><?= $row[3] ?></td>
            <td>Rp.<?= number_format($row[4], 0, ',', '.') ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<hr class="dotted">

<table>
    <tr>
        <td class="total-label" colspan="2">Total</td>
        <td class="total-value">Rp.<?= number_format($totalAll, 0, ',', '.') ?></td>
    </tr>
</table>

<div class="footer">
    <p><?= $company['alamat'] ?></p>
    <p><?= $company['telp'] ?></p>
</div>

<div class="thankyou">Thankyou</div>

</body>
</html>
