<html lang="en" class="html">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: "Bookman Old Style", serif;
        }

        p {
            font-size: 9.5pt;
        }

        .item {
            margin-bottom: -15px;
            margin-left: 50px;
        }

        .justify {
            text-align: justify;
        }

        .right {
            text-align: right;
        }

        .footer {
            color: darkgray;
            font-size: 7pt;
        }

        .border {
            border: 1px solid black;
            border-radius: 10px;
        }
    </style>
    <title>Laporan barang</title>
</head>

<body>
    <img style="width:150px;" src="<?= base_url(KOP_SURAT) ?>" alt="">
    <center>
        <h3>Laporan Barang</h3>
    </center>
    <p class="right">Tanggal Cetak: <?= date('Y-m-d') ?></p>
    <table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
        <thead>
            <tr>
                <td class="border">
                    <center><b>No.</b></center>
                </td>
                <td class="border">
                    <center><b>Nama Barang</b></center>
                </td>
                <td class="border">
                    <center><b>MERK/TYPE</b></center>
                </td>
                <td class="border">
                    <center><b>Vol</b></center>
                </td>
                <td class="border">
                    <center><b>Satuan</b></center>
                </td>
                <td class="border">
                    <center><b>Perolehan</b></center>
                </td>
                <td class="border">
                    <center><b>Kondisi Barang</b></center>
                </td>
                <td class="border">
                    <center><b>Lokasi</b></center>
                </td>
                <td class="border">
                    <center><b>Keterangan</b></center>
                </td>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($data as $barang) :
                $kondisi = generateKondisiBarang($barang->kondisi_baik);
                if ($barang->pernah_servis) {
                    $service = "servis";
                } else {
                    $service = "Blm Pernah servis";
                }
                $kondisi_terakhir = $kondisi . ', ' . $service;
            ?>
                <tr>
                    <td class="border"><?= $no ?></td>
                    <td class="border"><?= $barang->nama_perkiraan ?></td>
                    <td class="border"><?= $barang->merk . ' ' . $barang->tipe . ' ' . $barang->spek; ?></td>
                    <td class="border">1</td>
                    <td class="border"><?= $barang->satuan ?></td>
                    <td class="border"><?= $barang->y . '-' . $barang->m . '-' . $barang->d ?></td>
                    <td class="border"><?= $kondisi_terakhir ?></td>
                    <td class="border"><?= $barang->nama_kantor . ' ' . $barang->nama_sub_kantor . ' ' . '(' . $barang->nama_ruangan . ')' ?></td>
                    <td class="border"><?= $barang->keterangan ?></td>
                </tr>
            <?php $no++;
            endforeach; ?>
        </tbody>
    </table>

</body>

</html>
<script type="text/javascript">
    window.print();
</script>