<p style="text-align: center;"><strong>DATA PENEMPATAN PRAKERIN</strong></p>
<p>Program Studi : Teknik Komputer Jaringan
<br>Kelas/Rombel : XI TKJ
<br>Tahun Ajaran : 2019/2020
<br>Jumlah Instansi : 5
<br>Jumlah Peserta : 21</p>
<table style="border-collapse: collapse; width: 100%; height: 54px;" border="1">
    <tbody>
        <tr style="height: 15px; background-color: #bfaeae;">
            <td style="width: 3.17634%; height: 15px;"><strong>No.</strong></td>
            <td style="width: 27.0204%; height: 15px;"><strong>Nama Instansi/DU/DI</strong></td>
            <td style="width: 15.1817%; height: 15px;"><strong>Bidang Usaha</strong></td>
            <td style="width: 12.5882%; height: 15px;"><strong>Pembimbing</strong></td>
            <td style="width: 14.6603%; height: 15px;"><strong>Alamat</strong></td>
            <td style="width: 14.8644%; height: 15px; text-align: center;"><strong>Kota/Kab</strong></td>
            <td style="width: 12.5089%; height: 15px; text-align: center;"><strong>Navigasi Maps</strong></td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 3.17634%; height: 18px;">1</td>
            <td style="width: 27.0204%; height: 18px;"><strong>PT. Jelajah Citra Informatika</strong></td>
            <td style="width: 15.1817%; height: 18px;">Layanan Jaringan</td>
            <td style="width: 12.5882%; height: 18px;">Bpk. Novi</td>
            <td style="width: 14.6603%; height: 18px;">Jl. Mentor I No.1</td>
            <td style="width: 14.8644%; height: 18px; text-align: center;">Bandung</td>
            <td style="width: 12.5089%; height: 18px; text-align: center;">barcode</td>
        </tr>
        @foreach($prakerin->penempatan as $list)
        <tr style="height: 21px;">
            <td style="width: 3.17634%; height: 21px;"></td>
            <td style="width: 27.0204%; height: 21px;">{{$list->instansi->nama}}</td>
            <td style="width: 15.1817%; height: 21px;">{{$list->instansi->bidang_usaha->nama}}</td>
            <td style="width: 12.5882%; height: 21px;">{{gender_pembimbing($list->Pembimbing_lapangan->jenis_kelamin)}} {{$list->Pembimbing_lapangan->nama}}</td>
            <td style="width: 14.6603%; height: 21px;">{{$list->instansi->alamat}}</td>
            <td style="width: 14.8644%; height: 21px;">{{kabupaten($list->instansi->kabupaten_id)}}</td>
            <td style="width: 12.5089%; height: 21px;">&nbsp;</td>
        </tr>
        @endforeach
    </tbody>
</table>
<p>&nbsp;</p>
<table style="border-collapse: collapse; width: 100%;" border="0">
    <tbody>
        <tr>
            <td style="width: 33.3333%;">Ketua Prodi</td>
            <td style="width: 33.3333%;">&nbsp;</td>
            <td style="width: 33.3333%;">Mengetahui,</td>
        </tr>
        <tr>
            <td style="width: 33.3333%;">Teknik Komputer Jaringan</td>
            <td style="width: 33.3333%;">&nbsp;</td>
            <td style="width: 33.3333%;">Kepala Sekolah/Lembaga</td>
        </tr>
        <tr>
            <td style="width: 33.3333%;">&nbsp;</td>
            <td style="width: 33.3333%;">&nbsp;</td>
            <td style="width: 33.3333%;">SMK IKA KARTIKA</td>
        </tr>
        <tr>
            <td style="width: 33.3333%;">
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p><strong>M. Iqbal, M.Kom</strong>
                    <br />NIP. 1111</p>
            </td>
            <td style="width: 33.3333%;">&nbsp;</td>
            <td style="width: 33.3333%;">
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p><strong>Achmad Jamaludin, S.E</strong>
                    <br />NIP. 2222</p>
            </td>
        </tr>
    </tbody>
</table>
