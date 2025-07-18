<?php
$company = [
    'nama'   => 'PT MEGABUILD SURYA ABADI',
    'alamat' => 'JL. RAYA TENGGILIS, KOTA SURABAYA',
    'email'  => 'megabuildsuryaabadi.co.id',
    'telp'   => '+62 81999884415',
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
            margin: 0;
            padding: 40px;
            background: #baf1f1;
            color: #000;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .logo {
            width: 120px;
        }
        .invoice-title {
            text-align: right;
        }
        .invoice-title h1 {
            font-size: 38px;
            font-weight: bold;
            background: linear-gradient(to right, #390078, #ed6ea0);
            color: white;
            padding: 10px 30px;
            border-radius: 25px;
        }
        .company-info {
            font-size: 14px;
            margin-top: 10px;
        }
        .company-info b {
            font-size: 16px;
        }
        .info-pair {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        .info-pair div {
            font-size: 14px;
            line-height: 1.6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            font-size: 14px;
        }
        th {
            background: #b2ab7d;
            color: black;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }
        td {
            padding: 10px;
            text-align: center;
        }
        tbody tr:nth-child(odd) {
            background: #dce1cf;
        }
        .total-box {
            margin-top: 20px;
            background: #b9b5b5;
            color: black;
            padding: 15px;
            width: 250px;
            text-align: right;
            font-weight: bold;
            font-size: 16px;
            float: right;
            border-radius: 6px;
        }
        .footer {
            clear: both;
            text-align: center;
            margin-top: 80px;
            font-size: 14px;
        }
        .footer div {
            margin: 5px 0;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="invoice-title">
        <h1>INVOICE</h1>
    </div>
</div>

<div class="company-info">
    <b><?= $company['nama'] ?></b><br>
    <?= $company['alamat'] ?>
</div>

<div class="info-pair">
    <div>
        <strong>Tanggal:</strong> <?= date('d/m/Y', strtotime($invoiceDate)) ?><br>
        <strong>No Invoice:</strong> <?= $invoiceNumber ?>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Description</th>
            <th>Qty.</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataGroup as $i => $row): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td style="text-align: left;"><?= strtolower($row[2]) ?></td>
            <td><?= $row[3] ?></td>
            <td style="text-align: right;">Rp.<?= number_format($row[4], 0, ',', '.') ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="total-box">
    Total &nbsp;&nbsp; Rp.<?= number_format($totalAll, 0, ',', '.') ?>
</div>

<div class="footer">
    <table align="center" style="font-size:14px;">
        <tr>
            <td style="padding: 5px 15px;"><strong>Email</strong></td>
            <td><?= $company['email'] ?></td>
        </tr>
        <tr>
            <td style="padding: 5px 15px;"><strong>Phone</strong></td>
            <td><?= $company['telp'] ?></td>
        </tr>
    </table>
</div>


</body>
</html>
