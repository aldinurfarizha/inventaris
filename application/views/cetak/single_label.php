<html lang="en" class="html">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            margin-bottom: 5px;

        }
    </style>
    <title>Nyetak</title>
</head>

<body>
    <?php
    $inventaris = get_detail_barang($id);
    $barang = $inventaris->nama_perkiraan . ' ' . $inventaris->merk . ' ' . $inventaris->spek;
    ?>
    <table style="margin-top: 10px;">
        <tbody>
            <tr>
                <td colspan="3">
                    <center>SIMBA (Sistem Inventaris Barang)</center>
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                        <img style="width:100px;" src="<?= base_url(QR_LOAD_PATH) . $inventaris->id_inventaris . '.png' ?>" alt="">
                        <br>
                    </center>
                </td>
                <td>
                    <center>
                        <h3><?= $inventaris->kd_perkiraan ?></h3>
                        <h3 style="margin-bottom:0;"><?= $inventaris->y . '-' . $inventaris->m . '-' . $inventaris->d ?></h3>
                        <p style="font-size: 6pt;"><?= limitText($barang) ?></p>
                    </center>
                </td>
                <td><img style="width:100px;" src="<?= base_url(LOGO_PAM) ?>" alt=""></td>
            </tr>
    </table>
</body>

</html>
<script type="text/javascript">
    window.print();
</script>