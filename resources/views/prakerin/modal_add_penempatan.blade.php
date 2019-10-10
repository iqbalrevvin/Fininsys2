<div class="modal fade" id="add_tempat" role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Tambah Tempat Prakerin</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="kt-portlet kt-portlet--responsive-mobile" id="kontenTambahSiswa">
				<div class="insert_penempatan kt-portlet__body">
					<form class="add_tempat kt-form kt-form--fit kt-form--label-right">
						<input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
						<input type="hidden" name="master_id" id="master_id" value="{{ $master_prakerin->id }}">
						<div class="form-group row">
							<label class="col-form-label col-lg-3 col-sm-12">Instansi/DU/DI</label>
							<div class=" col-lg-6 col-md-9 col-sm-12">
								<select style='width:100%' class="form-control kt-select2" 
									id="instansi" name="instansi">
									<option value="">Pilih Instansi</option>
									@forelse($instansi as $list)
										<optgroup label="{{ kabupaten($list->kabupaten_id) }}">
											@php
												$nama_instansi = App\Models\Prakerin\Instansi::where('kabupaten_id', $list->kabupaten_id)->get();
											@endphp
											@foreach($nama_instansi as $ins)
												<option value="{{ $ins->id }}">{{ $ins->nama }}</option>
											@endforeach
										</optgroup>
									@empty	
										<optgroup label="Belum Terdapat Instansi Untuk Prakerin"></optgroup>	
									@endforelse
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-3 col-sm-12">Pembimbing Lapangan</label>
							<div class=" col-lg-6 col-md-9 col-sm-12">
								<select style='width:100%' class="form-control kt-select" id="pembimbing_lapangan" name="pembimbing_lapangan">
								<option value="">Pilih Pembimbing Lapangan</option>
									@forelse($pembimbing_lapangan as $list)
										<option value="{{ $list->id }}">{{ $list->nama }}</option>
									@empty
										<option value="">Belum Terdapat Pembimbing Lapangan</option>
									@endforelse
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-3 col-sm-12">Pembimbing Akademik</label>
							<div class=" col-lg-6 col-md-9 col-sm-12">
								<select style='width:100%' class="form-control kt-select" id="pembimbing_akademik" name="pembimbing_akademik">
									<option value="">Pilih Pembimbing Akademik</option>
									@forelse($pembimbing_akademik as $list)
										<option value="{{ $list->id }}">{{ $list->nama_lengkap }} | {{ $list->niy_nigk }}</option>
									@empty
										<option value="">Belum Ada Data Tenaga Pendidik</option>
									@endforelse
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-3 col-sm-12">Tanggal Mulai Prakerin</label>
							<div class=" col-lg-6 col-md-9 col-sm-12">
								<input type='text' title="Tanggal Mulai Prakerin" class='form-control notfocus input_date' 
									name="tanggal_mulai" id="tanggal_mulai" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-3 col-sm-12">Tanggal Selesai Prakerin</label>
							<div class=" col-lg-6 col-md-9 col-sm-12">
								<input type='text' title="Tanggal Mulai Prakerin" class='form-control notfocus input_date' 
									name="tanggal_selesai" id="tanggal_selesai" />
							</div>
						</div>
						<div class="col-lg-12 ml-lg-auto">
							<button type="button" class="btn btn-success btn-elevate-hover btn-pill" id="insert_penempatan">
								<i class="la la-save"></i> Simpan
							</button>
							<button type="reset" class="btn btn-dark btn-elevate-hover btn-pill" class="close" 
									data-dismiss="modal" aria-label="Close">
								Batal
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>