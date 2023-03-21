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

if (!function_exists('tanggal')) {
    function tanggal($tanggal) {
        $a = explode('-',$tanggal);
        $tanggal = $a['2']." ".bulan($a['1'])." ".$a['0'];
        return $tanggal;
    }
}