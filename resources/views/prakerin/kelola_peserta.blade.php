@extends('crudbooster::admin_template')
@section('content')
	<div class="alert alert-light alert-elevate" role="alert">
			@if($master_prakerin->rombel->kelas->prodi->logo_prodi == NULL)
				<div class="kt-userpic kt-userpic--lg kt-userpic--danger">
					<span>{{ $master_prakerin->rombel->kelas->prodi->singkatan }}</span>
				</div>
			@else
				<img class="kt-widget__img kt-hidden-" src="{{ asset($master_prakerin->rombel->kelas->prodi->logo_prodi) }}" alt="image" style="height: 50px;">
			@endif	
			&nbsp;
		<div class="alert-text">
			{{-- Kelola rombel adalah pengelolaan rombongan belajar siswa yang terdapat pada rombel 
			<b>{{ $rombel->kelas->nama }}</b> Tahun Ajaran <b>{{ $rombel->tahun_ajaran->nama }}</b> --}}
			Kelola Peserta Prakerin Periode {{ $master_prakerin->TahunAjaran->nama }}<br>
			<small>Peserta Didik Program Studi <b>{{ $master_prakerin->rombel->kelas->nama }}</b> yang akan tampil pada penambahan peserta prakerin</small>
			<br>
			<a href="{{ CRUDBooster::adminPath('prakerin_master') }}" class="nav_block">Kembali Ke Daftar Master Prakerin</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<!--begin::Portlet-->
			<div class="data-instansi kt-portlet kt-portlet--height-fluid">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon"><i class="flaticon-suitcase kt-font-brand"></i></span>
						<h3 class="kt-portlet__head-title kt-font-brand">Instansi</h3> &nbsp; 
						<span>(<span id="count_instansi">{{ $list_instansi->count() }}</span> Instansi)</span>
					</div>
					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-actions">
						<button type="button" class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air btn-circle btn-icon btn-sm"
							title="Tambahkan Instansi" data-toggle="modal" data-target="#add_tempat" data-backdrop="static">
							<img src="{{ asset('metronic/media/icons/svg/Code/plus.svg') }}"/>
						</button>
						<button type="button" class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air btn-circle btn-icon btn-sm">
							<img src="{{ asset('metronic/media/icons/svg/Code/Info-circle.svg') }}"/>
						</button>
						</div>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="kt-portlet__content">
						<div class="kt-notes kt-scroll kt-scroll--pull" data-scroll="true" style="height: 500px;">
							<div id="show_instansi">
				                <div class="kt-blockui text-justify">
				                    <span>
				                        <div class="kt-loader kt-loader--brand"></div>
				                    </span>
				                    <b>Memuat Data Instansi . . .</b>
				                </div>
							</div>		
						</div>
					</div>
				</div>
			</div>

			<!--end::Portlet-->
		</div>
		<div class="col-md-6">
			<!--begin::Portlet-->
				<div id="konten_list_peserta"></div>
				<div id="load_list_peserta"><b>Klik/Pilih Nama Instansi/DU/DI untuk melihat data peserta</b></div>
			<!--end::Portlet-->
		</div>
	</div>
	<div class="modal fade" id="add_tempat" role="dialog" aria-labelledby="" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Tambah Tempat Prakerin</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="kt-portlet kt-portlet--responsive-mobile" id="kontenTambahSiswa">
					<div class="insert_penempatan kt-portlet__body">
						<form class="add_tempat kt-form kt-form--fit kt-form--label-right">
							<input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
							<input type="hidden" name="master_id" id="master_id" value="{{ $master_prakerin->id }}">
							<div class="form-group row">
								<label class="col-form-label col-lg-3 col-sm-12">Instansi/DU/DI</label>
								<div class=" col-lg-6 col-md-9 col-sm-12">
									<select style='width:100%' class="form-control kt-select2" id="instansi" name="instansi">
										<option value=""></option>
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
							</div>
							<div class="form-group row">
								<label class="col-form-label col-lg-3 col-sm-12">Pembimbing Lapangan</label>
								<div class=" col-lg-6 col-md-9 col-sm-12">
									<select style='width:100%' class="form-control kt-select2" id="pembimbing_lapangan" name="pembimbing_lapangan">
									<option value=""></option>
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
									<select style='width:100%' class="form-control kt-select2" id="pembimbing_akademik" name="pembimbing_akademik">
										<option></option>
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
										name="tanggal_mulai" id="tanggal_mulai" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-lg-3 col-sm-12">Tanggal Selesai Prakerin</label>
								<div class=" col-lg-6 col-md-9 col-sm-12">
									<input type='text' title="Tanggal Mulai Prakerin" class='form-control notfocus input_date' 
										name="tanggal_selesai" id="tanggal_selesai" />
								</div>
							</div>
							<div class="col-lg-12 ml-lg-auto">
								<button type="button" class="btn btn-success btn-elevate-hover btn-pill" id="insert_penempatan">
									<i class="la la-save"></i> Simpan
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
@endsection

