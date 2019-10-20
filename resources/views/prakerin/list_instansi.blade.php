@forelse ($list_instansi as $list)
	<div class="kt-notes__items" id="list">
		<div class="kt-notes__item">
			<div class="kt-notes__media">
				<span class="kt-notes__icon">
					<i class="la la-bank kt-font-brand"></i>
				</span>
			</div>
			
			<div class="kt-notes__content list_instansi">
				<div class="kt-notes__section">
					<div class="kt-notes__info" >
						<a href="javascript:;" data-id="{{ $list->id }}" data-nama="{{ $list->instansi->nama }}" class="kelola_peserta kt-notes__title">
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
									<a href="javascript:;" data-id="{{ $list->id }}" 
										data-nama="{{ $list->instansi->nama }}" 
										class="hapus_instansi kt-nav__link">
										<i class="kt-nav__link-icon flaticon2-trash"></i>
										<span class="kt-nav__link-text">Hapus</span>
									</a>
								</li>
								<li class="kt-nav__item">
									<a href="#" class="kt-nav__link" id="edit_penempatan" data-id="{{ $list->id }}">
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
					Pembimbing Lapangan : {{ gender_pembimbing($list->pembimbing_lapangan->jenis_kelamin) }} {{ $list->pembimbing_lapangan->nama }}<br>
					Pembimbing Akademik : {{ $list->tenpen->nama_lengkap }}<hr>
					<a href="#"><b>Lihat Peta</b></a> 
					| <a href="#" data-toggle="modal" data-target="#detail_instansi{{$list->id}}"><b>Detail</b></a> 
					| <a href="javascript:;" data-toggle="modal" 
						data-target="#cetak_surat_permohonan{{$list->instansi->id}}"><b>Surat Permohonan</b></a>
				</span>
			</div>

		</div>
	</div>
	{{-- STAR::MODAL CETAK SURAT PERMOHONAN --}}	
		@include('prakerin.modal_cetak_surat_permohonan')	
	{{-- END::MODAL CETAK SURAT PERMOHONAN --}}
	{{-- START:: MODAL INFORMASI INSTANSI --}}
		@include('prakerin.modal_detail_instansi')
	{{-- END:: MODAL INFORMASI INSTANSI --}}
@empty
	{{-- empty expr --}}
@endforelse
<script src="{{ asset('metronic/js/pages/crud/forms/widgets/select2.js') }}" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
	  	$("#cari_instansi").on("keyup", function() {
	    	var value = $(this).val().toLowerCase();
	    	$("#list, .list_instansi").filter(function() {
	      		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    	});
	  	});
	});
	var lang = '{{App::getLocale()}}';
    $(function () {
        $('.input_date').datepicker({
            format: 'yyyy-mm-dd',
            @if (in_array(App::getLocale(), ['ar', 'fa']))
            rtl: true,
            @endif
            language: lang
        });
    });
</script>

@push('bottom')
	

	
@endpush