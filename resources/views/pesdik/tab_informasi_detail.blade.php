<div class="tab-pane active" id="informasi_detail" role="tabpanel">
	<div class="kt-form__body">
		<div class="kt-section kt-section--first">
			<div class="kt-section__body">
				<div class="row">
					<label class="col-xl-3"></label>
					<div class="col-lg-9 col-xl-6">
						<h3 class="kt-section__title kt-section__title-sm">Informasi Peserta Didik:</h3>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Nama:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ $pesdik->nama_lengkap }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Jenis Kelamin:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ $pesdik->jenis_kelamin }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">NIK:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ $pesdik->NIK }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">NISN:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ $pesdik->NISN }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">NIPD:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ $pesdik->NIPD }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Program Studi: </label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ $pesdik->prodi->nama }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Kelas Saat Ini: </label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder"> {{ kelas_pesdik($pesdik_id, $tapel_aktif_id) }} </span>
					</div>
				</div>	
			</div>
		</div>
		<div class="kt-section kt-section--first">
			<div class="kt-section__body">
				<div class="row">
					<label class="col-xl-3"></label>
					<div class="col-lg-9 col-xl-6">
						<h3 class="kt-section__title kt-section__title-sm">Informasi Alamat:</h3>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Alamat:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ $pesdik->alamat }} RT {{ $pesdik->rt }} / RW {{ $pesdik->rw }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Kelurahan/Desa:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ kelurahan($pesdik->kelurahan_id) }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Kecamatan:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ kecamatan($pesdik->kecamatan_id) }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Kabupaten/Kota:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ kabupaten($pesdik->kabupaten_id) }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Provinsi:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ provinsi($pesdik->provinsi_id) }}</span>
					</div>
				</div>
			</div>
		</div>
		<div class="kt-section kt-section--first">
			<div class="kt-section__body">
				<div class="row">
					<label class="col-xl-3"></label>
					<div class="col-lg-9 col-xl-6">
						<h3 class="kt-section__title kt-section__title-sm">Informasi Kontak & Media Sosial:</h3>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">No. Hp/Wa:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ val($pesdik->no_telp) }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Facebook:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ val($pesdik->facebook) }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Instagram:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ val($pesdik->instagram) }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Twitter:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ val($pesdik->twitter) }}</span>
					</div>
				</div>
			</div>
		</div>
		<div class="kt-section kt-section--first">
			<div class="kt-section__body">
				<div class="row">
					<label class="col-xl-3"></label>
					<div class="col-lg-9 col-xl-6">
						<h3 class="kt-section__title kt-section__title-sm">Informasi Orang Tua:</h3>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Nama Ayah:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ val($pesdik->nama_ayah) }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">NIK Ayah:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ val($pesdik->NIK_ayah) }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Tahun Lahir Ayah:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ val($pesdik->tahun_lahir_ayah) }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Pendidikan Ayah:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ pendidikan($pesdik->pendidikan_ayah) }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Pekerjaan Ayah:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ pekerjaan($pesdik->pekerjaan_ayah) }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Penghasilan Ayah:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ penghasilan($pesdik->penghasilan_ayah) }}</span>
					</div>
				</div>
				<!--INFORMASI IBU-->
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Nama Ibu:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ val($pesdik->nama_ibu) }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">NIK Ibu:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ val($pesdik->NIK_ibu) }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Tahun Lahir Ibu:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ val($pesdik->tahun_lahir_ibu) }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Pendidikan Ibu:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ pendidikan($pesdik->pendidikan_ibu) }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Pekerjaan Ibu:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ pekerjaan($pesdik->pekerjaan_ibu) }}</span>
					</div>
				</div>
				<div class="form-group form-group-xs row">
					<label class="col-3 col-form-label">Penghasilan Ibu:</label>
					<div class="col-9">
						<span class="form-control-plaintext kt-font-bolder">{{ penghasilan($pesdik->penghasilan_ibu) }}</span>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>