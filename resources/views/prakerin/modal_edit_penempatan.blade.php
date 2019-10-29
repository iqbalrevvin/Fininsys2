<div class="modal fade" id="edit_tempat" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Perbarui Instansi <b id="data_instansi"></b></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="kt-portlet" id="">
				<div class="edit_penempatan kt-portlet__body">
					<form class="edit_tempat kt-form kt-form--fit kt-form--label-right">
						<input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
						{{-- <input type="hidden" name="master_id" id="master_id" value="{{ $master_prakerin->id }}"> --}}
						{{-- <div class="form-group row">
							<label class="col-form-label col-lg-3 col-sm-12">Instansi/DU/DI</label>
							<div class=" col-lg-6 col-md-9 col-sm-12">
								Instansi Saat Ini : <b id="data_instansi"></b>
								<select style='width:100%' class="form-control kt-select2" id="edit_instansi" 
									name="edit_instansi">
									<option value="">Pilih & Perbarui Instansi</option>
									@forelse($instansi as $list)
										<optgroup label="{{ kabupaten($list->kabupaten_id) }}">
											@foreach($nama_instansi as $ins)
												<option value="{{ $ins->id }}">{{ $ins->nama }}</option>
											@endforeach
										</optgroup>
									@empty	
										<optgroup label="Belum Terdapat Instansi Untuk Prakerin"></optgroup>	
									@endforelse
								</select>
							</div>
						</div> --}}
						<div class="form-group row">
							<label class="col-form-label col-lg-3 col-sm-12">Pembimbing Lapangan</label>
							<div class=" col-lg-6 col-md-9 col-sm-12">
								Pembimbing Saat Ini : <b id="data_pembimbing"></b>
								<select style='width:100%' class="form-control kt-select2" 
									id="edit_pembimbing_lapangan" name="edit_pembimbing_lapangan">
								<option value="">Pilih & Perbarui Pembimbing</option>
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
								Pembimbing Akademik Saat Ini : <b id="data_pembimbing_akademik"></b>
								<select style='width:100%' class="form-control kt-select2" 
									id="edit_pembimbing_akademik" name="edit_pembimbing_akademik">
									<option value="">Pilih & Perbarui Pembimbing Akademik</option>
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
									name="tanggal_mulai" id="edit_tanggal_mulai" value="" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-3 col-sm-12">Tanggal Selesai Prakerin</label>
							<div class=" col-lg-6 col-md-9 col-sm-12">
								<input type='text' title="Tanggal Mulai Prakerin" class='form-control notfocus input_date' 
									name="tanggal_selesai" id="edit_tanggal_selesai" value="" />
							</div>
						</div>
						<div class="col-lg-12 ml-lg-auto">
							<button type="button" class="btn btn-brand btn-elevate-hover btn-pill" 
								id="simpan_edit_penempatan" value="">
								<i class="la la-save"></i> Perbarui
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