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
            background: #baf1f1;
            margin: 0;
            padding: 40px;
            color: #000;
        }
        .wrapper {
            background: #baf1f1;
            padding: 30px;
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .left-box {
            background: #fdf7ed;
            padding: 20px 40px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .right-box {
            text-align: right;
            font-size: 14px;
            line-height: 1.8;
        }
        .invoice-to {
            font-size: 14px;
            margin-top: 30px;
        }
        .invoice-to b {
            font-size: 28px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            font-size: 14px;
        }
        th {
            background: #a0e7e5;
            padding: 12px;
            text-align: left;
        }
        td {
            padding: 12px;
        }
        tr:nth-child(even) {
            background: #d6fbfb;
        }
        .total-row {
            font-weight: bold;
            font-size: 16px;
        }
        .footer {
            margin-top: 40px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="invoice-header">
        <div class="left-box">
            INVOICE
        </div>
        <div class="right-box">
            <strong><?= $company['nama'] ?></strong><br>
            <?= $company['email'] ?><br><br>
            <strong>INVOICE DATE :</strong> <?= date('d/m/Y', strtotime($invoiceDate)) ?><br>
            <strong>INVOICE NO :</strong> <?= $invoiceNumber ?>
        </div>
    </div>

    <div class="invoice-to">
        <strong>INVOICE TO :</strong><br>
        <b>COSTUMER</b>
    </div>

    <table>
        <thead>
            <tr>
                <th>BARANG</th>
                <th>QTY</th>
                <th>HARGA</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataGroup as $row): ?>
            <tr>
                <td><?= strtoupper($row[2]) ?></td>
                <td><?= $row[3] ?></td>
                <td>Rp.<?= number_format($row[4], 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td colspan="2">TOTAL</td>
                <td>Rp.<?= number_format($totalAll, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <?= $company['alamat'] ?><br>
        <?= $company['telp'] ?>
    </div>
</div>

</body>
</html>
