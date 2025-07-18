<?php
$company = [
    'nama'   => 'UD. Mitra Canggih C',
    'alamat' => 'Jl. Kenanga No. 5, Surabaya',
    'email'  => 'info@perusahaan-c.com',
    'telp'   => '031-9876543',
    'logo'   => 'assets/logos/logo_c.png'
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
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            color: #333;
            padding: 40px;
        }
        .header-title {
            font-size: 48px;
            font-weight: bold;
            color: #e74c3c;
            margin-bottom: 10px;
        }
        .company-info {
            float: left;
            line-height: 1.6;
        }
        .invoice-info {
            float: right;
            text-align: right;
            line-height: 1.6;
        }
        .logo {
            width: 100px;
            margin-top: 10px;
        }
        .clear {
            clear: both;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 40px;
            font-size: 14px;
        }
        th {
            background-color: #f0dbb2;
            padding: 10px;
            text-align: left;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #fcfcfc;
        }
        .total-row td {
            background-color: #e74c3c;
            color: #fff;
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
            font-size: 14px;
        }
        .thankyou {
            font-size: 24px;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="header-title">INVOICE</div>

    <div class="company-info">
        <strong><?= $company['nama'] ?></strong><br>
        <?= $company['alamat'] ?><br>
        <?= $company['email'] ?><br>
        <?= $company['telp'] ?>
    </div>

    <div class="invoice-info">
        <strong>Invoice#</strong> <?= $invoiceNumber ?><br>
        <strong>Tanggal</strong> <?= date('d F Y', strtotime($invoiceDate)) ?><br>
    </div>

    <div class="clear"></div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Item Deskripsi</th>
                <th>Qty</th>
                <th>Harga (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataGroup as $i => $row): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $row[2] ?></td>
                <td><?= $row[3] ?></td>
                <td><?= number_format($row[4], 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td colspan="3">TOTAL</td>
                <td><?= number_format($totalAll, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <?= $company['alamat'] ?><br>
        <?= $company['telp'] ?>
        <div class="thankyou">Thank You</div>
    </div>

</body>
</html>
