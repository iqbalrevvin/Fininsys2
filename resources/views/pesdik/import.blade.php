@extends('crudbooster::admin_template')
@section('content')
	{{-- <div class="alert alert-light alert-elevate" role="alert">
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
		    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
		        <rect id="bound" x="0" y="0" width="24" height="24"/>
		        <path d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z" id="Path-57" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
		        <rect id="Rectangle" fill="#000000" opacity="0.3" x="11" y="2" width="2" height="14" rx="1"/>
		        <path d="M12.0362375,3.37797611 L7.70710678,7.70710678 C7.31658249,8.09763107 6.68341751,8.09763107 6.29289322,7.70710678 C5.90236893,7.31658249 5.90236893,6.68341751 6.29289322,6.29289322 L11.2928932,1.29289322 C11.6689749,0.916811528 12.2736364,0.900910387 12.6689647,1.25670585 L17.6689647,5.75670585 C18.0794748,6.12616487 18.1127532,6.75845471 17.7432941,7.16896473 C17.3738351,7.57947475 16.7415453,7.61275317 16.3310353,7.24329415 L12.0362375,3.37797611 Z" id="Path-102" fill="#000000" fill-rule="nonzero"/>
		    </g>
		</svg>&nbsp;
		<div class="alert-text">
			<b>Import Data Peserta Didik</b>
		</div>
	</div> --}}
	<div class="row">
		<div class="col-md-6">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
							    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							        <rect id="bound" x="0" y="0" width="24" height="24"/>
							        <path d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z" id="Path-57" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
							        <rect id="Rectangle" fill="#000000" opacity="0.3" x="11" y="2" width="2" height="14" rx="1"/>
							        <path d="M12.0362375,3.37797611 L7.70710678,7.70710678 C7.31658249,8.09763107 6.68341751,8.09763107 6.29289322,7.70710678 C5.90236893,7.31658249 5.90236893,6.68341751 6.29289322,6.29289322 L11.2928932,1.29289322 C11.6689749,0.916811528 12.2736364,0.900910387 12.6689647,1.25670585 L17.6689647,5.75670585 C18.0794748,6.12616487 18.1127532,6.75845471 17.7432941,7.16896473 C17.3738351,7.57947475 16.7415453,7.61275317 16.3310353,7.24329415 L12.0362375,3.37797611 Z" id="Path-102" fill="#000000" fill-rule="nonzero"/>
							    </g>
							</svg>&nbsp;
							Upload File Import
						</h3>
					</div>
				</div>

				<!--begin::Form-->
				<form class="kt-form" action="{{ url('admin/peserta-didik/proses_import') }}" 
					method="post" enctype="multipart/form-data">
					@csrf
					<div class="kt-portlet__body">
						@if( Session::has('success'))
							<div class="alert alert-solid-success alert-bold" role="alert">
								<div class="alert-text">{{ Session::get('success') }}</div>
							</div>
						@endif

						@if(Session::has('error'))
							<div class="alert alert-solid-danger alert-bold" role="alert">
								<div class="alert-text">{{ Session::get('error') }}</div>
							</div>
						@endif

						{{-- @if (count($errors) > 0)
							<div class="alert alert-solid-success alert-bold" role="alert">
								<div class="alert-text">{{ $error }}</div>
							</div>
						@endif --}}


						{{-- @if (session('success'))
                            <div class="alert alert-solid-success alert-bold" role="alert">
								<div class="alert-text">{{ session('success') }}</div>
							</div>
                        @endif
						@if (session('error'))
                            <div class="alert alert-solid-danger alert-bold" role="alert">
								<div class="alert-text">{{ session('error') }}</div>
							</div>
                        @endif --}}

						<div class="form-group">
							<label>File Import</label>
							<div></div>
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="file_import">
								<label class="custom-file-label" for="customFile">Pilih Berkas</label>
							</div>
							@if($errors->first('file_import'))
								<b class="text-danger">{{ $errors->first('file_import') }}</b>
							@endif
						</div>
						<div class="form-group">
							<label>Program Studi Tujuan</label>
							<div></div>
							<div class="custom-file">
								<select style='width:100%' class="form-control kt-select2" name="prodi" id="prodi">
									<option value="">Pilih Program Studi</option>
									@forelse($prodi as $prodi)
										<option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
									@empty
										<option value="">Belum Ada Program Studi Tersediak</option>
									@endforelse
								</select>
							</div>
							@if($errors->first('prodi'))
								<b class="text-danger">{{ $errors->first('prodi') }}</b>
							@endif
						</div>
						<div class="form-group">
							<div class="custom-file">
								<button type="submit" class="btn btn-info btn-elevate btn-pill btn-elevate-air btn-sm">
									<i class="la la-upload"></i>Import Berkas
								</button>
							</div>
						</div>
					</div>
				</form>

				<!--end::Form-->
			</div>
			@include('pesdik.import-data-pesdik')
		</div>
		<div class="col-md-6">
			@include('pesdik.import-informasi')
		</div>
	</div>
@endsection

@push('bottom')
	<script>
		jQuery(document).ready(function() {
			DatatablesBasicPaginations.init();
			$(document).on('click', '#reloadTabelListPesdik', function(e) {
        	 	tabel.ajax.reload(null,false); //reload datatable ajax 
    		});
    		$('#prodi').select2({
	            placeholder: "Pilih Program Studi Tujuan",
	            allowClear: true
	        });
		});
		var DatatablesBasicPaginations = {
		    init: function() {
		        tabel = $("#tbl_data_pesdik_import").DataTable({
		            responsive: true,
					searchDelay: 500,
					processing: true,
					serverSide: true,
					scrollY: '43vh',
					scrollX: true,
					scrollCollapse: true,

			        ajax: {
						url: '{{ route('pesdik.data_pesdik_import') }}',
						method: 'GET',
						data: {
							// id:idProdi,
						},
					},

			        "columns":[
			        	{ "data": "nama_lengkap" },
			        	{ "data": "NIK" },
			            { "data": "NISN" },
			            { "data": "NIPD" },
			            { "data": "jenis_kelamin" },
			            { "data": "tahun_ajaran.nama" },
			            { "data": "status_pesdik.nama" },
			            { "data": "created_at" },
			        ]
		        })
		    }
		};
	</script>
@endpush