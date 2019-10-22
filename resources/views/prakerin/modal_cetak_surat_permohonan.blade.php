<div class="modal fade" id="cetak_surat_permohonan{{$list->instansi->id}}" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Cetak Surat Permohonan</b></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="kt-portlet" id="">
				<div class="edit_penempatan kt-portlet__body">
					<p>Sebelum mencetak surat permohonan, 
						<br>pastikan <a href="{{ url('admin/sekolah') }}" target="_blank"><b>Profil Sekolah</b></a> sudah dilengkapi 
					</p>
					<p>Pastikan pengaturan cetak & ukuran kertas berukuran <b>F4</b></p>
					<form class="kt-form kt-form--fit kt-form--label-right" method="get" action="{{ route('prakerin.cetak_surat_pengantar') }}" target="_blank">
						<input type="hidden" name="master_id" value="{{ $master_prakerin->id }}">
						<input type="hidden" name="penempatan_id" value="{{ $list->id }}">
						<div class="form-group row">
							<label class="col-form-label col-lg-3 col-sm-12">No. surat</label>
							<div class=" col-lg-9 col-md-12 col-sm-12">
								<input type="text" title="Nomor Surat Permohonan" class="form-control" name="nomor_surat"
								placeholder="Contoh : 070/A.4/SMK-IK/X/2019" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-3 col-sm-12">Tanggal Surat</label>
							<div class=" col-lg-9 col-md-12 col-sm-12">
								<input type='text' title="Tanggal surat Permohonan" 
									class='form-control notfocus input_date' name="tanggal_surat" 
									placeholder="Tanggal/Titimangsa surat" required autocomplete="off" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-3 col-sm-12">Lampiran</label>
							<div class=" col-lg-9 col-md-12 col-sm-12">
								<input type='text' title="Lampiran Surat" 
									class='form-control' name="lampiran_surat" 
									placeholder="Isi dengan strip (-) jika tidak ada lampiran" required autocomplete="off" />
							</div>
						</div>
						<div class="col-lg-12 ml-lg-auto">
							<button type="reset" class="btn btn-dark btn-elevate-hover btn-pill btn-sm" class="close" 
									data-dismiss="modal" aria-label="Close">
								Batal
							</button>
							<button type="submit" class="btn btn-brand btn-elevate-hover btn-pill btn-sm" 
								id="" value="">
								<i class="la la-print"></i> Cetak
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>