<p style="text-align: center;"><strong>DATA PENEMPATAN PRAKERIN</strong></p>
<p>Program Studi : <b>{{$prakerin->rombel->kelas->prodi->nama}}</b>
<br>Kelas/Rombel : <b>{{$prakerin->rombel->nama}}</b>
<br>Tahun Ajaran : <b>{{$prakerin->TahunAjaran->nama}}</b>
<br>Jumlah Instansi : <b>{{$prakerin->penempatan->count()}}</b>
<table style="border-collapse: collapse; width: 100%; height: 54px;" border="1">
    <tbody>
        <tr style="height: 15px; background-color: #bfaeae;">
            <td style="width: 3.17634%; height: 15px;"><strong>No.</strong></td>
            <td style="width: 20.0204%; height: 15px;"><strong>Nama Instansi/DU/DI</strong></td>
            <td style="width: 15.1817%; height: 15px;"><strong>Bidang Usaha</strong></td>
            <td style="width: 12.5882%; height: 15px;"><strong>Pembimbing</strong></td>
            <td style="width: 21.6603%; height: 15px;"><strong>Alamat</strong></td>
            <td style="width: 14.8644%; height: 15px; text-align: center;"><strong>Kota/Kab</strong></td>
            <td style="width: 6.8644%; height: 15px; text-align: center;"><strong>Peserta</strong></td>

        </tr>
        	@php
        		$no = 0;
       	 	@endphp
        @foreach($prakerin->penempatan as $list)
        	@php
        		$no++;
        	@endphp
        <tr style="height: 21px;">
            <td style="width: 3.17634%; height: 21px; text-align: center;">{{$no}}</td>
            <td style="width: 20.0204%; height: 21px;"><b>{{$list->instansi->nama}}</b></td>
            <td style="width: 15.1817%; height: 21px;">{{$list->instansi->bidang_usaha->nama}}</td>
            <td style="width: 12.5882%; height: 21px;">{{gender_pembimbing($list->Pembimbing_lapangan->jenis_kelamin)}} {{$list->Pembimbing_lapangan->nama}}</td>
            <td style="width: 21.6603%; height: 21px;">{{$list->instansi->alamat}}</td>
            <td style="width: 14.8644%; height: 21px; text-align: center;">{{kabupaten($list->instansi->kabupaten_id)}}</td>
            <td style="width: 6.8644%; height: 21px; text-align: center;">{{jumlah_peserta_prakerin($list->id)}}</td>

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
                <p>
                    <strong>
                         @if($prakerin->prodi->tenpen_id != NULL)
                            {{$prakerin->prodi->tenpen->nama_lengkap}}
                         @else
                            . . . . . . . . . . . . . . . . . . . . . . .
                         @endif
                        
                    </strong>
                    <br />NIP. {{val($prakerin->prodi->tenpen->nip)}}
                </p>
            </td>
            <td style="width: 33.3333%;">&nbsp;</td>
            <td style="width: 33.3333%;">
                <p>&nbsp;</p>
                <p><strong>
                    @if($sekolah->tenpen_id != NULL)
                        {{val($sekolah->tenpen->nama_lengkap)}}
                    @else
                        . . . . . . . . . . . . . 
                    @endif
                </strong>
                    <br />NIP. {{val($sekolah->tenpen->nip)}}</p>
            </td>
        </tr>
    </tbody>
</table>
