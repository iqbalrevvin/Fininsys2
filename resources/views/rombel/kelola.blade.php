@extends('crudbooster::admin_template')
@section('content')
	<input type="hidden" value="{{ $rombel->id }}" id="idRombel"></input>
	<input type="hidden" value="{{ $rombel->kelas_id }}" id="idKelas"></input>
	<input type="hidden" value="{{ $rombel->kelas->nama }}" id="namaKelas"></input>
	<input type="hidden" value="{{ $kelas->prodi->id }}" id="prodiID"></input>
	<input type="hidden" value="{{ $rombel->tahun_ajaran_id }}" id="tahunAjaranID"></input>
	<div class="alert alert-light alert-elevate" role="alert">
		<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
		<div class="alert-text">
			{{-- Kelola rombel adalah pengelolaan rombongan belajar siswa yang terdapat pada rombel 
			<b>{{ $rombel->kelas->nama }}</b> Tahun Ajaran <b>{{ $rombel->tahun_ajaran->nama }}</b> --}}
			{{ $page_notice }} <br>
			<small>Peserta Didik Program Studi <b>{{ $kelas->prodi->nama }}</b> yang akan tampil pada penambahan peserta rombel</small>
		</div>
	</div>
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-home"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					{{ $rombel->kelas->nama }}
					<small>{{ $rombel->tahun_ajaran->nama }} <i>( {{ $rombel->pesdik->count() }} Peserta Didik )</i></small>
				</h3>
			</div>
			
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						{{-- <div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="la la-download"></i> Export
							</button>
							<div class="dropdown-menu dropdown-menu-right">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first">
										<span class="kt-nav__section-text">Choose an option</span>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-print"></i>
											<span class="kt-nav__link-text">Print</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-copy"></i>
											<span class="kt-nav__link-text">Copy</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-excel-o"></i>
											<span class="kt-nav__link-text">Excel</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">CSV</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-pdf-o"></i>
											<span class="kt-nav__link-text">PDF</span>
										</a>
									</li>
								</ul>
							</div>
						</div> --}}
						<a href="{{ CRUDBooster::adminPath($slug='rombel') }}" title="Kembali" 
							class="btn btn-clean kt-margin-r-10 nav_block">
		                    <i class="la la-arrow-left"></i>
		                    <span class="kt-hidden-mobile">
		                        Kembali
		                    </span>
		                </a>
						&nbsp;
						<a href="#" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" 
							data-target="#kt_modal_7">
							<i class="la la-plus"></i>
							Peserta Rombel
						</a>
						<button type="button" 
							class="btn btn-secondary m-btn m-btn--custom m-btn--icon m-btn--air" id="reloadTabel">
	                        <span>
	                            <i class="flaticon-refresh"></i>
	                            <span class="kt-pulse__ring">Muat Ulang</span>
	                        </span>
	                    </button>
					</div>
				</div>
			</div>
		</div>
		
		{{-- START::TABEL PESERTA KELAS --}}
		<div id="resultKonten">
			<div id="preloader" class="">
	            <div class=" ">
	                <div class="kt-blockui">
	                    <span>
	                        <div class="kt-loader kt-loader--brand"></div>
	                    </span>
	                    <b>Memuat Data . . .</b>
	                </div>
	            </div>
	        </div>
		</div>
		{{-- END::TABEL PESERTA KELAS --}}
	</div>
	<div class="modal fade" id="kt_modal_7" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Data Siswa Prodi {{ $kelas->prodi->singkatan }}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="kt-portlet kt-portlet--responsive-mobile" id="kontenTambahSiswa">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<span class="kt-portlet__head-icon">
								<i class="flaticon-users kt-font-success"></i>
							</span>
							<span class=" kt-font-warning">
								Pilih Siswa Lalu Klik <i class="la la-plus-square kt-font-success"></i>
								<span class="kt-font-success">Tambahkan</span><br>
								<small class="kt-font-dark">PD yang ditampilkan adalah PD bertatus aktif</small>
							</span>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
								<button type="button" class="btn btn-success" id="btnTambahSiswa">
									<i class="la la-plus-square"></i>Tambahkan
								</button>
								<button type="button" class="btn btn-secondary" id="reloadTabelPilihPesdik">
									<i class="la la-refresh"></i>Muat Ulang
								</button>
							</div>
						</div>
					</div>
					<div class="kt-portlet__body">
						<table class="table table-striped- table-bordered table-hover" 
							id="tbl_pilih_peserta_rombel">
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
	                                <th>Thn Angkatan</th>
	                            </tr>
	                        </thead>
	                    </table>
					</div>
				</div>
			</div>
		</div>
	</div>						
@endsection

