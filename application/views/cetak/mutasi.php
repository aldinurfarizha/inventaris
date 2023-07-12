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
  </style>
    <title>Cetak mutasi barang</title>
</head>
<body>
    <?php
    if($mutasi->of_id_penyerah==1){
                                      $asal=detailOfid($mutasi->of_id_penyerah)->nama.' '.detailSubOffice($mutasi->sub_id_penyerah)->nama;
                                    }else{
                                      $asal=detailOfid($mutasi->of_id_penyerah)->nama;
                                    }
                                    if($mutasi->of_id_penerima==1){
                                      $tujuan=detailOfid($mutasi->of_id_penerima)->nama.' '.detailSubOffice($mutasi->sub_id_penerima)->nama;
                                    }else{
                                      $tujuan=detailOfid($mutasi->of_id_penerima)->nama;
                                    }
    ?>
    <img style="width:250px;" src="<?=base_url(KOP_SURAT)?>" alt="">
    <center><u><b><h3>BERITA ACARA MUTASI BARANG</h3></b></u>
    <p style="margin-top: -20px;">NOMOR : <?=generateNomorMutasi($mutasi->id_mutasi)?></p>
    </center>
    <p>Pada hari ini <b><?=terbilangHari($mutasi->tanggal)?></b> tanggal <b><?=terbilangTanggal($mutasi->tanggal)?></b> bulan <b><?=terbilangBulan($mutasi->tanggal)?></b> tahun <b><?=terbilangTahun($mutasi->tanggal)?> <i>(<?=$mutasi->tanggal?>)</i></b>, Bawha telah di mutasikan Barang / Pengalihan Aset Inventaris Kantor dari <b><?=$asal?></b> ke <b><?=$tujuan?></b> berupa: </p>
    <?php 
    foreach($mutasi_inventaris as $barang):
        $detail_barang=get_detail_barang($barang->id_inventaris);
        if($detail_barang->kondisi_baik){
            $kondisi="Baik";
        }else{
            $kondisi="Rusak";
        }
        if($detail_barang->pernah_servis){
            $service="Service";
        }else{
            $service="Belum Pernah Service";
        }
        $barangs=$detail_barang->merk.' '.$detail_barang->tipe.' '.$detail_barang->spek;
        ?>
        <p class="item">-<?=terbilangAngka($barang->total).' ('.$barang->total.') '.$barang->satuan.' '.$barangs.' (<b>'.$kondisi.', '.$service.'</b>)';?></p>
    <?php endforeach;?>
    <p style="margin-top: 30px;">Demikian Berita Acara ini dibuat dan bisa dipergunakan sebagaimana mestinya.</p>
    <table style="width: 100%; margin-top:75px">
        <tr>
            <td style="width: 50%;"><center>Yang Menerima,</center></td>
            <td style="width: 50%;"><center>Yang Menyerahkan,</center></td>
        </tr>
        
        <tr>
            <td style="width: 50%;"><center><?=$mutasi->jabatan_penerima?></center></td>
            <td style="width: 50%;"><center><?=$mutasi->jabatan_penyerah?></center></td>
        </tr>
    </table>
    <table style="width: 100%; margin-top:75px;">
        <tr>
            <td style="width: 50%;"><center><b><u><?=$mutasi->nama_penerima?></u></b></center></td>
            <td style="width: 50%;"><center><b><u><?=$mutasi->nama_penyerah?></u></b></center></td>
        </tr>
        <tr>
            <td style="width: 50%;"><center>NIK. <?=$mutasi->nik_penerima?></center></td>
            <td style="width: 50%;"><center>NIK. <?=$mutasi->nik_penyerah?></center></td>
        </tr>
    </table>
    <table style="width: 100%; margin-top:30px;">
        <tr>
            <td><center>Mengetahui / Menyetujui</center></td>
        </tr>
        <tr>
            <td><center>KEPALA DIVISI UMUM,</center></td>
        </tr>
    </table>
     <table style="width: 100%; margin-top:75px;">
        <tr>
            <td><center><b><u><?=$mutasi->nama_kadiv_umum?></u></b></center></td>
            
        </tr>
        <tr>
            <td><center>NIK. <?=$mutasi->nik_kadiv_umum?></center></td>
        </tr>
    </table>
</body>
</html>
<script type="text/javascript">
window.print();
</script>
