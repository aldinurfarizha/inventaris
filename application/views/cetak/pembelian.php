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
            margin: 0;
            padding: 0;
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
    <title>Cetak Kartu Inventaris</title>
</head>

<body>
    <table width="100%">
        <tr>
            <td width="25%" style="height: 50px;">
                <img style=" width:150px;" src="<?= base_url(KOP_SURAT) ?>" alt="">
            </td>
            <td width="75%" style="height: 50px; vertical-align: bottom;">
                <h4>PEMBELIAN BARANG INVENTARIS KANTOR PAM BULAN <?= strtoupper(bulan($pembelian->m)) . ' ' . $pembelian->y ?></h4>
            </td>
        </tr>
    </table>
    <table style="width: 100%; border: 1px solid black; border-collapse: collapse; margin-top:50px;">
        <thead>
            <tr>
                <td class="border" rowspan="2">
                    <center><b>
                            <p>No.</p>
                        </b></center>
                </td>
                <td class="border" rowspan="2">
                    <center><b>
                            <p>TANGGAL</p>
                        </b></center>
                </td>
                <td class="border" rowspan="2">
                    <center><b>
                            <p>NAMA BARANG</p>
                        </b></center>
                </td>
                <td class="border" rowspan="2">
                    <center><b>
                            <p>KODE PEMB/BAG</p>
                        </b></center>
                </td>
                <td class="border" rowspan="2">
                    <center><b>
                            <p>JML</p>
                        </b></center>
                </td>
                <td class="border" rowspan="2">
                    <center><b>
                            <p>SATUAN</p>
                        </b></center>
                </td>
                <td class="border" colspan="2">
                    <center><b>
                            <p>HARGA</p>
                        </b></center>
                </td>
                <td class="border" rowspan="2">
                    <center><b>
                            <p>MERK/TIPE</p>
                        </b></center>
                </td>
                <td class="border" rowspan="2">
                    <center><b>
                            <p>KETERANGAN</p>
                        </b></center>
                </td>
            </tr>
            <tr>
                <td class="border">
                    <center><b>
                            <p>SATUAN (Rp.)</p>
                        </b></center>
                </td>
                <td class="border">
                    <center><b>
                            <p>TOTAL (Rp.)</p>
                        </b></center>
                </td>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $grandTotal = 0;
            foreach ($pembelian_inventaris as $barang) :
                $total = $barang->harga * $barang->jumlah;
                $grandTotal += $total;
            ?>
                <tr>
                    <td class="border">
                        <p><?= $no ?></p>
                    </td>
                    <td class="border">
                        <p><?= $barang->d . '-' . $barang->m . '-' . $barang->y ?></p>
                    </td>
                    <td class="border">
                        <p><?= $barang->barang ?></p>
                    </td>
                    <td class="border"></td>
                    <td class="border">
                        <center>
                            <p><?= $barang->jumlah ?></p>
                        </center>
                    </td>
                    <td class="border">
                        <center>
                            <p><?= $barang->satuan ?></p>
                        </center>
                    </td>
                    <td class="border" style="text-align: right;">
                        <p><?= number_format($barang->harga, 0, ',', '.') ?></p>
                    </td>
                    <td class="border" style="text-align: right;">
                        <p><?= number_format($total, 0, ',', '.') ?></p>
                    </td>
                    <td class="border">
                        <p><?= $barang->merk . ' ' . $barang->tipe ?></p>
                    </td>
                    <td class="border">
                        <p><?= $barang->keterangan ?></p>
                    </td>
                </tr>
            <?php $no++;
            endforeach; ?>
            <tr>
                <td colspan="6">
                    <center><b>
                            <p>JUMLAH</p>
                        </b></center>
                </td>
                <td class="border" colspan="2" style="text-align: right;"><b>
                        <p>Rp. <?= number_format($grandTotal, 0, ',', '.') ?></p>
                    </b></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <p class="right">Kuningan, <?php
                                $bulan = $pembelian->m;
                                $tahun = $pembelian->y;
                                if ($bulan == 12) {
                                    $bulan = 1;
                                    $tahun++;
                                } else {
                                    $bulan++;
                                }
                                echo bulan($bulan) . ' ' . $tahun;
                                ?></p>
    <table style="width: 100%; margin-top:75px">
        <tr>
            <td style="width: 33%;">
                <center>Mengetahui :</center>
            </td>
            <td style="width: 33%;">
                <center>Diperiksa Oleh :</center>
            </td>
            <td style="width: 33%;">
                <center>Dibuat Oleh :</center>
            </td>
        </tr>
        <tr>
            <td style="width: 33%;">
                <center>Kepala Divisi Umum</center>
            </td>
            <td style="width: 33%;">
                <center>Kasubdiv. Logistik dan Aset</center>
            </td>
            <td style="width: 33%;">
                <center>Pelaksana Subdiv.Logistik & Asset</center>
            </td>
        </tr>
    </table>
    <table style="width: 100%; margin-top:75px;">
        <tr>
            <td style="width: 33%;">
                <center><b><u><?= $pembelian->nama_kadiv_umum ?></u></b></center>
            </td>
            <td style="width: 33%;">
                <center><b><u><?= $pembelian->nama_kasubdiv_logistik ?></u></b></center>
            </td>
            <td style="width: 33%;">
                <center><b><u><?= $pembelian->nama_pelaksana_subdiv_logistik ?></u></b></center>
            </td>
        </tr>
        <tr>
            <td style="width: 33%;">
                <center>NIK. <?= $pembelian->nik_kadiv_umum ?></center>
            </td>
            <td style="width: 33%;">
                <center>NIK. <?= $pembelian->nik_kasubdiv_logistik ?></center>
            </td>
            <td style="width: 33%;">
                <center>NIK. <?= $pembelian->nik_pelaksana_subdiv_logistik ?></center>
            </td>
        </tr>
    </table>
</body>

</html>
<script type="text/javascript">
    window.print();
</script>