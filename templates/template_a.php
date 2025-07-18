<?php
$company = [
    'nama'   => 'PT Novalink Tekno Mandiri',
    'alamat' => 'JL. HR MUHAMMAD, SURABAYA',
    'telp'   => '+6213155567788',
];

$invoiceNumber = $dataGroup[0][0] ?? 'XXX';
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
            font-size: 14px;
            color: #111;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 40px;
        }

        .header {
            background: #deb2aa;
            padding: 40px;
            position: relative;
        }

        .header::after {
            content: '';
            position: absolute;
            top: 0; right: 0;
            border-left: 150px solid transparent;
            border-bottom: 150px solid white;
            width: 0;
            height: 0;
        }

        .header h1 {
            font-size: 40px;
            font-weight: bold;
            margin: 0;
        }

        .invoice-info, .company-info {
            position: relative;
            z-index: 2;
        }

        .invoice-info p, .company-info p {
            margin: 5px 0;
            font-weight: bold;
        }

        .table-section {
            background: #deb2aa;
            padding: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid #000;
        }

        th {
            background-color: #deb2aa;
            text-align: center;
        }

        td:nth-child(2),
        td:nth-child(3),
        td:nth-child(4) {
            text-align: center;
        }

        .footer {
            position: relative;
            background: white;
            padding: 40px;
        }

        .footer::before {
            content: '';
            position: absolute;
            bottom: 0; left: 0;
            border-right: 150px solid transparent;
            border-top: 150px solid #deb2aa;
            width: 0;
            height: 0;
            z-index: 1;
        }

        .footer .info, .footer .total, .footer .thankyou {
            position: relative;
            z-index: 2;
        }

        .footer .info p {
            font-weight: bold;
            margin: 0 0 5px;
        }

        .total {
            margin-top: 20px;
            text-align: right;
        }

        .total-label {
            font-weight: bold;
            font-size: 16px;
        }

        .total-value {
            font-weight: bold;
            font-size: 16px;
            margin-left: 20px;
        }

        .thankyou {
            font-family: 'Brush Script MT', cursive;
            font-size: 32px;
            text-align: right;
            margin-top: 40px;
        }

    </style>
</head>
<body>

    <div class="header">
        <div class="invoice-info">
            <h1>INVOICE</h1>
            <p>Tanggal Invoice<br><?= date('j F, Y', strtotime($invoiceDate)) ?></p>
            <p>No Invoice<br><?= $invoiceNumber ?></p>
        </div>
        <div class="company-info" style="position:absolute; top:40px; right:60px;">
            <p><?= $company['nama'] ?></p>
        </div>
    </div>

    <div class="table-section">
        <table>
            <thead>
                <tr>
                    <th>ITEM</th>
                    <th>QTY</th>
                    <th>PRICE</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataGroup as $row): ?>
                <tr>
                    <td><?= $row[2] ?></td>
                    <td><?= $row[3] ?></td>
                    <td>Rp.<?= number_format($row[4], 0, ',', '.') ?></td>
                    <td>Rp.<?= number_format($row[4], 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <div class="info">
            <p><?= $company['alamat'] ?></p>
            <p><?= $company['telp'] ?></p>
        </div>

        <div class="total">
            <span class="total-label">TOTAL</span>
            <span class="total-value">Rp.<?= number_format($totalAll, 0, ',', '.') ?></span>
        </div>

        <div class="thankyou">Thank you</div>
    </div>

</body>
</html>
