<div class="kt-portlet__body">
	<!--begin: Search Form -->
	<div class="kt-form kt-form--label-right">
		<div class="row align-items-center">
			<div class="col-xl-8 order-2 order-xl-1">
				<div class="row align-items-center">
					<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
						<div class="kt-form__group kt-form__group--inline">
							<div class="kt-form__label">
								<label>Wali Kelas:</label>
							</div>
							<div class="kt-form__control pilih_wali_kelas">
								<select class="form-control kt-select2" id="pilih_wali_kelas">
									@if ($rombel->tenpen_id == NULL)
										<option value="">Pilih Wai Kelas</option>
									@else
										<option value="">{{ $rombel->tenpen->nama_lengkap }}</option>
									@endif
									@forelse ($tenpen as $tenpen)
										<option value="{{ $tenpen->id }}">{{ $tenpen->nama_lengkap }}</option>
									@empty
										<option value="">Tenaga Pendidik Belum Ada</option>
									@endforelse
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
						<div class="kt-input-icon kt-input-icon--left">
							<input type="text" class="form-control" placeholder="Cari Siswa di Kelas {{-- {{ $rombel->kelas->nama }} --}} . . ." 
								id="generalSearch">
							<span class="kt-input-icon__icon kt-input-icon__icon--left">
								<span><i class="la la-search"></i></span>
							</span>
						</div>
					</div>
					
				</div>
			</div>

		</div>
	</div>
	<!--end: Search Form -->
</div>
<div class="kt-portlet__body kt-portlet__body--fit">
	<!--begin: Datatable -->
	<table class="konten-siswa" id="" width="100%">
		<thead>
			<tr>
				<th title="Field #1">Foto</th>
				<th title="Field #2">Nama</th>
				<th title="Field #3">Jenis Kelamin</th>
				<th title="Field #4">NIS/NIPD</th>
				<th title="Field #5">NISN</th>
				<th title="Field #6">Program Studi</th>
				<th title="Field #7">Status</th>
				<th title="Field #8">Hapus</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($peserta_rombel->pesdik as $peserta)
				<tr>
					<td >
						<span class="kt-userpic kt-userpic--circle kt-userpic--info kt-margin-r-5 kt-margin-t-5">
							{!! getImgUser($peserta->foto, $peserta->nama_lengkap) !!}
						</span>
					</td>
					<td><span id="nama_siswa{{ $peserta->id }}">
						<b><a href="{{ route('pesdik.profil', ['pesdik' => $peserta->id]) }}">{{ $peserta->nama_lengkap }}</a></b></span>
					</td>
					<td>{{ $peserta->jenis_kelamin }}</td>
					<td>{{ $peserta->NIPD }}</td>
					<td>{{ $peserta->NISN }}</td>
					<td>{{ $peserta->prodi->nama }}</td>
					<td>{{ $peserta->status_pesdik_id }}</td>
					<td>
						{{-- <i id="loadKeluarKelas{{ $peserta->id }}"></i> --}}
						<button title='Keluarkan {{ $peserta->nama_lengkap }} Siswa Dari Kelas' id="btnKeluarKelas" 
							data-nama="{{ $peserta->nama_lengkap }}" data-id="{{ $peserta->id }}" data-rombel="{{ $rombel->id }}"
							class="btn btn-outline-danger btn-elevate btn-circle btn-icon btn-delete btnKeluarKelas{{ $peserta->id }}">
        					<i class="flaticon-delete"></i>
    					</button>
    					<button id="loadKeluarKelas{{ $peserta->id }}" 
    						class="btn btn-danger btn-icon btn-circle kt-spinner kt-spinner--center kt-spinner--sm kt-spinner--light" 
    						style="display:none;">
    					</button>
    					
    				</td>
				</tr>
			@endforeach
			
		</tbody>
	</table>

	<!--end: Datatable -->
</div>

@push('bottom')

@endpush