@push('bottom')
	<script type="text/javascript">
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
		$('#add_tempat').on('shown.bs.modal', function () {
	        $('#instansi').select2({
	            placeholder: "Pilih Instansi/DU/DI",
	            allowClear: true
	        });
	        $('#pembimbing_lapangan').select2({
	            placeholder: "Pilih Pembimbing Lapangan",
	            allowClear: true
	        });
	        $('#pembimbing_akademik').select2({
	            placeholder: "Pilih Pembimbing Akademik",
	            allowClear: true
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
        jQuery(document).ready(function() {
        // START::OPERASI ---------------------------------------------------
        	show_instansi();
        	function show_instansi(){
        		var master_id = $('#master_id').val();
        		$.ajax({
			        url: '{{ route('prakerin.list_instansi') }}',
			        type: 'GET',
			        async: true,
			        data:{
			        	master_id 	: master_id,
			          	show 		: 1
			        },
			        success: function(response){
			            $('#show_instansi').html(response);
			            $('#count_instansi').load('{{ url('admin/prakerin/count-instansi/'.$master_prakerin->id) }}');
			        }
			    });
        	}

	        $('#insert_penempatan').on('click', function() {
	        	var master_id 			= $('#master_id').val();
	        	var instansi 			= $('#instansi').val();
	        	var pembimbing_lapangan = $('#pembimbing_lapangan').val();
	        	var pembimbing_akademik	= $('#pembimbing_akademik').val();
	        	var tanggal_mulai 		= $('#tanggal_mulai').val();
	        	var tanggal_selesai 	= $('#tanggal_selesai').val();
	        	if(instansi=="" || pembimbing_lapangan=="" || pembimbing_akademik=="" || tanggal_mulai=="" || tanggal_selesai==""){
	        		toastr.error("Pastikan tidak ada parameter isian yang kosong!", "Parameter Harus Lengkap");
	        		KTApp.block('.insert_penempatan', {
	                	overlayColor: '#000000',
	                	type: 'v2',
	                	state: 'danger',
	                	message: 'Pastikan Parameter Isian Terisi Lengkap!'
	            	});
	            	setTimeout(function() {
	                	KTApp.unblock('.insert_penempatan');
	            	}, 1500);
	        	}else{
	        		KTApp.block('.insert_penempatan', {
	                	overlayColor: '#000000',
	                	type: 'v2',
	                	state: 'success',
	                	message: 'Memeriksa & Mengirim Parameter. . .'
	            	});	
	        		$.ajax({
			            url: "{{ route('prakerin.insert_penempatan') }}",
			            type: "post",
			            data: {
			            	_token 					: $("#csrf").val(),
			                master_id 				: master_id,
			                instansi 				: instansi,
			                pembimbing_lapangan 	: pembimbing_lapangan,
			                pembimbing_akademik 	: pembimbing_akademik,
			                tanggal_mulai 			: tanggal_mulai,
			                tanggal_selesai 		: tanggal_selesai
			            },
			            dataType: 'json',
			            beforeSend: function(e) {
							if(e && e.overrideMimeType) {
								e.overrideMimeType('application/jsoncharset=UTF-8')
							}
						},
			            success: function(response){
			                console.log(response);
			                if(response.status=='success'){
			                  	// window.location = "/userData";
			                  	// alert(response.pesan);
			                  	$('#add_tempat').modal('hide');
			                   	$('#modalwindow').modal('hide');
			                  	KTApp.unblock('.insert_penempatan');
			                  	toastr.success(response.message, response.title);
			                  	$(".add_tempat").trigger("reset");	
			                  	show_instansi()		
			                }
			                else{
			                   $('#add_tempat').modal('hide');
			                   	$('#modalwindow').modal('hide');
			                  	KTApp.unblock('.insert_penempatan');
			                  	toastr.error(response.message, response.title);
			                  	$(".add_tempat").trigger("reset");	
			                  	show_instansi()	
			                }       
			            }
			        });
	        	} 	
	        });

	        $(document).on('click', '.hapus_instansi', function() {
	    		var id 				= $(this).data('id');
	    		var nama_instansi 	= $(this).data('nama');
	    		swal.fire({
			        title: "KONFIRMASI TINDAKAN!",
			        text: "Instansi "+nama_instansi+" Akan Dihapus Beserta Peserta Terkait",
			        type: "warning",
			        showCancelButton: true,
			        confirmButtonColor: "#DD6B55",
			        confirmButtonText: "Ya, Lanjutkan!",
			        cancelButtonText: "Tidak, Kembali!",
	    		}).then((result) => {
	      			if(result.value) {
				      	KTApp.block('.data-instansi', {
		                	overlayColor: '#000000',
		                	type: 'v2',
		                	state: 'danger',
		                	message: '<b>Menghapus Instansi '+nama_instansi+'...</b>'
		            	});	
	        			$.ajax({
				      		url: '{{ route('prakerin.hapus_instansi') }}',
				      		type: 'GET',
				      		data: {
				      			penempatan_id 		: id,
				      			nama_instansi 		: nama_instansi,
				           	},
				           	dataType: 'json',
				            beforeSend: function(e) {
								if(e && e.overrideMimeType) {
									e.overrideMimeType('application/jsoncharset=UTF-8')
								}
							},
				      		success: function(response){
				      			KTApp.unblock('.data-instansi');
			                  	toastr.success(response.message, response.title);
			                  	$(".add_tempat").trigger("reset");	
			                  	show_instansi()
			                  	$('#konten_list_peserta').fadeOut("slow");
			                  	$('#load_list_peserta').show().html('<b id="loader-center">Silahkan Pilih Kembali Instansi</b>');
				      		}
				      	})
	      			}
	    		});

			});

	        $(document).on('click', '.kelola_peserta', function(e) {
				$('#konten_list_peserta').fadeOut("slow");
				$('#load_list_peserta').show().html('<div class="kt-block kt-page--loading" id="loader-center"><span><div class="kt-loader kt-bg-brand"></div></span><b>Memuat Data Peserta . . .</b></div>');
		    	var penempatan_id 			= $(this).data('id');
		    	var nama_instansi 			= $(this).data('nama');
		    	$.ajax({
		          	url: '{{ route('prakerin.list_peserta') }}',
		          	type: 'GET',
		          	async: true,
		          	data:{
		          		penempatan_id 	: penempatan_id,
		          		nama_instansi 	: nama_instansi,
		            	show 			: 1
		        	},
		        success: function(response){
		        	$('#konten_list_peserta').fadeIn("slow").html(response);
		        	$('#load_list_peserta').hide();
		              	//$("#jenisNasabah").selectpicker();
		        }
	      	});
			
		});
        // END::OPERASI -----------------------------------------------------
        });
	</script>
@endpush
