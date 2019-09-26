<div class="kt-portlet kt-portlet--height-fluid">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<span class="kt-portlet__head-icon"><i class="flaticon-users kt-font-success"></i></span>
			<h3 class="kt-portlet__head-title kt-font-success">{{ $nama_instansi }}</h3> &nbsp; <small>({{ $list_peserta->count() }} Peserta)</small>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-actions">
			<button type="button" class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air btn-circle btn-icon btn-sm"
				title="Tambahkan Peserta Prakerin">
				<img src="{{ asset('metronic/media/icons/svg/Communication/Add-user.svg') }}"/>
			</button>
			<button type="button" class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air btn-circle btn-icon btn-sm"
				title="Informasi">
				<img src="{{ asset('metronic/media/icons/svg/Code/Info-circle.svg') }}"/>
			</button>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		<div class="kt-portlet__content">
			<div class="kt-notes kt-scroll kt-scroll--pull" data-scroll="true" style="height: 500px;">
				@forelse($list_peserta as $peserta)
					<div class="kt-notes__items">
						<div class="kt-notes__item" style="padding: 0 0 20px 45px;">
							<div class="kt-notes__media">
								@if($peserta->foto == NULL)
										{{-- <div class="kt-widget__pic kt-widget__pic--info kt-font-danger kt-font-boldest">
											{!! getImgUser($list->foto, $list->nama_lengkap) !!}
										</div> --}}
										<img class="kt-widget__img kt-hidden-" src="{{ asset('image/'.photo_gender_pesdik($peserta->foto, $peserta->jenis_kelamin)) }}" alt="image">
									@else
										<img class="kt-widget__img kt-hidden-" src="{{ asset($peserta->foto) }}" alt="image">
									@endif
							</div>
							<div class="kt-notes__content">
								<div class="kt-notes__section">
									<div class="kt-notes__info">
										<a href="#" class="kt-notes__title">
											{{ $peserta->nama_lengkap }}
										</a>
										{{-- <span class="kt-notes__desc">
											9:30AM 16 June, 2015
										</span> --}}
										<span class="kt-badge kt-badge--success kt-badge--inline"><small>{{ $peserta->NIPD }}</small></span>
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
									<a href="#" class="kt-font-success">Lihat Profil</a> | <a href="#" class="kt-font-success">Detail</a>
								</span>
							</div>
						</div>
					</div>
				@empty
					<b class="text-danger">Belum ada peserta</b>
				@endforelse
			</div>
		</div>
	</div>
</div>