<div class="modal fade" id="detail_instansi{{$list->id}}" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Detail Informasi</b></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="kt-portlet kt-portlet--responsive-mobile" id="">
				<div class="edit_penempatan kt-portlet__body">
					<p>Detail informasi dari instansi {{$list->instansi->nama}}</p>
					<table style="border-collapse: collapse; width: 100%; height: 108px;" border="0">
					    <tbody>
					        <tr style="height: 18px;">
					            <td style="width: 33.3333%; height: 18px;">Nama Instansi</td>
					            <td style="width: 1.70844%; height: 18px;">:</td>
					            <td style="width: 64.9583%; height: 18px;"><b>{{$list->instansi->nama}}</b></td>
					        </tr>
					        <tr style="height: 18px;">
					            <td style="width: 33.3333%; height: 18px;">Bidang Usaha</td>
					            <td style="width: 1.70844%; height: 18px;">:</td>
					            <td style="width: 64.9583%; height: 18px;"><b>{{$list->instansi->bidang_usaha->nama}}</b></td>
					        </tr>
					        <tr style="height: 18px;">
					            <td style="width: 33.3333%; height: 18px;">Alamat</td>
					            <td style="width: 1.70844%; height: 18px;">:</td>
					            <td style="width: 64.9583%; height: 18px;"><b>{{$list->instansi->alamat}}</b></td>
					        </tr>
					        <tr style="height: 18px;">
					            <td style="width: 33.3333%; height: 18px;">Kelurahan</td>
					            <td style="width: 1.70844%; height: 18px;">:</td>
					            <td style="width: 64.9583%; height: 18px;"><b>{{kelurahan($list->instansi->kelurahan_id)}}</b></td>
					        </tr>
					        <tr style="height: 18px;">
					            <td style="width: 33.3333%; height: 18px;">Kecamatan</td>
					            <td style="width: 1.70844%; height: 18px;">:</td>
					            <td style="width: 64.9583%; height: 18px;"><b>{{kecamatan($list->instansi->kecamatan_id)}}</b></td>
					        </tr>
					        <tr style="height: 18px;">
					            <td style="width: 33.3333%; height: 18px;">Kabupaten</td>
					            <td style="width: 1.70844%; height: 18px;">:</td>
					            <td style="width: 64.9583%; height: 18px;"><b>{{kabupaten($list->instansi->kabupaten_id)}}</b></td>
					        </tr>
					        <tr>
					            <td style="width: 33.3333%;">Provinsi</td>
					            <td style="width: 1.70844%;">:</td>
					            <td style="width: 64.9583%;"><b>{{provinsi($list->instansi->provinsi_id)}}</b></td>
					        </tr>
					        <tr>
					            <td style="width: 33.3333%;">Kode Pos</td>
					            <td style="width: 1.70844%;">:</td>
					            <td style="width: 64.9583%;"><b>{{$list->instansi->kode_pos}}</b></td>
					        </tr>
					        <tr>
					            <td style="width: 33.3333%;">No. Telp</td>
					            <td style="width: 1.70844%;">:</td>
					            <td style="width: 64.9583%;"><b>{{telp($list->instansi->no_telp)}}</b></td>
					        </tr>
					    </tbody>
					</table>				
				</div>
			</div>
		</div>
	</div>
</div>