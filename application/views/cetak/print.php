<html lang="en" class="html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
     table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  margin-bottom: 5px;
  
}
    </style>
    <title>Nyetak</title>
</head>
<body>
    
    <?php foreach($data as $datar):
        $barang=get_detail_barang($datar);?>
        <table>
        <tbody>
         <tr>
            <td colspan="3"><center>SIMBA (Sistem Inventaris Barang)</center></td>
        </tr>
         <tr>
        <td><img style="width:100px;" src="<?=base_url(LOGO_PAM)?>" alt=""></td>
        <td>
            <center>
            <h3><?=$barang->kd_barang?></h3>
            <h3 style="margin-bottom:0;"><?=$barang->y.'-'.$barang->m.'-'.$barang->d?></h3>
            <p style="font-size: 9px;"><?=$barang->nama_barang?></p>
            </center>
        </td>
        <td>
            <center>
                <img style="width:100px;" src="<?=base_url(QR_LOAD_PATH).$barang->id_barang.'.png'?>" alt="">
            <br>
            <small>ID:<?=$barang->id_barang?></small>
            </center>
        </td>
         </tr>
          </table>
    <?php endforeach;
        ?>
</body>
</html>