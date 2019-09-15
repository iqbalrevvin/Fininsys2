@extends('crudbooster::admin_template')
@section('content')
	@php
		$pesdik_id 		= $pesdik->id;
		$tapel_aktif_id = tapel_aktif()->id; 
	@endphp
	<!--Begin:: Portlet-->
	<div class="kt-portlet">
		<div class="kt-portlet__body">
			<div class="kt-widget kt-widget--user-profile-3">
				<div class="kt-widget__top">
					<div class="kt-widget__media">
						@if($pesdik->foto == NULL)
							{{-- <div class="kt-userpic kt-userpic--lg  kt-userpic--success ">
								{!! getImgUser($pesdik->foto, $pesdik->nama_lengkap) !!}
							</div> --}}
							<img class="kt-widget__img kt-hidden-" src="{{ asset('image/'.photo_gender_pesdik($pesdik->foto, $pesdik->jenis_kelamin)) }}" alt="image">
						@else
							<img class="kt-widget__img kt-hidden-" src="{{ asset($pesdik->foto) }}" alt="image">
						@endif	
					</div>
					<div class="kt-widget__content">
						<div class="kt-widget__head">
							<div class="kt-widget__user">
								<a href="#" class="kt-widget__username">
									{{ $pesdik->nama_lengkap }}
								</a>&nbsp;
								<span class="kt-badge kt-badge--bolder kt-badge kt-badge--inline kt-badge--unified-success">
									{{ $pesdik->status_pesdik->nama }}
								</span>
								<div class="dropdown dropdown-inline kt-margin-l-5" data-toggle="kt-tooltip-" title="Change label" data-placement="right">
									<a href="#" class="btn btn-clean btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fa fa-caret-down"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-md dropdown-menu-fit dropdown-menu-right">
										<ul class="kt-nav">
											<li class="kt-nav__head">
												Pilih Status:
												<i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" 
													title="Pilih Status Peserta Didik"></i>
											</li>
											<li class="kt-nav__separator">
											</li>
											<li class="kt-nav__item">
												<a href="#" class="kt-nav__link" data-toggle="status-change" data-status="1">
													<span class="kt-nav__link-text">
														<span class="kt-badge kt-badge--unified-success kt-badge--inline kt-badge--lg kt-badge--bold">Aktif</span>
													</span>
												</a>
											</li>
											<li class="kt-nav__item">
												<a href="#" class="kt-nav__link" data-toggle="status-change" data-status="2">
													<span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-danger kt-badge--inline kt-badge--lg kt-badge--bold">Keluar</span></span>
												</a>
											</li>
											<li class="kt-nav__item">
												<a href="#" class="kt-nav__link" data-toggle="status-change" data-status="4">
													<span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-warning kt-badge--inline kt-badge--lg kt-badge--bold">Mengundurkan Diri</span></span>
												</a>
											</li>
											<li class="kt-nav__item">
												<a href="#" class="kt-nav__link" data-toggle="status-change" data-status="3">
													<span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-info kt-badge--inline kt-badge--lg kt-badge--bold">Lulus</span></span>
												</a>
											</li>
											<li class="kt-nav__item">
												<a href="#" class="kt-nav__link" data-toggle="status-change" data-status="5">
													<span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-brand kt-badge--inline kt-badge--lg kt-badge--bold">Mutasi</span></span>
												</a>
											</li>
											<li class="kt-nav__item">
												<a href="#" class="kt-nav__link" data-toggle="status-change" data-status="6">
													<span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-danger kt-badge--inline kt-badge--lg kt-badge--bold">Nonaktif</span></span>
												</a>
											</li>
											<li class="kt-nav__separator">

										</ul>
									</div>
								</div>
							</div>
							<div class="kt-widget__action">
								@if($pesdik->prodi->logo_prodi == NULL)
									<div class="kt-userpic kt-userpic--lg kt-userpic--danger">
										<span>{{ $pesdik->prodi->singkatan }}</span>
									</div>
								@else
									<img src="{{ asset($pesdik->prodi->logo_prodi) }}" alt="image" style="height: 50px;">
								@endif	
							</div>
						</div>
						<div class="kt-widget__subhead">
							<a href="#"><i class="socicon-whatsapp"></i>{{ $pesdik->no_telp }}</a>
							<a href="#"><i class="socicon-facebook"></i>{{ $pesdik->facebook }}</a>
							<a href="#"><i class="socicon-instagram"></i>{{ $pesdik->instagram }}</a>
							<a href="#"><i class="socicon-twitter"></i>{{ $pesdik->twitter }}</a>
						</div>
						<div class="kt-widget__info">
							<div class="kt-widget__desc">
								{{-- <b>{{ $pesdik->NIPD }}</b> | <b>{{ $pesdik->NISN }}</b> | <b>{{ $pesdik->NIK }}</b><br> --}}
								Asal Sekolah 	: {{ $pesdik->nama_sekolah_asal }}<br>
								Program Studi 	: {{ $pesdik->prodi->nama }}.
								<br> 
								Kelas : {{ kelas_pesdik($pesdik_id, $tapel_aktif_id) }}
							</div>
						</div>
					</div>
				</div>
				<div class="kt-widget__bottom">
					<div class="kt-widget__item">
						<div class="kt-widget__details">
							<a href="#" class="btn btn-info btn-elevate btn-pill btn-elevate-air btn-sm btn-bold" data-toggle="modal" data-target="#modal-komentar" data-backdrop="static">
							<i class="la la-print"></i> Surat Keterangan</a>&nbsp;
						</div>
						<div class="kt-widget__details">
							<a href="#" class="btn btn-info btn-elevate btn-pill btn-elevate-air btn-sm btn-bold" data-toggle="modal" data-target="#modal-komentar" data-backdrop="static">
							<i class="la la-print"></i> Transkrip Nilai</a>&nbsp;
						</div>
						<div class="kt-widget__details">
							<a href="#" class="btn btn-info btn-elevate btn-pill btn-elevate-air btn-sm btn-bold" data-toggle="modal" data-target="#modal-komentar" data-backdrop="static">
							<i class="la la-print"></i> Pengantar Prakerin</a>&nbsp;
						</div>
						<div class="kt-widget__details">
							<a href="#" class="btn btn-info btn-elevate btn-pill btn-elevate-air btn-sm btn-bold" data-toggle="modal" data-target="#modal-komentar" data-backdrop="static">
							<i class="la la-print"></i> Status Keuangan</a>&nbsp;
						</div>
					</div>
{{-- 
					<div class="kt-widget__item">
						<div class="kt-widget__icon">
							<i class="flaticon-pie-chart"></i>
						</div>
						<div class="kt-widget__details">
							<span class="kt-widget__title">Saldo Berjangka</span>
							<span class="kt-widget__value"><span>Rp. </span>585,000</span>
						</div>
					</div>
					<div class="kt-widget__item">
						<div class="kt-widget__icon">
							<i class="flaticon-file-2"></i>
						</div>
						<div class="kt-widget__details">
							<span class="kt-widget__title">7 Tugas</span>
							<a href="#" class="kt-widget__value kt-font-brand">Lihat</a>
						</div>
					</div>
					<div class="kt-widget__item">
						<div class="kt-widget__icon">
							<i class="flaticon-chat-1"></i>
						</div>
						<div class="kt-widget__details">
							<span class="kt-widget__title">78 Pesan</span>
							<a href="#" class="kt-widget__value kt-font-brand">Lihat</a>
						</div>
					</div> --}}

				</div>
			</div>
		</div>
	</div>

	<!--End:: Portlet-->
	<div class="row">
		<div class="col-md-4">

			<!--Begin:: Portlet-->
			<div class="kt-portlet kt-portlet--head-noborder">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title  kt-font-danger">
							Pengumuman Terbaru
						</h3>
					</div>
					<div class="kt-portlet__head-toolbar">
						<span class="kt-badge kt-badge--bolder kt-badge kt-badge--inline kt-badge--danger">Hari Ini</span>
					</div>
				</div>
				<div class="kt-portlet__body kt-portlet__body--fit-top">
					<div class="kt-section kt-section--space-sm">
						Fitur Pengumuman, Pengumuman terbaru akan muncul di sini tepat di profil siswa.
					</div>
					<div class="kt-section kt-section--last">
						<a href="#" class="btn btn-brand btn-sm btn-bold" data-toggle="modal" data-target="#modal-komentar" data-backdrop="static">
							<i class="flaticon2-note"></i> Komentari</a>&nbsp;
						{{-- <a href="#" class="btn btn-clean btn-sm btn-bold">Dismiss</a> --}}
					</div>
				</div>
			</div>

			<!--End:: Portlet-->
			<!--Begin:: Portlet-->
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Informasi Personal
						</h3>
					</div>
					<div class="kt-portlet__head-toolbar">
						<a href="#" class="btn btn-clean btn-sm btn-bold" data-toggle="dropdown">
							<i class="flaticon2-gear"></i> Perbarui Data
						</a>
						<div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-md">

							<!--begin::Nav-->
							<ul class="kt-nav">
								<li class="kt-nav__head">
									Perbarui Data
									<i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" 
										title="Ubah Data {{ $pesdik->nama_lengkap }}"></i>
								</li>
								<li class="kt-nav__separator"></li>
								<li class="kt-nav__item">
									<a href="{{ url('admin/peserta_didik_data_utama/edit/'.$pesdik->id) }}" class="kt-nav__link nav_block">
										<i class="kt-nav__link-icon flaticon2-user"></i>
										<span class="kt-nav__link-text">Data Utama</span>
									</a>
								</li>
								<li class="kt-nav__item">
									<a href="#" class="kt-nav__link">
										<i class="kt-nav__link-icon flaticon2-phone"></i>
										<span class="kt-nav__link-text">Data Kontak</span>
									</a>
								</li>
								<li class="kt-nav__item">
									<a href="#" class="kt-nav__link">
										<i class="kt-nav__link-icon flaticon2-avatar"></i>
										<span class="kt-nav__link-text">Data Orang Tua</span>
									</a>
								</li>
								<li class="kt-nav__item">
									<a href="#" class="kt-nav__link">
										<i class="kt-nav__link-icon flaticon2-file"></i>
										<span class="kt-nav__link-text">Lampiran Berkas</span>
									</a>
								</li>
								<li class="kt-nav__separator"></li>
							</ul>

							<!--end::Nav-->
						</div>
					</div>
				</div>
				<div class="kt-form">
					<div class="kt-portlet__body">
						<div class="form-group form-group-xs row">
							<label class="col-4 col-form-label">Nama:</label>
							<div class="col-8">
								<span class="form-control-plaintext kt-font-bolder">{{ $pesdik->nama_lengkap }}</span>
							</div>
						</div>
						<div class="form-group form-group-xs row">
							<label class="col-4 col-form-label">Jenis Kelamin:</label>
							<div class="col-8">
								<span class="form-control-plaintext kt-font-bolder">{{ $pesdik->jenis_kelamin }}</span>
							</div>
						</div>
						<div class="form-group form-group-xs row">
							<label class="col-4 col-form-label">TTL:</label>
							<div class="col-8">
								<span class="form-control-plaintext">
									<span class="kt-font-bolder">{{ $pesdik->tempat_lahir }}, {{ mediumdate_indo($pesdik->tanggal_lahir) }}</span>
								</span>
							</div>
						</div>
						<div class="form-group form-group-xs row">
							<label class="col-4 col-form-label">Registrasi Akta:</label>
							<div class="col-8">
								<span class="form-control-plaintext">
									<span class="kt-font-bolder">{{ $pesdik->registrasi_akta_lahir }}</span>
								</span>
							</div>
						</div>
						<div class="form-group form-group-xs row">
							<label class="col-4 col-form-label">NIK:</label>
							<div class="col-8">
								<span class="form-control-plaintext kt-font-bolder">{{ $pesdik->NIK }}</span>
							</div>
						</div>
						<div class="form-group form-group-xs row">
							<label class="col-4 col-form-label">NISN:</label>
							<div class="col-8">
								<span class="form-control-plaintext kt-font-bolder">{{ $pesdik->NISN }}</span>
							</div>
						</div>
						<div class="form-group form-group-xs row">
							<label class="col-4 col-form-label">NIPD:</label>
							<div class="col-8">
								<span class="form-control-plaintext kt-font-bolder">{{ $pesdik->NIPD }}</span>
							</div>
						</div>
						<div class="form-group form-group-xs row">
							<label class="col-4 col-form-label">Alamat:</label>
							<div class="col-8">
								<span class="form-control-plaintext kt-font-bolder">{{ $pesdik->alamat }}</span>
							</div>
						</div>
						<div class="form-group form-group-xs row">
							<label class="col-4 col-form-label">RT/RW:</label>
							<div class="col-8">
								<span class="form-control-plaintext kt-font-bolder">{{ $pesdik->rt }}/{{ $pesdik->rw }}</span>
							</div>
						</div>
						<div class="form-group form-group-xs row">
							<label class="col-4 col-form-label">Kelurahan:</label>
							<div class="col-8">
								<span class="form-control-plaintext kt-font-bolder">{{ kelurahan($pesdik->kelurahan_id) }}</span>
							</div>
						</div>
						<div class="form-group form-group-xs row">
							<label class="col-4 col-form-label">Kecamatan:</label>
							<div class="col-8">
								<span class="form-control-plaintext kt-font-bolder">{{ kecamatan($pesdik->kecamatan_id) }}</span>
							</div>
						</div>
						<div class="form-group form-group-xs row">
							<label class="col-4 col-form-label">Kabupaten:</label>
							<div class="col-8">
								<span class="form-control-plaintext kt-font-bolder">{{ kabupaten($pesdik->kabupaten_id) }}</span>
							</div>
						</div>
						<div class="form-group form-group-xs row">
							<label class="col-4 col-form-label">Tpt Tinggal:</label>
							<div class="col-8">
								<span class="form-control-plaintext kt-font-bolder">{{ tempat_tinggal($pesdik->tempat_tinggal) }}</span>
							</div>
						</div>
						<div class="form-group form-group-xs row">
							<label class="col-4 col-form-label">Anak Ke:</label>
							<div class="col-8">
								<span class="form-control-plaintext kt-font-bolder">
									{{ value($pesdik->anak_ke) }}
								</span>
							</div>
						</div>
						<div class="form-group form-group-xs row">
							<label class="col-4 col-form-label">Penerima KIP:</label>
							<div class="col-8">
								<span class="form-control-plaintext kt-font-bolder">
									{{ $pesdik->penerima_kip }}
									@if($pesdik->no_kip != NULL)
									| {{ $pesdik->no_kip }}
									@endif
								</span>
							</div>
						</div>
						<div class="form-group form-group-xs row">
							<label class="col-4 col-form-label">Penerima KPS:</label>
							<div class="col-8">
								<span class="form-control-plaintext kt-font-bolder">
									{{ $pesdik->penerima_kps }}
									@if($pesdik->no_kps != NULL)
									| {{ $pesdik->no_kps }}
									@endif
								</span>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!--End:: Portlet-->

		</div>
		@include('pesdik.profil_tab')
	</div>
	<div class="modal fade" id="modal-komentar" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Komentar Pengumuman</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="kt-portlet kt-portlet--responsive-mobile" id="kontenTambahSiswa">
			
					<div class="kt-portlet__body">
						<form>
						<div class="form-group">
							<textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Tulis Komentar Disini!"></textarea>
						</div>
						<div class="row">
							<div class="col">
								<a href="#" class="btn btn-label-brand btn-bold">Kirim</a>
								{{-- <a href="#" class="btn btn-clean btn-bold">Cancel</a> --}}
							</div>
						</div>
					</form>
					<div class="kt-separator kt-separator--space-lg kt-separator--border-dashed"></div>
					<div class="kt-notes kt-scroll kt-scroll--pull" data-scroll="true" style="height: 700px;">
						<div class="kt-notes__items">
							<div class="kt-notes__item">
								<div class="kt-notes__media">
									<img class="kt-hidden-" src="{{ asset('image/pesdik-l.png') }}" alt="image">
									<span class="kt-notes__icon kt-font-boldest kt-hidden">
										<i class="flaticon2-cup"></i>
									</span>
									<h3 class="kt-notes__user kt-font-boldest kt-hidden">
										N S
									</h3>
								</div>
								<div class="kt-notes__content">
									<div class="kt-notes__section">
										<div class="kt-notes__info">
											<a href="#" class="kt-notes__title">
												Ucup Saprudin
											</a>
											<span class="kt-notes__desc">
												20 Juni 2019 | 16:00:20
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
															<i class="kt-nav__link-icon flaticon2-delete"></i>
															<span class="kt-nav__link-text">Hapus</span>
														</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<span class="kt-notes__body">
										Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.
									</span>
								</div>
							</div>
							<div class="kt-notes__item">
								<div class="kt-notes__media">
									<img class="kt-hidden-" src="{{ asset('image/pesdik-p.png') }}" alt="image">
									<span class="kt-notes__icon kt-font-boldest kt-hidden">
										<i class="flaticon2-cup"></i>
									</span>
									<h3 class="kt-notes__user kt-font-boldest kt-hidden">
										N S
									</h3>
								</div>
								<div class="kt-notes__content">
									<div class="kt-notes__section">
										<div class="kt-notes__info">
											<a href="#" class="kt-notes__title">
												Neneng Manis
											</a>
											<span class="kt-notes__desc">
												18 Juni 2019 | 16:00:20
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
															<i class="kt-nav__link-icon flaticon2-delete"></i>
															<span class="kt-nav__link-text">Hapus</span>
														</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<span class="kt-notes__body">
										Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.
									</span>
								</div>
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
@endsection
