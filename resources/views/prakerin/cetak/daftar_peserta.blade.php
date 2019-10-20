<p style="text-align: center;"><strong>DAFTAR PESERTA PRAKERIN</strong></p>
<br>Program Studi : <b>{{$prakerin->rombel->kelas->prodi->nama}}</b>
<br>Kelas/Rombel : <b>{{$prakerin->rombel->nama}}</b>
<br>Tahun Ajaran : <b>{{$prakerin->TahunAjaran->nama}}</b>
<br>Jumlah Peserta Didik : <b>{{$peserta->count()}}</b></p>
<hr>
<table style="border-collapse: collapse; width: 100%; height: 54px;" border="1">
    <tbody>
        <tr style="height: 15px;">
            <td style="width: 3.17634%; height: 15px; text-align: center"><strong>No.</strong></td>
            <td style="width: 20.0411%; height: 15px;"><strong>Nama Peserta</strong></td>
            <td style="width: 9.72909%; height: 15px;"><strong>Jenis Kelamin</strong></td>
            <td style="width: 8.98968%; height: 15px; text-align: center;"><strong>NISN</strong></td>
            <td style="width: 9.94031%; height: 15px; text-align: center;"><strong>NIPD</strong></td>
            <td style="width: 21.3908%; text-align: left;"><strong>Tempat Kerja</strong></td>
        </tr>
            @php
                $no = 1;
            @endphp
            @foreach($peserta as $list)
                <tr style="height: 18px;">
                    <td style="width: 3.17634%; height: 18px; text-align: center">{{$no++}}</td>
                    <td style="width: 20.0411%; height: 18px;"><strong>{{$list->nama_lengkap}}</strong></td>
                    <td style="width: 9.72909%; height: 18px;">{{$list->jenis_kelamin}}</td>
                    <td style="width: 8.98968%; height: 18px; text-align: center;">test nisn</td>
                    <td style="width: 9.94031%; height: 18px; text-align: center;">test nipd</td>
                    <td style="width: 21.3908%; text-align: left;">test tempat kerja</td>
                </tr>
            @endforeach
        <tr style="height: 21px;">
            <td style="width: 3.17634%; height: 21px;">&nbsp;</td>
            <td style="width: 20.0411%; height: 21px;">&nbsp;</td>
            <td style="width: 9.72909%; height: 21px;">&nbsp;</td>
            <td style="width: 8.98968%; height: 21px;">&nbsp;</td>
            <td style="width: 9.94031%; height: 21px;">&nbsp;</td>
            <td style="width: 21.3908%;">&nbsp;</td>
        </tr>
    </tbody>
</table>
<p>&nbsp;</p>
<table style="border-collapse: collapse; width: 100%;" border="1">
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
<p>&nbsp;</p>