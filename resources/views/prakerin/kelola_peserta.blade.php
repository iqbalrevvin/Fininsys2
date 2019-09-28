@extends('crudbooster::admin_template')
@section('content')
	<input type="hidden" id="rombel_id" value="{{ $master_prakerin->rombel->id }}">
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
	{{-- START::TAMBAH DATA INSTANSI --}}
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
	{{-- END::TAMBAH DATA INSTANSI --}}
	{{-- STAR::DATA PILIH PESERTA PRAKERIN --}}	
	<div class="modal fade" id="add_peserta_prakerin" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Data Rombel {{ $master_prakerin->rombel->kelas->nama }}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="kt-portlet kt-portlet--responsive-mobile" id="konten_tambah_peserta">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<span class="kt-portlet__head-icon">
								<i class="flaticon-users kt-font-success"></i>
							</span>
							<span class=" kt-font-warning">
								Pilih Peserta Didik Lalu Klik <i class="la la-plus-square kt-font-success"></i>
								<span class="kt-font-success">Tambahkan</span><br>
								<small class="kt-font-dark">PD yang ditampilkan adalah PD bertatus aktif</small>
							</span>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
								<button type="button" class="btn btn-success" id="btn_tambah_peserta_prakerin">
									<i class="la la-plus-square"></i>Tambahkan
								</button>
								<button type="button" class="btn btn-secondary" id="reloadTabelPilihPeserta">
									<i class="la la-refresh"></i>Muat Ulang
								</button>
							</div>
						</div>
					</div>
					<div class="kt-portlet__body">
						<table class="table table-striped- table-bordered table-hover" id="tbl_pilih_peserta_prakerin">
	                        <thead>
	                            <tr>
	                                <th>
	                                    <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
	                                        <input type="checkbox" id="check-all">Semua
	                                            <span></span>
	                                    </label>
	                                </th>
	                                <th>NIPD</th>
	                                <th>Nama Peserta Didik</th>
	                                <th>Jenis Kelamin</th>
	                            </tr>
	                        </thead>
	                    </table>
					</div>
				</div>
			</div>
		</div>
	</div>	
	{{-- END::DATA PILIH PESERTA PRAKERIN --}}
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
	    $(document).on('click', '#reloadTabelPilihPeserta', function(e) {
        	tabel.ajax.reload(null,false); //reload datatable ajax 
    	});
    	$("#check-all").click(function () {
		    $(".data-check").prop('checked', $(this).prop('checked'));
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
        var DatatablesBasicPaginations = {
		    init: function() {
		    	var master_id 		= $('#master_id').val();
		    	var rombel_id 		= $('#rombel_id').val();
		        tabel = $("#tbl_pilih_peserta_prakerin").DataTable({
		            responsive: true,
					searchDelay: 500,
					processing: true,
					serverSide: true,
			        ajax: {
						url: '{{ route('prakerin.get_list_pilih_peserta') }}',
						method: 'GET',
						data: {
							master_id		: master_id,
							rombel_id 		:rombel_id
						},
					},
			        "columns":[
			        	{ "data":"checkbox", orderable:false, searchable:false},
			        	{ "data": "NIPD" },
			            { "data": "nama_lengkap" },
			            { "data": "jenis_kelamin" },
			        ]
		        })
		    }
		};
        jQuery(document).ready(function() {
        // START::OPERASI ---------------------------------------------------
        	show_instansi();
        	DatatablesBasicPaginations.init();
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

			$(document).on('click', '#btn_tambah_peserta_prakerin', function() {
				var nama_instansi 		= $('#nama_instansi').val();
	    		var penempatan_id 		= $('#penempatan_id').val();
	    		var list_id = [];
	    		$(".data-check:checked").each(function() {
	            	list_id.push(this.value);
	    		});
	    		if(list_id.length > 0){
		    		swal.fire({
				        title: "KONFIRMASI TINDAKAN!",
				        text: +list_id.length+" Peserta Didik Akan Didaftarkan Sebagai Peserta Prakerin Di "+nama_instansi,
				        type: "info",
				        showCancelButton: true,
				        confirmButtonColor: "#DD6B55",
				        confirmButtonText: "Ya, Lanjutkan!",
				        cancelButtonText: "Tidak, Kembali!",
		    		}).then((result) => {
		      			if(result.value) {
		        			KTApp.block("#konten_tambah_peserta", {
					          overlayColor: "#000000",
					          type: "loader",
					          state: "primary",
					          message: "<b>Menambakan Data Peserta Ke "+nama_instansi+"...</b>"
					      	});
		        			$.ajax({
				                url: "{{ route('prakerin.insert_peserta') }}",
				                method:"GET",
				                data: {
				                	id 				:list_id,
				                	penempatan_id	:penempatan_id
				                },
			
				                success: function()
				                {
			                		KTApp.unblock("#konten_tambah_peserta");
		                    		$('#add_peserta_prakerin').modal('hide');
		                    		$('#modalwindow').modal('hide');
		                    		tabel.ajax.reload(null,false); //reload datatable ajax 
		                        	// kontenView();
		                        	$('#konten_list_peserta').fadeOut("slow");
			                  		$('#load_list_peserta').show().html('<b class="text-success">Peserta Berhasil Ditambahkan!!!<br>Silahkan Pilih Kembali Instansi</b>');
		                        	toastr.success(+list_id.length+" Peserta berhasil ditambahkan ke "+nama_instansi, "Peserta Ditambahkan");
				                },
				                error: function (jqXHR, textStatus, errorThrown){
				                    alert('Gagal Memproses Data, Coba Kembali Atau Hubungi Pihak Pengembang!');
				                    KTApp.unblock("#konten_tambah_peserta");
				                }
				            });
		      			}/*KONDISI JIKA MEMILIH YA UNTUK MEMASUKAN DATA SISWA*/
		    		});
		    	}else{
		    		toastr.error("Pilih Terlebih Dahulu Peserta Didik Yang Akan Didaftarkan Ke "+nama_instansi, "Pilih Siswa!");
		    	}
			});
        	// END::OPERASI -----------------------------------------------------
        }); //JQUERY DOCUMENT READY
		
		
	</script>
@endpush
