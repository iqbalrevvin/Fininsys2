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
						<a href="#" id="{{ $list->prakerin_instansi_id }}" class="kelola_peserta kt-notes__title">
							{{ nama_instansi($list->prakerin_instansi_id) }}
						</a>
						{{-- <span class="kt-notes__desc">
							9:30AM 16 June, 2015
						</span> --}}
						<span class="kt-badge kt-badge--brand kt-badge--inline">
							<small>
								{{ bidang_instansi($list->data_instansi($list->prakerin_instansi_id)->prakerin_bidang_usaha_id) }}
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
									<a href="#" class="kt-nav__link">
										<i class="kt-nav__link-icon flaticon2-trash"></i>
										<span class="kt-nav__link-text">Hapus</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<span class="kt-notes__body">
					Tgl Mulai : {{ mediumdate_indo($list->tgl_mulai) }}<br>
					Tgl Selesai : {{ mediumdate_indo($list->tgl_selesai) }}<br>
					Pembimbing Lapangan : {{ $list->data_pembimbing_lapangan($list->prakerin_pembimbing_lapangan_id)->nama }}<br>
					Pembimbing Akademik : {{ $list->data_pembimbing_akademik($list->tenpen_id)->nama_lengkap }}<hr>
					<a href="#" class="kt-font-brand">Lihat Peta</a> | <a href="#" class="kt-font-brand">Detail</a>
				</span>
			</div>
		</div>
	</div>
@empty
	{{-- empty expr --}}
@endforelse