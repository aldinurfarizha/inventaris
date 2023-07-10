<?php
if(!function_exists('opt_day')){

    function opt_day(){
        $day=array();
        for ($x = 1; $x <= 31; $x++) {
            array_push($day,$x);
        } 
        return $day;
    }
}

if (!function_exists('opt_tahun')){
    function opt_tahun(){
        $tahun=array();
        for ($x = date("Y")-5; $x <= date("Y"); $x++) {
            array_push($tahun,$x);
        } 
        return $tahun;
    }
}
if(!function_exists('opt_satuan')){
    function opt_satuan(){
        $satuan=array(
            'LS',
            'BH',
            'PAKET',
            'UNIT',
            'M',
            'M2',
            'M3',
        );
        return $satuan;
    }
}
if(!function_exists('opt_bulan')){
    function opt_bulan(){
        $bulan=array(
            '',
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        return $bulan;
    }
}
if (!function_exists('bulan')) {
    function bulan($bulan){
        switch ($bulan) {
            case 1:
                $bulan = "Januari";
                break;
            case 2:
                $bulan = "Februari";
                break;
            case 3:
                $bulan = "Maret";
                break;
            case 4:
                $bulan = "April";
                break;
            case 5:
                $bulan = "Mei";
                break;
            case 6:
                $bulan = "Juni";
                break;
            case 7:
                $bulan = "Juli";
                break;
            case 8:
                $bulan = "Agustus";
                break;
            case 9:
                $bulan = "September";
                break;
            case 10:
                $bulan = "Oktober";
                break;
            case 11:
                $bulan = "November";
                break;
            case 12:
                $bulan = "Desember";
                break;
            default:
                $bulan = Date('F');
                break;
        }
        return $bulan;
    }
}
if (!function_exists('hariIndo')) {
    function hariIndo($hari){
       $dayList = array(
            'Sun' => 'MINGGU',
            'Mon' => 'SENIN',
            'Tue' => 'SELASA',
            'Wed' => 'RABU',
            'Thu' => 'KAMIS',
            'Fri' => 'JUMAT',
            'Sat' => 'SABTU'
        );
        return $dayList[$hari];
    }
}
if (!function_exists('terbilangHari')) {
    function terbilangHari($date){
       $day = date('D', strtotime($date));
       return hariIndo($day);
    }
}
if (!function_exists('terbilangBulan')) {
    function terbilangBulan($date){
       $month = date('m', strtotime($date));
       return bulan($month);
    }
}
if (!function_exists('terbilangTahun')) {
    function terbilangTahun($date){
       $years = date('Y', strtotime($date));
       $angka = array(
        '2020' => 'DUA RIBU DUA PULUH',
        '2021' => 'DUA RIBU DUA PULUH SATU',
        '2022' => 'DUA RIBU DUA PULUH DUA',
        '2023' => 'DUA RIBU DUA PULUH TIGA',
        '2024' => 'DUA RIBU DUA PULUH EMPAT',
        '2025' => 'DUA RIBU DUA PULUH LIMA',
        '2026' => 'DUA RIBU DUA PULUH ENAM',
        '2027' => 'DUA RIBU DUA PULUH TUJUH',
        '2028' => 'DUA RIBU DUA PULUH DELAPAN',
        '2029' => 'DUA RIBU DUA PULUH SEMBILAN',
        '2030' => 'DUA RIBU TIGA PULUH',
        '2031' => 'DUA RIBU TIGA PULUH SATU',
        '2032' => 'DUA RIBU TIGA PULUH DUA',
        '2033' => 'DUA RIBU TIGA PULUH TIGA',
        '2034' => 'DUA RIBU TIGA PULUH EMPAT',
        '2035' => 'DUA RIBU TIGA PULUH LIMA',
        '2036' => 'DUA RIBU TIGA PULUH ENAM',
        '2037' => 'DUA RIBU TIGA PULUH TUJUH',
        '2038' => 'DUA RIBU TIGA PULUH DELAPAN',
        '2039' => 'DUA RIBU TIGA PULUH SEMBILAN',
        '2040' => 'DUA RIBU EMPAT PULUH',
        '2041' => 'DUA RIBU EMPAT PULUH SATU',
        '2042' => 'DUA RIBU EMPAT PULUH DUA',
        '2043' => 'DUA RIBU EMPAT PULUH TIGA',
        '2044' => 'DUA RIBU EMPAT PULUH EMPAT',
        '2045' => 'DUA RIBU EMPAT PULUH LIMA',
        '2046' => 'DUA RIBU EMPAT PULUH ENAM',
        '2047' => 'DUA RIBU EMPAT PULUH TUJUH',
        '2048' => 'DUA RIBU EMPAT PULUH DELAPAN',
        '2049' => 'DUA RIBU EMPAT PULUH SEMBILAN',
        '2050' => 'DUA RIBU LIMA PULUH',
        );
        return $angka[$years];
    }
}
if (!function_exists('terbilangTanggal')) {
    function terbilangTanggal($date){
       $day = date('d', strtotime($date));
       $angka = array(
        '1' => 'SATU',
        '2' => 'DUA',
        '3' => 'TIGA',
        '4' => 'EMPAT',
        '5' => 'LIMA',
        '6' => 'ENAM',
        '7' => 'TUJUH',
        '8' => 'DELAPAN',
        '9' => 'SEMBILAN',
        '10' => 'SEPULUH',
        '11' => 'SEBELAS',
        '12' => 'DUA BELAS',
        '13' => 'TIGA BELAS',
        '14' => 'EMPAT BELAS',
        '15' => 'LIMA BELAS',
        '16' => 'ENAM BELAS',
        '17' => 'TUJUH BELAS',
        '18' => 'DELAPAN BELAS',
        '19' => 'SEMBILAN BELAS',
        '20' => 'DUA PULUH',
        '21' => 'DUA PULUH SATU',
        '22' => 'DUA PULUH DUA',
        '23' => 'DUA PULUH TIGA',
        '24' => 'DUA PULUH EMPAT',
        '25' => 'DUA PULUH LIMA',
        '26' => 'DUA PULUH ENAM',
        '27' => 'DUA PULUH TUJUH',
        '28' => 'DUA PULUH DELAPAN',
        '29' => 'DUA PULUH SEMBILAN',
        '30' => 'TIGA PULUH',
        '31' => 'TIGA PULUH SATU',
        );
        return $angka[$day];
    }
}
if (!function_exists('generateJabatan')) {
    function generateJabatan($of_id,$sub_id) {
        $ci =& get_instance();
        if($of_id==1){
        $ofname=$ci->db->query("SELECT * from sub_office where sub_id=".$sub_id)->row()->nama;
        return "KEPALA ".$ofname;
        }else{
        $ofname=$ci->db->query("SELECT * from office where of_id=".$of_id)->row()->nama;
        return "KEPALA ".$ofname;
        }
       
    }
}
if (!function_exists('tanggal')) {
    function tanggal($tanggal) {
        $a = explode('-',$tanggal);
        $tanggal = $a['2']." ".bulan($a['1'])." ".$a['0'];
        return $tanggal;
    }
}
if (!function_exists('count_invent')) {
    function count_invent($of_id) {
        $ci =& get_instance();
        return $ci->db->query("SELECT COUNT(id_inventaris) as res FROM inventaris where status=1 and of_id=".$of_id)->row()->res;
    }
}
if (!function_exists('of_name')) {
    function of_name($of_id) {
        $ci =& get_instance();
        return $ci->db->query("SELECT nama from office where of_id=".$of_id)->row()->nama;
    }
}
if (!function_exists('get_detail_barang')) {
    function get_detail_barang($id) {
        $ci =& get_instance();
        return $ci->Global_model->get_detail_inventaris($id)->row();
    }
}
if (!function_exists('getNomorBA')) {
    function getNomorBA() {
        $ci =& get_instance();
        $yearNow=date('Y');
        $nomor=$ci->db->query("SELECT max(nomor) as nomor from berita_acara where YEAR(tanggal)=$yearNow")->row()->nomor;
        if($nomor==0){
            return 1;
        }else{
            return $nomor+=1;
        }
    }
}
if (!function_exists('infoPerusahaan')) {
    function infoPerusahaan() {
        $ci =& get_instance();
        return $ci->db->query("SELECT * from profile_perusahaan where id=1")->row();
    }
}
if (!function_exists('getPerkiraan')) {
    function getPerkiraan() {
        $ci =& get_instance();
        return $ci->db->query("SELECT * from master_perkiraan where deleted=0")->result();
    }
}
if (!function_exists('infoPusat')) {
    function infoPusat($sub_id) {
        $ci =& get_instance();
        return $ci->db->query("SELECT * from sub_office where sub_id=$sub_id")->row();
    }
}
if (!function_exists('detailOfid')) {
    function detailOfid($of_id) {
        if($of_id==''){
            return null;
        }
        $ci =& get_instance();
        return $ci->db->query("SELECT * from office where of_id=$of_id")->row();
    }
}
if (!function_exists('detailSubOffice')) {
    function detailSubOffice($sub_id) {
        if($sub_id==''){
            return null;
        }
        $ci =& get_instance();
        return $ci->db->query("SELECT * from sub_office where sub_id=$sub_id")->row();
    }
}
if (!function_exists('infoCabang')) {
    function infoCabang($of_id) {
        $ci =& get_instance();
        return $ci->db->query("SELECT * from office where of_id=$of_id")->row();
    }
}
if (!function_exists('getYear')) {
    function getYear($date) {
        $time = strtotime($date);
        $newformat = date('Y',$time);
        return $newformat;
    }
}
if (!function_exists('getDetailBA')) {
    function getDetailBA($id) {
        $ci =& get_instance();
        return $ci->db->query("SELECT * from berita_acara where id=$id")->row();
    }
}
if (!function_exists('formatNomor')) {
    function formatNomor($no) {
       return sprintf("%03s", $no);
    }
}
if (!function_exists('generateNomorBA')) {
    function generateNomorBA($id_berita_acara) {
       $data_ba=@getDetailBA($id_berita_acara);
       $awal='020/Um. ';
       $tengah=formatNomor(@$data_ba->nomor);
       $akhir=' -PAM/TK/';
       $akhir2=@getYear($data_ba->tanggal);
       $nomor=$awal.$tengah.$akhir.$akhir2;
       return $nomor;
    }
}
if (!function_exists('limitText')) {
    function limitText($text) {
        $limit=25;
        if(strlen($text)<=$limit){
            return $text;
        }else{
            $text = substr($text,0,$limit) . '...';
            return $text;
        }
    }
}