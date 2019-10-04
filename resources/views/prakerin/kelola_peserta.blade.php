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
			<small>Peserta Didik Rombel <b>{{ $master_prakerin->rombel->kelas->nama }}</b> yang akan tampil pada penambahan peserta prakerin</small>
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
						<button type="button" 
							class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air btn-circle btn-icon btn-sm"
							data-toggle="modal" data-target="#informasi_penempatan" title="Informasi Penempatan">
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
	{{-- STAR::INFORMASI PENEMPATAN --}}
		@include('prakerin.modal_informasi_penempatan')	
	{{-- END::INFORMASI PENEMPATAN --}}

	{{-- STAR::DATA PILIH PESERTA PRAKERIN --}}	
		@include('prakerin.modal_informasi_peserta_prakerin')	
	{{-- END::DATA PILIH PESERTA PRAKERIN --}}

	{{-- START::TAMBAH DATA INSTANSI --}}
		@include('prakerin.modal_add_penempatan')
	{{-- END::TAMBAH DATA INSTANSI --}}

	{{-- START::EDIT DATA INSTANSI --}}
		@include('prakerin.modal_edit_penempatan')
	{{-- END::EDIT DATA INSTANSI --}}
	
	{{-- STAR::DATA PILIH PESERTA PRAKERIN --}}	
		@include('prakerin.modal_add_peserta')	
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
			            // $('.kt-select2').select2();
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
			            },
			            error: function (jqXHR, textStatus, errorThrown){
					        swal.fire("Gagal Memperbarui", "Gagal dalam memproses data, coba untuk muat ulang halaman atau hubungi pihak pengembang", "warning");
					        KTApp.unblock('.insert_penempatan');
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
				      		},
				      		error: function (jqXHR, textStatus, errorThrown){
					        	swal.fire("Gagal Memperbarui", "Gagal dalam memproses data, coba untuk muat ulang halaman atau hubungi pihak pengembang", "warning");
					        	KTApp.unblock('.data-instansi');
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
		        	},
		        	error: function (jqXHR, textStatus, errorThrown){
			        	swal.fire("Gagal Memperbarui", "Gagal dalam memproses data, coba untuk muat ulang halaman atau hubungi pihak pengembang", "warning");
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
				        confirmButtonColor: "#008B8B",
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

			$(document).on('click', '.hapus_peserta', function() {
				var id 				= $(this).data('id');
				var penempatan_id 	= $('#penempatan_id').val();
	    		var nama_peserta 	= $(this).data('nama');
	    		swal.fire({
			        title: "KONFIRMASI TINDAKAN!",
			        text: "PD Atas Nama "+nama_peserta+" Akan Dihapus Dari Instansi",
			        type: "warning",
			        showCancelButton: true,
			        confirmButtonColor: "#DD6B55",
			        confirmButtonText: "Ya, Lanjutkan!",
			        cancelButtonText: "Tidak, Kembali!",
	    		}).then((result) => {
	      			if(result.value) {
				      	KTApp.block('.data_peserta', {
		                	overlayColor: '#000000',
		                	type: 'v2',
		                	state: 'danger',
		                	message: '<b>Menghapus Peserta Bernama '+nama_peserta+'...</b>'
		            	});	
	        			$.ajax({
				      		url: '{{ route('prakerin.delete_peserta') }}',
				      		type: 'GET',
				      		data: {
				      			peserta_id 			: id,
				      			penempatan_id 		: penempatan_id,
				           	},
				           	dataType: 'json',
				            beforeSend: function(e) {
								if(e && e.overrideMimeType) {
									e.overrideMimeType('application/jsoncharset=UTF-8')
								}
							},
				      		success: function(response){
				      			KTApp.unblock('.data_peserta');
			                  	toastr.success(response.message, response.title);
			                  	$(".add_tempat").trigger("reset");	
			                  	$("div[data-id='"+id+"']").fadeOut("slow",function(){
								    $(this).remove();
							     });
			                  	tabel.ajax.reload(null,false);
			                  	$('#count_peserta').load('{{ url('admin/prakerin/count-peserta/') }}/'+penempatan_id);
			                  	// $('#konten_list_peserta').fadeOut("slow");
			                  	// $('#load_list_peserta').show().html('<b id="loader-center">Silahkan Pilih Kembali Instansi</b>');
				      		},
				      		error: function (jqXHR, textStatus, errorThrown){
					        	swal.fire("Gagal Memperbarui", "Gagal dalam memproses data, coba untuk muat ulang halaman atau hubungi pihak pengembang", "warning");
					        	KTApp.unblock('.data_peserta');
					    	}
				      	})
	      			}
	    		});
			});

			$(document).on('click', '#edit_penempatan', function() {
				var penempatan_id 		= $(this).data('id');
    			$.ajax({
		      		url: '{{ route('prakerin.edit_penempatan') }}',
		      		type: 'GET',
		      		data: {
		      			penempatan_id 		: penempatan_id,
		           	},
		           	dataType: 'json',
		            beforeSend: function(e) {
						if(e && e.overrideMimeType) {
							e.overrideMimeType('application/jsoncharset=UTF-8')
						}
					},
		      		success: function(data){
		      			$('#edit_tempat').modal('show');
		      			$('#simpan_edit_penempatan').val(data.penempatan_id);
		      			$('#data_instansi').html(data.nama_instansi);
		      			$('#data_pembimbing').html(data.nama_pembimbing);
		      			$('#data_pembimbing_akademik').html(data.nama_pembimbing_akademik);
		      			$('#edit_tanggal_mulai').val(data.tanggal_mulai);
		      			$('#edit_tanggal_selesai').val(data.tanggal_selesai);
		      		}
		      	})	
			});

			$(document).on('click', '#simpan_edit_penempatan', function() {
				var master_id 					= $('#master_id').val();
				var penempatan_id 				= $(this).val();
				var edit_instansi 				= $('#edit_instansi').val();
				var edit_pembimbing_lapangan	= $('#edit_pembimbing_lapangan').val();
				var edit_pembimbing_akademik 	= $('#edit_pembimbing_akademik').val();
				var edit_tanggal_mulai 			= $('#edit_tanggal_mulai').val();
				var edit_tanggal_selesai 		= $('#edit_tanggal_selesai').val();
				if(edit_tanggal_mulai=="" || edit_tanggal_selesai==""){
					toastr.error("Pastikan Parameter Tanggal Mulai & Tanggal Selesai Tidak Kosong", "Parameter Harus Lengkap");
				}else{
					KTApp.block('.edit_penempatan', {
	                	overlayColor: '#000000',
	                	type: 'v2',
	                	state: 'success',
	                	message: 'Memeriksa & Mengirim Parameter. . .'
	            	});
				
					$.ajax({
			      		url: '{{ route('prakerin.simpan_edit_penempatan') }}',
			      		type: 'GET',
			      		data: {
			      			master_id	 				: master_id,
			      			penempatan_id 				: penempatan_id,
			      			edit_instansi 				: edit_instansi,
			      			edit_pembimbing_lapangan 	: edit_pembimbing_lapangan,
			      			edit_pembimbing_akademik 	: edit_pembimbing_akademik,
			      			edit_tanggal_mulai 			: edit_tanggal_mulai,
			      			edit_tanggal_selesai 		: edit_tanggal_selesai
			           	},
			           	dataType: 'json',
			            beforeSend: function(e) {
							if(e && e.overrideMimeType) {
								e.overrideMimeType('application/jsoncharset=UTF-8')
							}
						},
			      		success: function(response){
			      				if(response.status == 'success'){
			      					toastr.success(response.message, response.title);
			      					KTApp.unblock('.edit_penempatan');
			      					$('#edit_tempat').modal('hide');
			      					show_instansi()	
			      				}else{
			      					toastr.error(response.message, response.title);
			      				}
			      				
			      		},
			      		error: function (jqXHR, textStatus, errorThrown){
					        swal.fire("Gagal Memperbarui", "Gagal dalam memproses data, coba untuk muat ulang halaman atau hubungi pihak pengembang", "warning");
					        KTApp.unblock('.edit_penempatan');
					    }
			      	})
				}
			});
        	// END::OPERASI -----------------------------------------------------
        }); //JQUERY DOCUMENT READY
		
		
	</script>
@endpush
