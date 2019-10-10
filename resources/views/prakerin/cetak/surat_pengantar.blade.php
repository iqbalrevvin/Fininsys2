{{-- @forelse($list_peserta as $list)
	{{$list->id}}
@empty
@endforelse --}}
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
            <td style="width: 52.599%; height: 18px;">{{$no_surat}}</td>
            <td style="width: 29.9164%;">{{$sekolah->kota}}, {{date_indo($tgl_surat)}}</td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 16.2123%; height: 18px;">Lampiran</td>
            <td style="width: 1.27219%; height: 18px;">:</td>
            <td style="width: 52.599%; height: 18px;">{{$lampiran_surat}}</td>
            <td style="width: 29.9164%;">&nbsp;</td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 16.2123%; height: 18px;">Prihal</td>
            <td style="width: 1.27219%; height: 18px;">:</td>
            <td style="width: 52.599%; height: 18px;"><strong>Permohonan Praktek Kerja Industri (Prakerin)</strong></td>
            <td style="width: 29.9164%;"><strong>&nbsp;</strong></td>
        </tr>
    </tbody>
</table>
<p>Kepada Yth,
    <br />Bapak/Ibu Pimpinan {{$penempatan->instansi->nama}}
    <br />di
    <br />Tempat</p>
<p><em>Assalamu'alaikum Wr. Wb.</em></p>
<p align="justify">Salam sejahtera kami sampaikan kepada bapak/ibu beserta staf semoga tetap ada dalam keadaan sehat wal'afiat serta sukses dalam menjalankan tugas sehari-hari, Amin.</p>
<p align="justify">Dalam rangka melaksanakan undang-undang republik indonesia No. 20 /2003 tentang system pendidikan nasional, Bab  III pasal 4 tentang penyelenggaraan pendidikan, Bab IV pasal 8 dan 9 tentang hak dan kewajiban masyarakat, dan Bab XV tentang peran serta masyarakat dalam pendidikan, serta didorong oleh tanggung jawab kita dalam meningkatkan pengetahuan.<br>maka dengan ini kami sampaikan permohonan sekiranya peserta didik kami berikut ini</p>

<table style="border-collapse: collapse; width: 100%; height: 54px;" border="1">
    <tbody>
        <tr style="height: 18px; background-color: #bfaeae;">
            <td style="width: 5.38713%; height: 18px; text-align: center;"><strong>No.</strong></td>
            <td style="width: 34.6128%; height: 18px; text-align: left;"><strong>Nama Lengkap</strong></td>
            <td style="width: 11.9302%; height: 18px; text-align: center;"><strong>NIPD</strong></td>
            <td style="width: 12.3664%; height: 18px; text-align: center;"><strong>NISN</strong></td>
            <td style="width: 35.7034%; text-align: center; height: 18px;"><strong>Program Studi</strong></td>
        </tr>
        @php
        	$no = 0;
        @endphp
        @forelse($list_peserta as $list)
        	@php
        		$no++;
        	@endphp
        	<tr style="height: 18px;">
	            <td style="width: 5.38713%; height: 18px; text-align: center;">{{$no}}</td>
	            <td style="width: 34.6128%; height: 18px; text-align: left;">{{$list->nama_lengkap}}</td>
	            <td style="width: 11.9302%; height: 18px; text-align: center;">{{$list->NIPD}}</td>
	            <td style="width: 12.3664%; height: 18px; text-align: center;">{{$list->NISN}}</td>
	            <td style="width: 35.7034%; height: 18px; text-align: center;">{{$list->prodi->nama}}</td>
        	</tr>
        @empty
        	@php
        		for ($x = 1; $x <= 3; $x++) {
        	@endphp
		        	<tr style="height: 18px;">
		            	<td style="width: 5.38713%; height: 18px; text-align: center;">{{$x}}</td>
		            	<td style="width: 34.6128%;"></td>
		            	<td style="width: 11.9302%; height: 18px; text-align: center;"></td>
		            	<td style="width: 12.3664%; height: 18px; text-align: center;"></td>
		            	<td style="width: 35.7034%; height: 18px; text-align: center;"></td>
		        	</tr>
        	@php
        		}
        	@endphp
        @endforelse
        
        
    </tbody>
</table>
<p align="justify">diperkenankan untuk mendapatkan pengalaman praktek kerja di tempat yang Bapak/Ibu pimpin dari tanggal <b>{{mediumdate_indo($penempatan->tgl_mulai)}}</b> hingga tanggal <b>{{mediumdate_indo($penempatan->tgl_selesai)}}</b>, pada unit kerja / bisnis yang melaksanakan pekerjaan terkait bidang {{$penempatan->PrakerinMaster->prodi->nama}}.</p>
<p align="justify">Apabila Bapak/Ibu berkenan menerima peserta didik tersebut, mohon kesediaanya untuk mengirimkan surat balasan penerimaan peserta didik kami.</p>
<p align="justify">Demikian surat permohonan ini, atas perhatian serta kerjasamanya kami ucapkan terimakasih.</p>
<p><em>Wassalamu'alaikum Wr. Wb.</em></p>
<table style="border-collapse: collapse; width: 100%; height: 147px;" border="0">
    <tbody>
        <tr style="height: 18px;">
            <td style="width: 33.3333%; height: 18px;">&nbsp;</td>
            <td style="width: 33.3333%; height: 18px;">&nbsp;</td>
            <td style="width: 33.3333%; height: 18px;"><small>Kepala,</small></td>
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
            <td style="width: 33.3333%; height: 18px;"><strong><small>{{$sekolah->tenpen->nama_lengkap}}</small></strong></td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 33.3333%; height: 18px;">&nbsp;</td>
            <td style="width: 33.3333%; height: 18px;">&nbsp;</td>
            <td style="width: 33.3333%; height: 18px;"><small>NIP. {{val($sekolah->tenpen->nip)}}</small></td>
        </tr>
    </tbody>
</table>
<p>Tembusan :</p>
<ol>
    <li>Ketua {{$sekolah->yayasan}}</li>
    <li>Ketua {{$penempatan->PrakerinMaster->prodi->nama}}</li>
    <li>Arsip</li>
</ol>