<html lang="en" class="html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body {
      font-family: "Bookman Old Style", serif;
    }
    p{
        font-size: 9.5pt;
    }
    .item{
        margin-bottom: -15px; 
        margin-left:50px;
    }
    .justify { text-align: justify;}
    .right   { text-align: right;}
    .footer{
        color:darkgray;
        font-size: 7pt;
    }
    .border{
        border: 1px solid black;
        border-radius: 10px;
    }
  </style>
    <title>Cetak Kartu Inventaris</title>
</head>
<body>
    <img style="width:250px;" src="<?=base_url(KOP_SURAT)?>" alt="">
    <center><u><b><h3>KARTU INVENTARIS RUANGAN <br>(KIR)</h3></b></u></center>
    <h4 class="right"><b><?=getNamaRuanganKir($kartu_inventaris->id_ruangan_kir)->nama_ruangan?></b></h4>
    <p style="margin-top: -25px;" class="right"><?=detailOfid($kartu_inventaris->of_id)->nama.' '.@detailSubOffice($kartu_inventaris->sub_id)->nama?></p>
    
    <table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
    <thead>
        <tr>
            <td class="border"><center><b>No.</b></center></td>
            <td class="border"><center><b>Nama Barang</b></center></td>
            <td class="border"><center><b>MERK/TYPE</b></center></td>
            <td class="border"><center><b>Vol</b></center></td>
            <td class="border"><center><b>Satuan</b></center></td>
            <td class="border"><center><b>Tahun Perolehan</b></center></td>
            <td class="border"><center><b>Kondisi Barang</b></center></td>
            <td class="border"><center><b>Keterangan</b></center></td>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($kartu_inventaris_barang as $barang):
         $kondisi_terakhir='';
                                  if($barang->kondisi_baik==1){
                                    $kondisi="Baik";
                                  }else{
                                    $kondisi="Rusak";
                                  }
                                  if($barang->pernah_servis==1){
                                    $servis="Pernah Servis";
                                  }else{
                                    $servis='Blm Pernah Servis';
                                  }
                                  $kondisi_terakhir=$kondisi.', '.$servis;
            ?>
            <tr>
                <td class="border"><?=$no?></td>
                <td class="border"><?=$barang->nama_perkiraan?></td>
                <td class="border"><?=$barang->barang;?></td>
                <td class="border">1</td>
                <td class="border"><?=$barang->satuan?></td>
                <td class="border"><?=$barang->y?></td>
                <td class="border"><?=$kondisi_terakhir?></td>
                <td class="border"></td>
            </tr>
        <?php endforeach;?>
    </tbody>
    </table>
    <p class="right">Kuningan, <?php
    $time = strtotime($kartu_inventaris->tanggal);
    $tahun = date('Y',$time);
    $bulan_raw = date('m',$time);
    $bulan=bulan($bulan_raw);
    $tanggal = date('d',$time);
    echo $tanggal.' '.$bulan.' '.$tahun;
    ?></p>
    <table style="width: 100%; margin-top:75px">
        <tr>
            <td style="width: 33%;"><center>Mengetahui,</center></td>
            <td style="width: 33%;"><center>Diketahui,</center></td>
            <td style="width: 33%;"><center>Penanggung Jawab Ruangan,</center></td>
        </tr>
        <tr>
            <td style="width: 33%;"><center>Kepala Divisi Umum</center></td>
            <td style="width: 33%;"><center>Kasubdiv. Logistik dan Aset</center></td>
            <td style="width: 33%;"><center><?=$kartu_inventaris->jabatan_penanggung_jawab?></center></td>
        </tr>
    </table>
    <table style="width: 100%; margin-top:75px;">
        <tr>
            <td style="width: 33%;"><center><b><u><?=$kartu_inventaris->nama_kadiv_umum?></u></b></center></td>
            <td style="width: 33%;"><center><b><u><?=$kartu_inventaris->nama_kasub_aset?></u></b></center></td>
            <td style="width: 33%;"><center><b><u><?=$kartu_inventaris->nama_penanggung_jawab?></u></b></center></td>
        </tr>
        <tr>
            <td style="width: 33%;"><center>NIK. <?=$kartu_inventaris->nik_kadiv_umum?></center></td>
            <td style="width: 33%;"><center>NIK. <?=$kartu_inventaris->nik_kasub_aset?></center></td>
            <td style="width: 33%;"><center>NIK. <?=$kartu_inventaris->nik_penanggung_jawab?></center></td>
        </tr>
    </table>
    <table style="width: 100%; margin-top:30px;">
        <tr>
            <td><center>Mengetahui / Menyetujui</center></td>
        </tr>
        <tr>
            <td><center>PLT. Direktur PAM Tirta Kamuning</center></td>
        </tr>
    </table>
     <table style="width: 100%; margin-top:75px;">
        <tr>
            <td><center><b><u><?=$kartu_inventaris->nama_direktur?></u></b></center></td>
            
        </tr>
        <tr>
            <td><center>NIP. <?=$kartu_inventaris->nik_direktur?></center></td>
        </tr>
    </table>
</body>
</html>
<script type="text/javascript">
    window.print();
</script>