@push('bottom')
	<script src="{{ asset('metronic/js/pages/crud/forms/widgets/select2.js') }} " type="text/javascript"></script>
	<script>
		jQuery(document).ready(function() {
			kontenView();
			DatatablesBasicPaginations.init();
			function kontenView(){
			// Class definition
				var tabelPesertaRombel = function() {
				// Private functions
				// demo initializer
					var peserta_rombel = function() {
						var datatable = $('.konten-siswa').KTDatatable({
		
							translate: {
		                        records: {
		                            processing: 'Memuat Data Siswa...',
		                            noRecords: 'Belum Terdapat Siswa, Silahkan Tambahkan Siswa Ke Kelas Ini!',
		                        },
		                        toolbar: {
		                            pagination: {
		                                items: {
		                                    default: {
		                                        first: 'First',
		                                        prev: 'Previous',
		                                        next: 'Next',
		                                        last: 'Last',
		                                        more: 'More pages',
		                                        input: 'Page number',
		                                        select: 'Jumlah data ditampilkan'
		                                    },
		                                }
		                            }
		                        }
		                    },
							search: {
								input: $('#generalSearch'),
							},
							columns: [
								{
						      		field: 'Foto',
						      		title: 'Foto',
						      		width: 50,
						      		type: 'image',
						      		selector: false,
						      		textAlign: 'left',
						    	},
								{
						      		field: 'Nama',
						      		title: 'Nama',
						      		sortable: 'asc',
						      		width: 200,
						      		type: 'text',
						      		selector: false,
						      		textAlign: 'left',
						    	},
						   		{
						     		field: 'Jenis Kelamin',
						     		title: 'Jenis Kelamin',
						     		width: 100,
						     		type: 'text',
						     		selector: false,
						     		textAlign: 'left',
						    	},
						    	{
						     		field: 'NIS/NIPD',
						     		title: 'NIS/NIPD',
						     		sortable: 'asc',
						     		width: 100,
						     		type: 'number',
						     		selector: false,
						     		textAlign: 'left',
						    	},
						    	{
						      		field: 'NISN',
						      		title: 'NISN',
						      		width: 100,
						      		type: 'number',
						      		selector: false,
						      		textAlign: 'left',
						    	},
								{
						      		field: 'Program Studi',
						      		title: 'Program Studi',
						      		width: 200,
						      		type: 'text',
						      		selector: false,
						      		textAlign: 'left',
						    	},
	
						    	{
									field: 'Status',
									title: 'Status',
									autoHide: false,
									width: 150,
									// callback function support for column rendering
									template: function(row) {
										var status = {
											1: {'title': 'Aktif', 'class': 'kt-badge--success'},
											2: {'title': 'Nonaktif', 'class': ' kt-badge--danger'},
											3: {'title': 'Keluar', 'class': ' kt-badge--dark'},
											4: {'title': 'Mutasi', 'class': ' kt-badge--secondary'},
											5: {'title': 'Lulus', 'class': ' kt-badge--warning'},
											6: {'title': 'Mengundurkan Diri', 'class': ' kt-badge--dark'},

										};
										return '<span class="kt-badge ' + status[row.Status].class + ' kt-badge--inline kt-badge--pill">' + status[row.Status].title + '</span>';
									},
								},
								{
						      		field: 'Hapus',
						      		title: 'Hapus',
						      		width: 100,
						      		textAlign: 'center',
						    	},
							],
						});
				    	$('#kt_form_status').selectpicker();
					};
					return {
						// Public functions
						init: function() {
							// init dmeo
							peserta_rombel();
						},
					};
				}();
				$idRombel = $('#idRombel').val();
				$.ajax({
		            url: '{{ route('rombel.get_konten_peserta') }}',
		            type: 'GET',
		            async: false,
		            data:{
		            	idRombel 	: $idRombel,
		                show 		: 1
		            },
		            success: function(response){
		                $('#resultKonten').html(response);
		                tabelPesertaRombel.init()
		                //$("#jenisNasabah").selectpicker();
		            }
		        });
			}
			$(document).on('click', '#reloadTabel', function(e) {
        		kontenView().load();
    		});
    		$("#check-all").click(function () {
			    $(".data-check").prop('checked', $(this).prop('checked'));
			});
			$(document).on('click', '#reloadTabelPilihPesdik', function(e) {
        	 	tabel.ajax.reload(null,false); //reload datatable ajax 
    		});
    		$(document).on('click', '#btnKeluarKelas', function() {
    			$rombel = $(this).data('rombel');
		        $id     = $(this).data('id');
		        $nama 	= $(this).data('nama');
		        $("#loadKeluarKelas"+$id).show();
		        $('.btnKeluarKelas'+$id).attr("hidden", true);
		        $('#reloadTabel').addClass('btn-danger');
		        $.ajax({
		            type: "GET",
		            url: '{{ route('rombel.delete_siswa_kelas') }}',
		            data: {
		                id 			: $id,
		                rombel 		: $rombel,
		                keluar    	: 1
		            },
		            success: function(){
		                toastr.error("\""+$nama+"\" Berhasil Dikeluarkan Dari Kelas, Silahkan Muat Ulang!", "Keluar Dari Kelas");
		                // kontenView();
		                $("#loadKeluarKelas"+$id).hide();
		                $('#reloadTabel').removeClass('btn-danger');
		                $("#nama_siswa"+$id).html("<b class='text-danger'>Keluar Kelas(Muat Ulang)</b>");
		            }
		        });
			});

    		$(document).on('click', '#btnTambahSiswa', function() {
	    		var namaKelas 	= $('#namaKelas').val();
	    		var idRombel 	= $('#idRombel').val();
	    		var list_id = [];
	    		$(".data-check:checked").each(function() {
	            	list_id.push(this.value);
	    		});
	    		if(list_id.length > 0){
		    		swal.fire({
				        title: "KONFIRMASI TINDAKAN!",
				        text: +list_id.length+" Data Siswa Akan Dimasukan Kedalam Kelas "+namaKelas,
				        type: "info",
				        showCancelButton: true,
				        confirmButtonColor: "#DD6B55",
				        confirmButtonText: "Ya, Lanjutkan!",
				        cancelButtonText: "Tidak, Kembali!",
		    		}).then((result) => {
		      			if(result.value) {
		        			KTApp.block("#kontenTambahSiswa", {
					          overlayColor: "#000000",
					          type: "loader",
					          state: "primary",
					          message: "<b>Menambakan Data Siswa Ke Kelas "+namaKelas+"...</b>"
					      	});
		        			$.ajax({
				                url: "{{ route('rombel.insert_siswa_kelas') }}",
				                method:"GET",
				                data: {
				                	id 			:list_id,
				                	rombelID	:idRombel
				                },
			
				                success: function()
				                {
			                		KTApp.unblock("#kontenTambahSiswa");
		                    		$('#kt_modal_7').modal('hide');
		                    		$('#modalwindow').modal('hide');
		                    		tabel.ajax.reload(null,false); //reload datatable ajax 
		                        	kontenView();
		                        	toastr.success("Siswa Berhasil Ditambahkan Ke Kelas "+namaKelas, "Siswa Ditambahkan");
				                },
				                error: function (jqXHR, textStatus, errorThrown){
				                    alert('Gagal Memproses Data, Coba Kembali Atau Hubungi Pihak Pengembang!');
				                    KTApp.unblock("#kontenTambahSiswa");
				                }
				            });
		      			}/*KONDISI JIKA MEMILIH YA UNTUK MEMASUKAN DATA SISWA*/
		    		});
		    	}else{
		    		toastr.error("Pilih Terlebih Dahulu Siswa Yang Akan Dimasukan Ke Kelas "+namaKelas, "Pilih Siswa!");
		    	}
			});

			/*SET WALI KELAS*/
	   		$(document).on('change', '#pilih_wali_kelas', function (e) {
				KTApp.block(".pilih_wali_kelas");
				$rombelID 		= $('#idRombel').val();
				$waliKelas 		= $('#pilih_wali_kelas').val();
				$kelasID 		= $('#idKelas').val();
				$tahunAjaranID 	= $('#tahunAjaranID').val();
				$.ajax({
					url: '{{ route('rombel.set_wali_kelas') }}',
					type : 'GET',
					//async: true,
					//dataType: '',
					data: {
						rombelID 		: $rombelID,
						waliKelas 		: $waliKelas,
						kelasID 		: $kelasID,
						tahunAjaranID 	: $tahunAjaranID
					},
					dataType: 'json',
					beforeSend: function(e) {
						if(e && e.overrideMimeType) {
							e.overrideMimeType('application/jsoncharset=UTF-8')
						}
					},
					success: function (response) {
						KTApp.unblock(".pilih_wali_kelas");
						if(response.status == 'success'){
							//alert($kelasID);
							toastr.success(response.pesan, "Wali Kelas Diatur");
							//mApp.unblock(".inputBlock");
							kontenView();
						}else{
							toastr.error(response.pesan, "Gagal");
							kontenView();
						}
					},
					error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
					alert(xhr.responseText) // munculkan alert
				}
				})
			});
			/*------------------*/
		});
		/**
		 * [Tabel serverside pilih siswa]
		 * @type {Object}
		 */
		var DatatablesBasicPaginations = {
		    init: function() {
		    	var idProdi 	= $('#prodiID').val();
		        tabel = $("#tbl_pilih_peserta_rombel").DataTable({
		            responsive: true,
					searchDelay: 500,
					processing: true,
					serverSide: true,

			        ajax: {
						url: '{{ route('rombel.get_list_pesdik') }}',
						method: 'GET',
						data: {
							id:idProdi,
						},
					},

			        "columns":[
			        	{ "data":"checkbox", orderable:false, searchable:false},
			        	{ "data": "NIPD" },
			            { "data": "nama_lengkap" },
			            { "data": "jenis_kelamin" },
			            { "data": "tahun_ajaran.nama" },
			        ]
		        })
		    }
		};

		toastr.options = {
		  "closeButton": false,
		  "debug": false,
		  "newestOnTop": true,
		  "progressBar": true,
		  "positionClass": "toast-top-left",
		  "preventDuplicates": false,
		  "onclick": null,
		  "showDuration": "100",
		  "hideDuration": "1000",
		  "timeOut": "2000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		};
</script>
@endpush