@forelse ($list_instansi as $list)
	<div class="kt-notes__items">
		<div class="kt-notes__item">
			<div class="kt-notes__media">
				<span class="kt-notes__icon">
					<i class="la la-bank kt-font-brand"></i>
				</span>
			</div>
			<div class="kt-notes__content">
				<div class="kt-notes__section">
					<div class="kt-notes__info">
						<a href="#" data-id="{{ $list->id }}" data-nama="{{ $list->instansi->nama }}" class="kelola_peserta kt-notes__title">
							{{-- {{ nama_instansi($list->prakerin_instansi_id) }} --}}
							{{ $list->instansi->nama }}
						</a>
						{{-- <span class="kt-notes__desc">
							9:30AM 16 June, 2015
						</span> --}}
						<span class="kt-badge kt-badge--brand kt-badge--inline">
							<small>
								{{ $list->instansi->bidang_usaha->nama }}
							</small>
						</span>
					</div>
					<div class="kt-notes__dropdown">
						<a href="#" class="btn btn-sm btn-icon-md btn-icon" data-toggle="dropdown">
							<i class="flaticon-more-1 kt-font-brand"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<ul class="kt-nav">
								<li class="kt-nav__item">
									<a href="#" data-id="{{ $list->id }}" data-nama="{{ $list->instansi->nama }}" class="hapus_instansi kt-nav__link">
										<i class="kt-nav__link-icon flaticon2-trash"></i>
										<span class="kt-nav__link-text">Hapus</span>
									</a>
								</li>
								<li class="kt-nav__item">
									<a href="#" class="kt-nav__link">
										<i class="kt-nav__link-icon flaticon2-edit"></i>
										<span class="kt-nav__link-text">Edit</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<span class="kt-notes__body">
					Tgl Mulai : {{ mediumdate_indo($list->tgl_mulai) }}<br>
					Tgl Selesai : {{ mediumdate_indo($list->tgl_selesai) }}<br>
					Pembimbing Lapangan :{{ $list->pembimbing_lapangan->nama }}<br>
					Pembimbing Akademik : {{ $list->tenpen->nama_lengkap }}<hr>
					<a href="#" class="kt-font-brand">Lihat Peta</a> | <a href="#" class="kt-font-brand">Detail</a>
				</span>
			</div>
		</div>
	</div>
@empty
	{{-- empty expr --}}
@endforelse