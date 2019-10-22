<<head>
	<meta charset="utf-8">
	<title>Cetak Surat</title>
</head>
<table style="border-collapse: collapse; width: 85.7144%; height: 126px;" border="0">
    <tbody>
        <tr style="height: 18px;">
            <td style="width: 8.2403%; height: 126px;" rowspan="7">
            	@if($sekolah->logo == NULL)
            		<img style="display: block; margin-left: auto; margin-right: auto;" 
            		src="{{ asset('image/tutwuri.png') }}" alt="" width="100" height="99" />
            	@else
            		<img style="display: block; margin-left: auto; margin-right: auto;" 
            		src="{{ asset($sekolah->logo) }}" alt="" width="100" height="99" />
            	@endif
            	
           	</td>
            <td style="width: 85.6165%; height: 18px; text-align: center;"><strong>{{strtoupper($sekolah->yayasan)}}</strong></td>
            <td style="width: 1.27226%; height: 126px;" rowspan="7">
            	@if($sekolah->logo_dinas == NULL)
            		<img style="display: block; margin-left: auto; margin-right: auto;" 
            		src="{{ asset('image/tutwuri.png') }}" alt="" width="100" height="99" />
            	@else
            		<img style="display: block; margin-left: auto; margin-right: auto;" 
            		src="{{ asset($sekolah->logo_dinas) }}" alt="" width="100" height="99" />
            	@endif
            </td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 85.6165%; height: 18px; text-align: center;"><strong>{{strtoupper($sekolah->nama_sekolah)}}</strong></td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 85.6165%; height: 18px; text-align: center;"><strong><small>TERAKREDITASI {{$sekolah->status_akreditasi}}</small></strong></td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 85.6165%; height: 18px; text-align: center;">
            	<strong><small>SK No. {{$sekolah->sk_akreditasi}}</small></strong>
            </td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 85.6165%; height: 18px; text-align: center;">
            	{{$sekolah->alamat}} - {{$sekolah->desa}}
            </td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 85.6165%; height: 18px; text-align: center;">
            	{{$sekolah->kecamatan}} - {{$sekolah->kota}} - {{$sekolah->provinsi}} - {{$sekolah->kode_pos}}
            </td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 85.6165%; height: 18px; text-align: center;">{{telp($sekolah->no_telp)}} | {{$sekolah->email}} | {{$sekolah->website}}</td>
        </tr>
    </tbody>
</table>
<hr />
<table style="border-collapse: collapse; width: 100%; height: 54px;" border="0">
    <tbody>
        <tr style="height: 18px;">
            <td style="width: 16.2123%; height: 18px;">Nomor</td>
            <td style="width: 1.27219%; height: 18px;">:</td>
            <td style="width: 52.599%; height: 18px;">{{$surat->nomor}}</td>
            <td style="width: 29.9164%;">{{$sekolah->kota}}, {{date_indo($surat->tanggal)}}</td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 16.2123%; height: 18px;">Lampiran</td>
            <td style="width: 1.27219%; height: 18px;">:</td>
            <td style="width: 52.599%; height: 18px;">{{$surat->lampiran}}</td>
            <td style="width: 29.9164%;">&nbsp;</td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 16.2123%; height: 18px;">Prihal</td>
            <td style="width: 1.27219%; height: 18px;">:</td>
            <td style="width: 52.599%; height: 18px;"><strong>{{ $surat->prihal }}</strong></td>
            <td style="width: 29.9164%;"><strong>&nbsp;</strong></td>
        </tr>
    </tbody>
</table>
<p>Kepada Yth,
    <br />{{$surat->tujuan}}
    <br />di
    <br />Tempat</p>
{!! $surat->isi !!}<br>
<table style="border-collapse: collapse; width: 100%; height: 147px;" border="0">
    <tbody>
        <tr style="height: 18px;">
            <td style="width: 33.3333%; height: 18px;">&nbsp;</td>
            <td style="width: 33.3333%; height: 18px;">&nbsp;</td>
            <td style="width: 33.3333%; height: 18px;"><small>{{ $surat->jabatan->nama }},</small></td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 33.3333%; height: 18px;">&nbsp;</td>
            <td style="width: 33.3333%; height: 18px;">&nbsp;</td>
            <td style="width: 33.3333%; height: 18px;"><small>{{$sekolah->nama_sekolah}}</small></td>
        </tr>
        <tr style="height: 50px;">
            <td style="width: 33.3333%; height: 75px;">&nbsp;</td>
            <td style="width: 33.3333%; height: 75px;">&nbsp;</td>
            <td style="width: 33.3333%; height: 75px;">&nbsp;</td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 33.3333%; height: 18px;">&nbsp;</td>
            <td style="width: 33.3333%; height: 18px;">&nbsp;</td>
            <td style="width: 33.3333%; height: 18px;"><strong><small>{{$surat->penanda_tangan}}</small></strong></td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 33.3333%; height: 18px;">&nbsp;</td>
            <td style="width: 33.3333%; height: 18px;">&nbsp;</td>
            <td style="width: 33.3333%; height: 18px;"><small>NIP. {{val($surat->NIP_penanda_tangan)}}</small></td>
        </tr>
    </tbody>
</table>
{!! $surat->tembusan !!}
