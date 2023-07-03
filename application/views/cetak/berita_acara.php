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
    <title>Cetak berita Acara</title>
</head>
<body>
    <img style="width:175px;" src="<?=base_url(KOP_SURAT)?>" alt="">
    <center><b><h3>BERITA ACARA SERAH TERIMA BARANG INVENTARIS</h3></b>
    <p style="margin-top: -20px;">NOMOR : <?=generateNomorBA($berita_acara->id)?></p>
    </center>
    <p>Pada hari ini <b><?=terbilangHari($berita_acara->tanggal)?></b> tanggal <b><?=terbilangTanggal($berita_acara->tanggal)?></b> bulan <b><?=terbilangBulan($berita_acara->tanggal)?></b> tahun <b><?=terbilangTahun($berita_acara->tanggal)?> <i>(<?=$berita_acara->tanggal?>)</i></b>, kami yang bertanda tangan dibawah ini : </p>
    <center>
    <table>
        <tr>
            <td>1.</td>
            <td>Nama</td>
            <td>: <?=$berita_acara->sub_div_rt_nama?></td>
        </tr>
        <tr>
            <td></td>
            <td>JABATAN</td>
            <td>: Pejabat Rumah Tangga</td>
        </tr>
         <tr>
            <td></td>
            <td>NIK</td>
            <td>: <?=$berita_acara->sub_div_rt_nik?></td>
        </tr>
    </table>
    </center>
    <p>untuk selanjutnya disebut : --------------- PIHAK PERTAMA ------------</p>
     <center>
    <table>
        <tr>
            <td>2.</td>
            <td>Nama</td>
            <td>: <?=$berita_acara->pihak_kedua_nama?></td>
        </tr>
        <tr>
            <td></td>
            <td>JABATAN</td>
            <td>: <?=generateJabatan($berita_acara->of_id, $berita_acara->sub_office)?></td>
        </tr>
         <tr>
            <td></td>
            <td>NIK</td>
            <td>: <?=$berita_acara->pihak_kedua_nik?></td>
        </tr>
    </table>
    </center>
    <p>untuk selanjutnya disebut : --------------- PIHAK KEDUA ------------</p>
    <p>dengan ini PIHAK PERTAMA menyerahkan fasilitas barang inventaris perusahaan  kepada PIHAK KEDUA, dengan perencian sebagai berikut :</p>
    <?php 
    foreach($berita_acara_barang as $barang):
        $detail_barang=get_detail_barang($barang->id_barang);
        ?>
        <p class="item"><b>-	Satu (1) <?=@$detail_barang->satuan?> <?=@$detail_barang->nama_barang?> <?=@$detail_barang->merk?> <?=@$detail_barang->spek?></b></p>
    <?php endforeach;?>
    

    <p style="margin-top: 30px;">Untuk selanjutnya PIHAK KEDUA selaku pemegang inventaris berkewajiban untuk mematuhi hal-hal sebagai berikut :</p>
    <p class="item justify">1.	PIHAK KEDUA harus menjaga dan merawat barang inventaris ;</p>
    <p class="item justify">2.	Mempergunakan inventaris tersebut untuk keperluan / kepentingan perusahaan dan dilarang menggunakan inventaris tersebut untuk kepentingan pribadi ;</p>
    <p class="item justify">3.	Jika terjadi kehilangan atau kerusakan yang sengaja maupun tidak sengaja terhadap barang inventaris tersebut, maka PIHAK KEDUA wajib mengganti barang inventaris tersebut ;</p>
    <p class="item justify">4.	PIHAK KEDUA dilarang menambah, mengurangi atau memodifikasi barang inventaris tanpa seijin PIHAK PERTAMA ;</p>
    <p class="item justify">5.	PIHAK KEDUA wajib mengembalikan barang inventaris yang dipinjam, kepada PIHAK PERTAMA apabila PIHAK PERTAMA meminta mengembalikan inventaris tersebut untuk kepentingan perusahaan. </p>
    <p style="margin-top: 30px;">Demikian Berita Acara ini kami buat untuk dapat dipergunakan seperlunya.</p>
    <table style="width: 100%;">
        <tr>
            <td style="width: 50%;"><center><b>PIHAK KEDUA</b></center></td>
            <td style="width: 50%;"><center><b>PIHAK PERTAMA</b></center></td>
        </tr>
        
        <tr>
            <td style="width: 50%;"><center>Yang Menerima</center></td>
            <td style="width: 50%;"><center>Yang Menyerahkan</center></td>
        </tr>
    </table>
    <table style="width: 100%; margin-top:65px;">
        <tr>
            <td style="width: 50%;"><center><b><?=$berita_acara->pihak_kedua_nama?></b></center></td>
            <td style="width: 50%;"><center><b><?=$berita_acara->sub_div_rt_nama?></b></center></td>
        </tr>
        <tr>
            <td style="width: 50%;"><center>NIK. <?=$berita_acara->pihak_kedua_nik?></center></td>
            <td style="width: 50%;"><center>NIK. <?=$berita_acara->sub_div_rt_nik?></center></td>
        </tr>
    </table>
    <table style="width: 100%; margin-top:10px;">
        <tr>
            <td><center>Mengetahui / Menyetujui</center></td>
        </tr>
        <tr>
            <td><center>KEPALA DIVISI UMUM,</center></td>
        </tr>
    </table>
     <table style="width: 100%; margin-top:65px;">
        <tr>
            <td><center><b><?=$berita_acara->kadiv_umum_nama?></b></center></td>
            
        </tr>
        <tr>
            <td><center>NIK. <?=$berita_acara->kadiv_umum_nik?></center></td>
        </tr>
    </table>
    <p class="right footer" style="margin-top:50px;">Jl. RE Martadinata No. 527 KUNINGAN - JAWA BARAT  45514</p>
    <p class="right footer" style="margin-top:-10px;">Telp. 0232-871190 (hunting) Fax : 0232-873927 SMS Pengaduan 085295850666</p>
    <p class="right footer" style="margin-top:-10px;">Email  : pamkuningan@gmail.com & pamkuningan.co.id</p>
</body>
</html>
<script type="text/javascript">
//window.print();
</script>
