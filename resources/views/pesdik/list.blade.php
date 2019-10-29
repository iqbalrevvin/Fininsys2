@extends('crudbooster::admin_template')
@section('content')

<div class="kt-portlet ">
	<div class="kt-section__content kt-margin-t-10 kt-section__content--solid-- mx-3 mb-3">
		<div class="kt-searchbar">
			<form class="input-group input-group" method="GET">
				<div class="input-group-prepend" >
					<span class="input-group-text" id="basic-addon1">
						<i class="flaticon-search"></i>
					</span>
				</div>
				<input type="text" name="SearchPesdik" class="form-control" placeholder="Cari Peserta Didik (Tekan Enter Untuk Mencari!)" aria-describedby="basic-addon1" value="{{ $pencarian }}">
				@if($pencarian != NULL)
					<a href="{{ url('admin/peserta-didik/list') }}" class="btn btn-label-danger btn-upper nav_block">
						Reset Pencarian
					</a>
				@endif
			</form>
		</div>
	</div>
	<div class="kt-portlet__body kt-shape-bg-color-2">							
		<div class="row">
		@forelse($pesdik as $list)
	    	<div class="col-sm-3">
			<!--Begin::Portlet-->
				<div class="kt-portlet kt-portlet--height-fluid">
					<div class="kt-portlet__head kt-portlet__head--noborder">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
							</h3>
						</div>
						<div class="kt-portlet__head-toolbar">
							<a href="#" class="btn btn-icon" data-toggle="dropdown">
								<i class="flaticon-more-1 kt-font-brand"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__item">
										<a href="{{ url('admin/peserta_didik_data_utama/edit/'.$list->id) }}" class="kt-nav__link nav_block">
											<i class="kt-nav__link-icon flaticon2-edit"></i>
											<span class="kt-nav__link-text">Data Utama</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="{{ url('admin/peserta_didik_data_ortu/edit/'.$list->id) }}" class="kt-nav__link nav_block">
											<i class="kt-nav__link-icon flaticon2-avatar"></i>
											<span class="kt-nav__link-text">Orang Tua</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="{{ url('admin/peserta_didik_data_kontak/edit/'.$list->id) }}" class="kt-nav__link nav_block">
											<i class="kt-nav__link-icon flaticon2-phone"></i>
											<span class="kt-nav__link-text">Kontak</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="{{ url('admin/peserta_didik_lampiran_berkas/edit/'.$list->id) }}" class="kt-nav__link nav_block">
											<i class="kt-nav__link-icon flaticon2-file"></i>
											<span class="kt-nav__link-text">File Berkas</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link {{-- nav_block --}}">
											<i class="kt-nav__link-icon flaticon2-settings"></i>
											<span class="kt-nav__link-text">Akun</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="kt-portlet__body">
						<!--begin::Widget -->
						<div class="kt-widget kt-widget--user-profile-2">
							<div class="kt-widget__head">
								<div class="kt-widget__media">
									@if($list->foto == NULL)
										{{-- <div class="kt-widget__pic kt-widget__pic--info kt-font-danger kt-font-boldest">
											{!! getImgUser($list->foto, $list->nama_lengkap) !!}
										</div> --}}
										<img class="kt-widget__img kt-hidden-" src="{{ asset('image/'.photo_gender_pesdik($list->foto, $list->jenis_kelamin)) }}" alt="image">
									@else
										<img class="kt-widget__img kt-hidden-" src="{{ asset($list->foto) }}" alt="image">
									@endif						
								</div>
								<div class="kt-widget__info">
									<a href="{{ route('pesdik.profil', ['pesdik' => $list->id]) }}" class="kt-widget__username nav_block">
										{{ cut_name($list->nama_lengkap) }}
										{{-- {{ $list->nama_lengkap }} --}}
									</a>
									<span class="kt-widget__desc">
										{{ $list->prodi->singkatan }} | 
										@php
											$pesdik_id = $list->id;
											$tapel_aktif_id = tapel_aktif()->id;
										@endphp
										{{ kelas_pesdik($pesdik_id, $tapel_aktif_id) }}
										{{-- {{ kelas_pesdik($list->id, tapel_aktif()->id) }} --}}
								</div>
							</div>
							<div class="kt-widget__body">
							<div class="kt-widget__action text-right">
								<a href="#" class="btn btn-icon btn-circle btn-label-success">
									<i class="socicon-whatsapp"></i>
								</a>
								<a href="#" class="btn btn-icon btn-circle btn-label-facebook">
									<i class="socicon-facebook"></i>
								</a>
								<a href="#" class="btn btn-icon btn-circle btn-label-danger">
									<i class="socicon-instagram"></i>
								</a>
								<a href="#" class="btn btn-icon btn-circle btn-label-twitter">
									<i class="socicon-twitter"></i>
								</a>
							</div>
							<div class="kt-widget__item">
								<div class="kt-widget__contact">
									<span class="kt-widget__label">NIK:</span>
									<a href="#" class="kt-widget__data">{{ val($list->NIK) }}</a>
								</div>
								<div class="kt-widget__contact">
									<span class="kt-widget__label">NISN:</span>
									<a href="#" class="kt-widget__data">{{ val($list->NISN) }}</a>
								</div>
								<div class="kt-widget__contact">
									<span class="kt-widget__label">NIPD:</span>
									<span class="kt-widget__data">{{ val($list->NIPD) }}</span>
								</div>
							</div>
						</div>
						<div class="kt-widget__footer">
							<a href="{{ route('pesdik.profil', ['pesdik' => $list->id]) }}" 
								class="btn btn-label-primary btn-lg btn-upper nav_block">
								Lihat Profil
							</a>
						</div>
					</div>

						<!--end::Widget -->
				</div>
			</div>
				<!--End::Portlet-->
		</div>
		@empty
	    	<p>Peserta Didik Tidak Ditemukan</p>
		@endforelse
		</div>
	</div>
	<div class="kt-portlet__foot">
		<div class="row align-items-center">
			{{ $pesdik->links() }}
		</div>
	</div>
</div>
		
@endsection