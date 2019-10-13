<?php 

    /**
     * [Mendeteksi Kelas Saat Ini]
     * @param  [integer] $pesdik_id         [ID Peserta Didik]
     * @param  [integer] $tapel_aktif_id    [Tahun Pelajaran Aktif Saat Ini]
     * @return [string]                     [Kelas Saat Ini]
     */
    function kelas_pesdik($pesdik_id, $tapel_aktif_id){
        $kelas = DB::table('pesdik_rombel')
                    ->select('kelas.nama AS nama_kelas')
                    ->join('pesdik', 'pesdik_rombel.pesdik_id', 'pesdik.id')
                    ->join('rombel', 'pesdik_rombel.rombel_id', 'rombel.id')
                    ->join('tahun_ajaran', 'rombel.tahun_ajaran_id', 'tahun_ajaran.id')
                    ->join('kelas', 'rombel.kelas_id', 'kelas.id')
                    ->where('pesdik_rombel.pesdik_id', $pesdik_id)
                    ->where('rombel.tahun_ajaran_id', $tapel_aktif_id)
                    ->first();
        $get_kelas = $kelas->nama_kelas;
        return $get_kelas;
    }

    /**
     * @return [Objek Tahun Pelajaran Aktif Saat Ini]
     */
    function tapel_aktif(){
        $tahun_ajaran = DB::table('tahun_ajaran')->where('status', 'Aktif')->first();
        return $tahun_ajaran;
    }

    /**
     * @param  [Nilai Inputan]
     * @return [Override jika inputan kosong]
     */
    function val($value){
        if ($value == NULL) {
            $val = '-';
        }else{
            $val = $value;
        }
        return $val;
    }

    /**
     * @param  [Nama Peserta Didik, Dsb.]
     * @return [Memotong nama Peserta Didik agar tidak terlalu panjang]
     */
    function cut_name($name){
        $num_char = 10;
        $cut_text = substr($name, 0, $num_char);
        if ($name{$num_char - 1} != '') { // jika huruf ke num_char (num_char - 1 karena index dimulai dari 0) buka  spasi
            $new_pos = strrpos($cut_text, ' '); // cari posisi spasi, pencarian dari huruf terakhir
            $cut_text = substr($name, 0, $new_pos);
        }else{
            $cut_text = $name;
        }
        return $cut_text;
    }
    /**
     * [getImgUser description]
     * @param  [text] $img  [Data Directory Image User]
     * @param  [text] $name [Nama Dari User]
     * @return [image]       [Hasil Gambar Yang Ditampilkan]
     */
    function getImgUser($img, $name){
        if($img == NULL){
            $name       = $name;
            $cut_name   = substr($name, 0,1);
            $getImage   = '<span>'.$cut_name.'</span>';
        }else{
            $getImage = '<img src="'.asset($img).'" alt="image">';
        }

        return $getImage;
    }

    /**
     * [getImgUser description]
     * @param  [text] $img  [Data Directory Image Prodi]
     * @param  [text] $name [Nama Dari Program Studi]
     * @return [image]       [Hasil Gambar Yang Ditampilkan]
     */
    function getImageProdi($img, $name){
        if($img == NULL){
            $name       = $name;
            $cut_name   = substr($name, 0,1);
            $getImage   = '<span>'.$cut_name.'</span>';
        }else{
            $getImage = '<img src="'.asset($img).'" alt="image">';
        }

        return $getImage;
    }

    function photo_gender_pesdik($foto, $jk){
        if($foto == ''){
            if($jk == 'Laki-laki'){
                $viewFoto = "pesdik-l.png";
            }else{
                $viewFoto = "pesdik-p.png";
            }
        }else{
            $viewFoto = $foto;
        }
        return $viewFoto;
    }

    function sekolah(){
        $sekolah = DB::table('sekolah')->where('id', 1)->first();
        return $sekolah;
    }

    /*START:: FUNGSI UNTUK NOMOR HP*/
    function telp($telp){
      $telp = $telp;
      $noHP1 = substr($telp,0,4);
      $noHP2 = substr($telp,4,4);
      $noHP3 = substr($telp,8,5);
      $handphone = $noHP1."-".$noHP2."-".$noHP3;
      return "$handphone";
    }
    

    /**
     * START :: FUNCTION TANGGAL INDONESIA
     */
        function date_indo($tgl){
            $ubah = gmdate($tgl, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tanggal = $pecah[2];
            $bulan = bulan($pecah[1]);
            $tahun = $pecah[0];
            return $tanggal.' '.$bulan.' '.$tahun;
        }
        function bulan($bln){
            switch ($bln)
            {
                case 1:
                    return "Januari";
                    break;
                case 2:
                    return "Februari";
                    break;
                case 3:
                    return "Maret";
                    break;
                case 4:
                    return "April";
                    break;
                case 5:
                    return "Mei";
                    break;
                case 6:
                    return "Juni";
                    break;
                case 7:
                    return "Juli";
                    break;
                case 8:
                    return "Agustus";
                    break;
                case 9:
                    return "September";
                    break;
                case 10:
                    return "Oktober";
                    break;
                case 11:
                    return "November";
                    break;
                case 12:
                    return "Desember";
                    break;
            }
        }
        function shortdate_indo($tgl){
            $ubah = gmdate($tgl, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tanggal = $pecah[2];
            $bulan = short_bulan($pecah[1]);
            $tahun = $pecah[0];
            return $tanggal.'/'.$bulan.'/'.$tahun;
        }
        function short_bulan($bln){
            switch ($bln)
            {
                case 1:
                    return "01";
                    break;
                case 2:
                    return "02";
                    break;
                case 3:
                    return "03";
                    break;
                case 4:
                    return "04";
                    break;
                case 5:
                    return "05";
                    break;
                case 6:
                    return "06";
                    break;
                case 7:
                    return "07";
                    break;
                case 8:
                    return "08";
                    break;
                case 9:
                    return "09";
                    break;
                case 10:
                    return "10";
                    break;
                case 11:
                    return "11";
                    break;
                case 12:
                    return "12";
                    break;
            }
        }
        function mediumdate_indo($tgl){
            $ubah = gmdate($tgl, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tanggal = $pecah[2];
            $bulan = medium_bulan($pecah[1]);
            $tahun = $pecah[0];
            return $tanggal.'-'.$bulan.'-'.$tahun;
        }
        function medium_bulan($bln){
            switch ($bln)
            {
                case 1:
                    return "Jan";
                    break;
                case 2:
                    return "Feb";
                    break;
                case 3:
                    return "Mar";
                    break;
                case 4:
                    return "Apr";
                    break;
                case 5:
                    return "Mei";
                    break;
                case 6:
                    return "Jun";
                    break;
                case 7:
                    return "Jul";
                    break;
                case 8:
                    return "Ags";
                    break;
                case 9:
                    return "Sep";
                    break;
                case 10:
                    return "Okt";
                    break;
                case 11:
                    return "Nov";
                    break;
                case 12:
                    return "Des";
                    break;
            }
        }
        function longdate_indo($tanggal){
            $ubah = gmdate($tanggal, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tgl = $pecah[2];
            $bln = $pecah[1];
            $thn = $pecah[0];
            $bulan = bulan($pecah[1]);
      
            $nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
            $nama_hari = "";
            if($nama=="Sunday") {$nama_hari="Minggu";}
            else if($nama=="Monday") {$nama_hari="Senin";}
            else if($nama=="Tuesday") {$nama_hari="Selasa";}
            else if($nama=="Wednesday") {$nama_hari="Rabu";}
            else if($nama=="Thursday") {$nama_hari="Kamis";}
            else if($nama=="Friday") {$nama_hari="Jumat";}
            else if($nama=="Saturday") {$nama_hari="Sabtu";}
            return $nama_hari.','.$tgl.' '.$bulan.' '.$thn;
        }
    
    /**
     * END :: FUNCTION TANGGAL INDONESIA
     */
    


    /**
     * [Callback Kelurahan Name]
     * @param  [int] $kel_id [id kelurahan]
     * @return [string]       [Nama Provinsi]
     */
    function kelurahan($kel_id){
        $kelurahan = DB::table('kelurahan')
                        ->where('id', $kel_id)
                        ->first();
        $nama = $kelurahan->name;

        return $nama;
    }

    /**
     * [Callback Kecamatan Name]
     * @param  [int] $kec_id [id kecamatan]
     * @return [string]       [Nama Kecamatan]
     */
    function kecamatan($kec_id){
        $kecamatan = DB::table('kecamatan')
                        ->where('id', $kec_id)
                        ->first();
        $nama = $kecamatan->name;

        return $nama;
    }

     /**
     * [Callback Kabupaten Name]
     * @param  [int] $kab_id [id kabupaten]
     * @return [string]      [Nama Kabupaten]
     */
    function kabupaten($kab_id){
        $kabupaten = DB::table('kabupaten')
                        ->where('id', $kab_id)
                        ->first();
        $nama = $kabupaten->name;
        return ucfirst($nama);
    }
    
    /**
     * [Callback Provinsi Name]
     * @param  [int] $prov_id [id provinsi]
     * @return [string]       [Nama Provinsi]
     */
    function provinsi($prov_id){
        $provinsi = DB::table('provinsi')
                        ->where('id', $prov_id)
                        ->first();
        $nama = $provinsi->name;

        return $nama;
    }

    /**
     * ----------------------------------------------------------
     */
    
    /**
     * [Callback Nama Tempat Tinggal]
     * @param  [int] $id    [ID Tempat Tinggal]
     * @return [string]     [Nama Tempat Tinggal]
     */
    function tempat_tinggal($id)
    {
        $tempat_tinggal = DB::table('tempat_tinggal')
                            ->where('id', $id)
                            ->first();
        $nama = $tempat_tinggal->nama;

        return $nama;
    }

    function pendidikan($id){
        $pendidikan = DB::table('pendidikan')
                        ->where('id', $id)
                        ->first();
        $nama = $pendidikan->nama;

        return $nama;
    }
    function pekerjaan($id){
        $pekerjaan = DB::table('pekerjaan')
                        ->where('id', $id)
                        ->first();
        $nama = $pekerjaan->nama;

        return $nama;
    }
    function penghasilan($id){
        $penghasilan = DB::table('penghasilan')
                        ->where('id', $id)
                        ->first();
        $nama = $penghasilan->nama;

        return $nama;
    }

    /*START::INSTANSI*/
        function nama_instansi($id_instansi){
            $instansi = DB::table('prakerin_instansi')
                            ->select('nama')
                            ->where('id', $id_instansi)
                            ->first();
            return $instansi->nama;
        }

        function bidang_instansi($id_bidang){
            $instansi = DB::table('prakerin_bidang_usaha')
                            ->select('nama')
                            ->where('id', $id_bidang)
                            ->first();
            return $instansi->nama;
        }
    /*END::INSTANSI*/

    /*START::PEMBIMBING LAPANGAN*/
        function gender_pembimbing($jk){
            if ($jk == 'Laki-laki') {
                $val = 'Bpk.';
            }else{
                $val = 'Ibu';
            }
            return $val;
        }
    /*END::PEMBIMBING LAPANGAN*/

 ?>