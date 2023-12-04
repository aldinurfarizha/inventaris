<?php
if (!function_exists('opt_day')) {

    function opt_day()
    {
        $day = array();
        for ($x = 1; $x <= 31; $x++) {
            array_push($day, $x);
        }
        return $day;
    }
}

if (!function_exists('opt_tahun')) {
    function opt_tahun()
    {
        $tahun = array();
        for ($x = date("Y") - 5; $x <= date("Y"); $x++) {
            array_push($tahun, $x);
        }
        return $tahun;
    }
}
if (!function_exists('opt_satuan')) {
    function opt_satuan()
    {
        $satuan = array(
            'LS',
            'BH',
            'PAKET',
            'UNIT',
            'M',
            'M2',
            'M3',
	    'SET',
        );
        return $satuan;
    }
}
if (!function_exists('opt_bulan')) {
    function opt_bulan()
    {
        $bulan = array(
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
    function bulan($bulan)
    {
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
    function hariIndo($hari)
    {
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
    function terbilangHari($date)
    {
        $day = date('D', strtotime($date));
        return hariIndo($day);
    }
}
if (!function_exists('terbilangBulan')) {
    function terbilangBulan($date)
    {
        $month = date('m', strtotime($date));
        return strtoupper(bulan($month));
    }
}
if (!function_exists('terbilangTahun')) {
    function terbilangTahun($date)
    {
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
    function terbilangTanggal($date)
    {
        $day = date('d', strtotime($date));
        $angka = array(
            '01' => 'SATU',
            '02' => 'DUA',
            '03' => 'TIGA',
            '04' => 'EMPAT',
            '05' => 'LIMA',
            '06' => 'ENAM',
            '07' => 'TUJUH',
            '08' => 'DELAPAN',
            '09' => 'SEMBILAN',
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
    function generateJabatan($of_id, $sub_id)
    {
        $ci = &get_instance();
        if ($of_id == 1) {
            $ofname = $ci->db->query("SELECT * from sub_office where sub_id=" . $sub_id)->row()->nama;
            return "KEPALA " . $ofname;
        } else {
            $ofname = $ci->db->query("SELECT * from office where of_id=" . $of_id)->row()->nama;
            return "KEPALA " . $ofname;
        }
    }
}
if (!function_exists('tanggal')) {
    function tanggal($tanggal)
    {
        $a = explode('-', $tanggal);
        $tanggal = $a['2'] . " " . bulan($a['1']) . " " . $a['0'];
        return $tanggal;
    }
}
if (!function_exists('count_invent')) {
    function count_invent($of_id)
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT COUNT(id_inventaris) as res FROM inventaris where status=1 and of_id=" . $of_id)->row()->res;
    }
}
if (!function_exists('count_barang_kir')) {
    function count_barang_kir($id_kartu_inventaris)
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT COUNT(id_kartu_inventaris) as res FROM kartu_inventaris_barang where id_kartu_inventaris=$id_kartu_inventaris")->row()->res;
    }
}
if (!function_exists('count_ruangan_kir')) {
    function count_ruangan_kir($of_id, $sub_id = null)
    {
        $ci = &get_instance();
        if ($of_id && $sub_id) {
            return $ci->db->query("SELECT COUNT(id_ruangan_kir) as res FROM master_ruangan_kir  where of_id=$of_id and sub_id=$sub_id and is_deleted=0")->row()->res;
        } else {
            return $ci->db->query("SELECT COUNT(id_ruangan_kir) as res FROM master_ruangan_kir where of_id=$of_id and is_deleted=0")->row()->res;
        }
    }
}
if (!function_exists('count_kartu_inventaris')) {
    function count_kartu_inventaris($of_id = null, $sub_id = null, $id_ruang_kir = null)
    {
        $ci = &get_instance();
        if ($id_ruang_kir) {
            return $ci->db->query("SELECT COUNT(id_kartu_inventaris) as res FROM kartu_inventaris where id_ruangan_kir=$id_ruang_kir")->row()->res;
        }
        if ($of_id && $sub_id) {
            return $ci->db->query("SELECT COUNT(id_kartu_inventaris) as res FROM kartu_inventaris  where of_id=$of_id and sub_id=$sub_id")->row()->res;
        } else {
            return $ci->db->query("SELECT COUNT(id_kartu_inventaris) as res FROM kartu_inventaris where of_id=$of_id")->row()->res;
        }
    }
}
if (!function_exists('of_name')) {
    function of_name($of_id)
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT nama from office where of_id=" . $of_id)->row()->nama;
    }
}
if (!function_exists('get_detail_barang')) {
    function get_detail_barang($id)
    {
        $ci = &get_instance();
        return $ci->Global_model->get_detail_inventaris($id)->row();
    }
}
if (!function_exists('getHistoryUpdate')) {
    function getHistoryUpdate($id)
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT * FROM history_update where id_inventaris=$id order by id_history DESC");
    }
}
if (!function_exists('getNomorBA')) {
    function getNomorBA()
    {
        $ci = &get_instance();
        $yearNow = date('Y');
        $nomor = $ci->db->query("SELECT max(nomor) as nomor from berita_acara where YEAR(tanggal)=$yearNow")->row()->nomor;
        if ($nomor == 0) {
            return 1;
        } else {
            return $nomor += 1;
        }
    }
}
if (!function_exists('getNomorMutasi')) {
    function getNomorMutasi()
    {
        $ci = &get_instance();
        $yearNow = date('Y');
        $nomor = $ci->db->query("SELECT max(nomor) as nomor from mutasi where YEAR(tanggal)=$yearNow")->row()->nomor;
        if ($nomor == 0) {
            return 1;
        } else {
            return $nomor += 1;
        }
    }
}
if (!function_exists('getNomorPenghapusan')) {
    function getNomorPenghapusan()
    {
        $ci = &get_instance();
        $yearNow = date('Y');
        $nomor = $ci->db->query("SELECT max(nomor) as nomor from penghapusan where YEAR(tanggal)=$yearNow")->row()->nomor;
        if ($nomor == 0) {
            return 1;
        } else {
            return $nomor += 1;
        }
    }
}
if (!function_exists('infoPerusahaan')) {
    function infoPerusahaan()
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT * from profile_perusahaan where id=1")->row();
    }
}
if (!function_exists('getPerkiraan')) {
    function getPerkiraan()
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT * from master_perkiraan where deleted=0")->result();
    }
}
if (!function_exists('infoPusat')) {
    function infoPusat($sub_id)
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT * from sub_office where sub_id=$sub_id")->row();
    }
}
if (!function_exists('detailOfid')) {
    function detailOfid($of_id)
    {
        if ($of_id == '') {
            return null;
        }
        $ci = &get_instance();
        return $ci->db->query("SELECT * from office where of_id=$of_id")->row();
    }
}
if (!function_exists('detailSubOffice')) {
    function detailSubOffice($sub_id)
    {
        if ($sub_id == '') {
            return null;
        }
        $ci = &get_instance();
        return $ci->db->query("SELECT * from sub_office where sub_id=$sub_id")->row();
    }
}
if (!function_exists('infoCabang')) {
    function infoCabang($of_id)
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT * from office where of_id=$of_id")->row();
    }
}
if (!function_exists('getYear')) {
    function getYear($date)
    {
        $time = strtotime($date);
        $newformat = date('Y', $time);
        return $newformat;
    }
}
if (!function_exists('getDetailBA')) {
    function getDetailBA($id)
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT * from berita_acara where id=$id")->row();
    }
}
if (!function_exists('getRuanganKIR')) {
    function getRuanganKIR($of_id, $sub_id = null)
    {
        $ci = &get_instance();
        if ($of_id && $sub_id) {
            return $ci->db->query("SELECT * FROM master_ruangan_kir where of_id=$of_id and sub_id=$sub_id and is_deleted=0")->result();
        } else {
            return $ci->db->query("SELECT * FROM master_ruangan_kir where of_id=$of_id and is_deleted=0")->result();
        }
    }
}
if (!function_exists('getDetailMutasi')) {
    function getDetailMutasi($id)
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT * from mutasi where id_mutasi=$id")->row();
    }
}
if (!function_exists('getDetailPenghapusan')) {
    function getDetailPenghapusan($id)
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT * from penghapusan where id_penghapusan=$id")->row();
    }
}
if (!function_exists('getNamaRuanganKir')) {
    function getNamaRuanganKir($id_ruangan_kir)
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT * from master_ruangan_kir where id_ruangan_kir=$id_ruangan_kir")->row();
    }
}
if (!function_exists('formatNomor')) {
    function formatNomor($no)
    {
        return sprintf("%03s", $no);
    }
}
if (!function_exists('generateNomorBA')) {
    function generateNomorBA($id_berita_acara)
    {
        $data_ba = @getDetailBA($id_berita_acara);
        $awal = '690/';
        $tengah = formatNomor(@$data_ba->nomor);
        $akhir = '/BAST/LOG-ASET/';
        $akhir2 = bulanRomawi(@$data_ba->tanggal) . '/' . @getYear($data_ba->tanggal);
        $nomor = $awal . $tengah . $akhir . $akhir2;
        return $nomor;
    }
}
if (!function_exists('generateNomorMutasi')) {
    function generateNomorMutasi($id_mutasi)
    {
        $data_mutasi = @getDetailMutasi($id_mutasi);
        $awal = '690/';
        $tengah = formatNomor(@$data_mutasi->nomor) . '/';
        $tengah2 = $data_mutasi->asal_kantor . '/';
        $akhir = 'BAMB/';
        $akhir2 = bulanRomawi(@$data_mutasi->tanggal) . '/';
        $akhir3 = date('Y', strtotime(@$data_mutasi->tanggal));
        $nomor = $awal . $tengah . $tengah2 . $akhir . $akhir2 . $akhir3;
        return $nomor;
    }
}
if (!function_exists('generateNomorPenghapusan')) {
    function generateNomorPenghapusan($id_penghapusan)
    {
        $data_ba = @getDetailPenghapusan($id_penghapusan);
        $awal = '020/Um./Penghapusan/ ';
        $tengah = formatNomor(@$data_ba->nomor);
        $akhir = ' -PAM/TK/';
        $akhir2 = @getYear($data_ba->tanggal);
        $nomor = $awal . $tengah . $akhir . $akhir2;
        return $nomor;
    }
}
if (!function_exists('limitText')) {
    function limitText($text)
    {
        $limit = 25;
        if (strlen($text) <= $limit) {
            return $text;
        } else {
            $text = substr($text, 0, $limit) . '...';
            return $text;
        }
    }
}
if (!function_exists('bulanRomawi')) {
    function bulanRomawi($date)
    {
        $month = date('m', strtotime($date));
        $romawi = array(
            '01' => 'I',
            '02' => 'II',
            '03' => 'III',
            '04' => 'IV',
            '05' => 'V',
            '06' => 'VI',
            '07' => 'VII',
            '08' => 'VIII',
            '09' => 'IX',
            '10' => 'X',
            '11' => 'XI',
            '12' => 'XII'
        );
        return $romawi[$month];
    }
}
if (!function_exists('terbilangAngka')) {
    function terbilangAngka($day)
    {
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
if (!function_exists('getEmployeeSimpeg')) {
    function getEmployeeSimpeg($where)
    {
        $ci = &get_instance();
        $db2 = $ci->load->database('database2', TRUE);
        $db2->select('pgw_id as id, pgw_nama as nama,pgw_nup as nik,employee.off_id, occ_name as jabatan,subdept_name as sub_dep, dept_name as dept, off_name as office');
        $db2->join('occupation', 'employee.occ_id=occupation.occ_id');
        $db2->join('departmentsub', 'employee.subdept_id=departmentsub.subdept_id');
        $db2->join('department', 'employee.dept_id=department.dept_id');
        $db2->join('office', 'employee.off_id=office.off_id');
        $db2->order_by("occupation.urut", "asc");
        $db2->from('employee');
        $db2->where($where);
        return $db2->get();
    }
}
if (!function_exists('countJumlahBarangMutasi')) {
    function countJumlahBarangMutasi($id_mutasi)
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT count(id_mutasi) as total from mutasi_inventaris where id=$id_mutasi")->row()->total;
    }
}
if (!function_exists('countJumlahBarangPenghapusan')) {
    function countJumlahBarangPenghapusan($id_penghapusan)
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT count(id_penghapusan) as total from penghapusan_inventaris where id_penghapusan=$id_penghapusan")->row()->total;
    }
}
if (!function_exists('countJumlahBarangPengembalian')) {
    function countJumlahBarangPengembalian($id_pengembalian)
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT count(id_pengembalian) as total from pengembalian where id_pengembalian=$id_pengembalian")->row()->total;
    }
}
if (!function_exists('getRuanganKirByofidandsubid')) {
    function getRuanganKirByofidandsubid($of_id, $sub_id = null)
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT * from master_ruangan_kir where of_id=$of_id and sub_id=$sub_id");
    }
}
if (!function_exists('getInventarisByIdRuanganKir')) {
    function getInventarisByIdRuanganKir($id_ruangan_kir)
    {
        $ci = &get_instance();
        $ci->db->select('inventaris.*, master_barang.*, office.*, office.nama as nama_kantor, sub_office.nama as nama_sub_kantor,master_perkiraan.*, master_perkiraan_dasar.*, master_ruangan_kir.nama_ruangan');
        $ci->db->from('inventaris');
        $ci->db->join('master_barang', 'master_barang.id_barang=inventaris.id_barang');
        $ci->db->join('master_perkiraan', 'master_barang.id_perkiraan=master_perkiraan.id_perkiraan');
        $ci->db->join('master_perkiraan_dasar', 'master_perkiraan.kd_perkiraan_dasar = master_perkiraan_dasar.kd_perkiraan_dasar');
        $ci->db->join('office', 'office.of_id=inventaris.of_id');
        $ci->db->join('sub_office', 'sub_office.sub_id=inventaris.sub_id', 'left');
        $ci->db->join('master_ruangan_kir', 'inventaris.id_ruangan_kir=master_ruangan_kir.id_ruangan_kir', 'left');
        $ci->db->where(['inventaris.id_ruangan_kir' => $id_ruangan_kir, 'inventaris.status' => 1]);
        return $ci->db->get();
    }
}
if (!function_exists('getSelectedBarang')) {
    function getSelectedBarang($barang)
    {
        $ci = &get_instance();
        $ci->db->select('*');
        $ci->db->from('inventaris');
        $ci->db->where_in('id_inventaris', $barang);
        return $ci->db->get()->result();
    }
}
if (!function_exists('deleteSelectedBarang')) {
    function deleteSelectedBarang($barang)
    {
        $ci = &get_instance();
        $ci->db->where_in('id_inventaris', $barang);
        $ci->db->delete('inventaris');
    }
}
if (!function_exists('countPerkiraanDasar')) {
    function countPerkiraanDasar($kode)
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT count(id_inventaris)as total FROM inventaris inner join master_barang on inventaris.id_barang = master_barang.id_barang inner join master_perkiraan on master_barang.id_perkiraan = master_perkiraan.id_perkiraan where master_perkiraan.kd_perkiraan_dasar='$kode'")->row()->total;
    }
}
