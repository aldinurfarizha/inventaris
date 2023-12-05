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
    </style>
    <title>Cetak berita Acara</title>
</head>

<body>
    <img style="width:175px;" src="<?= base_url(KOP_SURAT) ?>" alt="">
    <center><b>
            <h3><u>BERITA ACARA PENGHAPUSAN ASET</u></h3>
        </b>
        <p style="margin-top: -20px;">NOMOR : <?= generateNomorPenghapusan($penghapusan->id_penghapusan) ?></p>
    </center>
    <p>Pada hari ini <b><?= terbilangHari($penghapusan->tanggal) ?></b> tanggal <b><?= terbilangTanggal($penghapusan->tanggal) ?></b> bulan <b><?= terbilangBulan($penghapusan->tanggal) ?></b> tahun <b><?= terbilangTahun($penghapusan->tanggal) ?> <i>(<?= $penghapusan->tanggal ?>)</i></b>, kami melakukan penghapusan ASET dengan alasan <b><?= $penghapusan->alasan ?></b>.</p>
    <p>Dengan perincian barang inventaris sebagai berikut :</p>
    <?php
    foreach ($penghapusan_inventaris as $barang) :
        $detail_barang = get_detail_barang($barang->id_inventaris);
        $barangs = $detail_barang->merk . ' ' . $detail_barang->tipe . ' ' . $detail_barang->spek . ' (' . $barang->kondisi_terakhir . ')';
    ?>
        <p class="item"><b>-<?= terbilangAngka($barang->total) . ' (' . $barang->total . ') ' . $barang->satuan . ' ' . $barangs ?> </b></p>
    <?php endforeach; ?>


    <table style="width: 100%; margin-top:50px">
        <tr>
            <td style="width: 50%;">
                <center><b>KEPALA SUB DIVISI ASET</b></center>
            </td>
            <td style="width: 50%;">
                <center><b>KEPALA DIVISI UMUM</b></center>
            </td>
        </tr>
    </table>
    <table style="width: 100%; margin-top:65px;">
        <tr>
            <td style="width: 50%;">
                <center><u><b><?= $penghapusan->nama_kasub_aset ?></b></u></center>
            </td>
            <td style="width: 50%;">
                <center><u><b><?= $penghapusan->nama_kadiv_umum ?></b></u></center>
            </td>
        </tr>
        <tr>
            <td style="width: 50%;">
                <center>NIK. <?= $penghapusan->nik_kasub_aset ?></center>
            </td>
            <td style="width: 50%;">
                <center>NIK. <?= $penghapusan->nik_kadiv_umum ?></center>
            </td>
        </tr>
    </table>
    <table style="width: 100%; margin-top:50px">
        <tr>
            <td style="width: 50%;">
                <center><b>KEPALA DIVISI SPI</b></center>
            </td>
            <td style="width: 50%;">
                <center><b>PLT DIREKTUR PAM TIRTA KAMUNING</b></center>
            </td>
        </tr>
    </table>
    <table style="width: 100%; margin-top:65px;">
        <tr>
            <td style="width: 50%;">
                <center><u><b><?= $penghapusan->nama_kadiv_spi ?></b></u></center>
            </td>
            <td style="width: 50%;">
                <center><u><b><?= $penghapusan->nama_direktur ?></b></u></center>
            </td>
        </tr>
        <tr>
            <td style="width: 50%;">
                <center>NIK. <?= $penghapusan->nik_kadiv_spi ?></center>
            </td>
            <td style="width: 50%;">
                <center>NIK. <?= $penghapusan->nik_direktur ?></center>
            </td>
        </tr>
    </table>
    <p class="right footer" style="margin-top:50px;">Jl. RE Martadinata No. 527 KUNINGAN - JAWA BARAT 45514</p>
    <p class="right footer" style="margin-top:-10px;">Telp. 0232-871190 (hunting) Fax : 0232-873927 SMS Pengaduan 085295850666</p>
    <p class="right footer" style="margin-top:-10px;">Email : pamkuningan@gmail.com & pamkuningan.co.id</p>
</body>

</html>
<script type="text/javascript">
    window.print();
</script>