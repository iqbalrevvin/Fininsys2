<div class="modal fade" id="detail_peserta{{$peserta->id}}" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Detail Informasi</b></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="kt-portlet kt-portlet--responsive-mobile" id="">
				<div class="edit_penempatan kt-portlet__body">
					<p>Detail informasi dari {{$peserta->nama_lengkap}}</p>
					<table style="border-collapse: collapse; width: 100%; height: 108px;" border="0">
					    <tbody>
					        <tr style="height: 18px;">
					            <td style="width: 33.3333%; height: 18px;">Nama Peserta</td>
					            <td style="width: 1.70844%; height: 18px;">:</td>
					            <td style="width: 64.9583%; height: 18px;"><b>{{$peserta->nama_lengkap}}</b></td>
					        </tr>
					        <tr style="height: 18px;">
					            <td style="width: 33.3333%; height: 18px;">NIK</td>
					            <td style="width: 1.70844%; height: 18px;">:</td>
					            <td style="width: 64.9583%; height: 18px;"><b>{{$peserta->NIK}}</b></td>
					        </tr>
					        <tr style="height: 18px;">
					            <td style="width: 33.3333%; height: 18px;">NISN</td>
					            <td style="width: 1.70844%; height: 18px;">:</td>
					            <td style="width: 64.9583%; height: 18px;"><b>{{$peserta->NISN}}</b></td>
					        </tr>
					        <tr style="height: 18px;">
					            <td style="width: 33.3333%; height: 18px;">NIPD/NIS</td>
					            <td style="width: 1.70844%; height: 18px;">:</td>
					            <td style="width: 64.9583%; height: 18px;"><b>{{$peserta->NIPD}}</b></td>
					        </tr>
					        <tr style="height: 18px;">
					            <td style="width: 33.3333%; height: 18px;">Tempat Lahir</td>
					            <td style="width: 1.70844%; height: 18px;">:</td>
					            <td style="width: 64.9583%; height: 18px;"><b>{{$peserta->tempat_lahir}}</b></td>
					        </tr>
					        <tr style="height: 18px;">
					            <td style="width: 33.3333%; height: 18px;">Tanggal Lahir</td>
					            <td style="width: 1.70844%; height: 18px;">:</td>
					            <td style="width: 64.9583%; height: 18px;"><b>{{mediumdate_indo($peserta->tanggal_lahir)}}</b></td>
					        </tr>
					        <tr>
					            <td style="width: 33.3333%;">Alamat</td>
					            <td style="width: 1.70844%;">:</td>
					            <td style="width: 64.9583%;"><b>{{$peserta->alamat}} RT {{$peserta->rt}}/RW {{$peserta->rw}}</b></td>
					        </tr>
					        <tr style="height: 18px;">
					            <td style="width: 33.3333%; height: 18px;">Kelurahan</td>
					            <td style="width: 1.70844%; height: 18px;">:</td>
					            <td style="width: 64.9583%; height: 18px;"><b>{{kelurahan($peserta->kelurahan_id)}}</b></td>
					        </tr>
					        <tr style="height: 18px;">
					            <td style="width: 33.3333%; height: 18px;">Kecamatan</td>
					            <td style="width: 1.70844%; height: 18px;">:</td>
					            <td style="width: 64.9583%; height: 18px;"><b>{{kecamatan($peserta->kecamatan_id)}}</b></td>
					        </tr>
					        <tr style="height: 18px;">
					            <td style="width: 33.3333%; height: 18px;">Kabupaten</td>
					            <td style="width: 1.70844%; height: 18px;">:</td>
					            <td style="width: 64.9583%; height: 18px;"><b>{{kabupaten($peserta->kabupaten_id)}}</b></td>
					        </tr>
					        <tr>
					            <td style="width: 33.3333%;">Provinsi</td>
					            <td style="width: 1.70844%;">:</td>
					            <td style="width: 64.9583%;"><b>{{provinsi($peserta->provinsi_id)}}</b></td>
					        </tr>
					        <tr>
					            <td style="width: 33.3333%;">No.Telp/WA</td>
					            <td style="width: 1.70844%;">:</td>
					            <td style="width: 64.9583%;"><b>{{telp($peserta->no_telp)}}</b></td>
					        </tr>
					    </tbody>
					</table>				
				</div>
			</div>
		</div>
	</div>
</div>