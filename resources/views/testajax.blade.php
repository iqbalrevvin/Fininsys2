@extends('crudbooster::admin_template')
@section('subheader_title')
	test
@endsection
@section('content')
	<div class="kt-portlet">
		<div class="kt-portlet__head">
			<div class="kt-portlet__head-label">
				<h3 class="kt-portlet__head-title">
					TestAjax Laravel
				</h3>
			</div>
		</div>

		<!--begin::Form-->
		<form class="kt-form">
			<div class="kt-portlet__body">
				<div class="form-group">
					<label>Provinsi</label>
					<select class="form-control" name="provinsi" id="provinsi">
						<option value="">Pilih Provinsi</option>}
						@forelse ($provinsi as $prov)
							<option value="{{ $prov->id }}">{{ $prov->name }}</option>
						@empty
							<option value="">Data Tidak Ditemukan</option>
						@endforelse
					</select>
				</div>
				<div class="form-group kabupaten">
					<label>Kabupaten</label>
					<select class="form-control" name="kabupaten" id="kabupaten">
							<option value="">Pilih Provinsi Terlebih Dahulu</option>
					</select>
				</div>
				<div class="form-group kecamatan">
					<label>Kecamatan</label>
					<select class="form-control" name="kecamatan" id="kecamatan">
							<option value="">Pilih Kabupaten Terlebih Dahulu</option>
					</select>
				</div>
				<hr>



				<div class="form-group field">
					<label>Disabled Input</label>
					<input type="email" class="form-control" placeholder="Disabled input">
				</div>
				<div class="form-group">
					<label>Disabled select</label>
					<select class="form-control" id="pilihan">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
				</div>
				<div id="respone"></div>
				<div class="form-group">
					<button type="reset" class="btn btn-brand" id="btnSubmit">Submit</button>
				</div>
			</div>
			<div class="kt-portlet__foot">
				<div class="kt-form__actions">
					<button type="reset" class="btn btn-brand">Submit</button>
					<button type="reset" class="btn btn-secondary">Cancel</button>
				</div>
			</div>
		</form>
		<!--end::Form-->
	</div>
@endsection

@push('bottom')
	<script>
		$("#pilihan").change(function(){ 
			KTApp.block('.field', {
                overlayColor: '#000000',
                type: 'v2',
                state: 'primary',
                message: 'Processing...'
            });
			$.ajax({
				type: "GET", // Method pengiriman data bisa dengan GET atau POST
				url: "{{ route('testajax.respone') }}", // Isi dengan url/path file php yang dituju
				data: {
					idPilihan : $("#pilihan").val()
				}, // data yang akan dikirim ke file yang dituju
				//dataType: "json",

				success: function(response){ 
					KTApp.unblock('.field');
					$("#respone").html(response).show();
				},
				error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
					alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
					console.log(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
				}
			});
		});

		$("#provinsi").change(function(){ 
			KTApp.block('.kabupaten', {
                overlayColor: '#000000',
                type: 'v2',
                state: 'primary',
                message: 'Memuat Data Kabupaten...'
            });
			$.ajax({
				type: "GET", // Method pengiriman data bisa dengan GET atau POST
				url: "{{ route('testajax.list_kabupaten') }}", // Isi dengan url/path file php yang dituju
				data: {
					idProvinsi : $("#provinsi").val()
				}, // data yang akan dikirim ke file yang dituju
				dataType: "json",
				beforeSend: function(e) {
					if(e && e.overrideMimeType) {
						e.overrideMimeType("application/json;charset=UTF-8");
					}
				},
				success: function(response){ 
					KTApp.unblock('.kabupaten');
					$("#kabupaten").html(response.list_kabupaten).show();
				},
				error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
					alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
				}
			});
		});

		$("#kabupaten").change(function(){ 
			KTApp.block('.kecamatan', {
                overlayColor: '#000000',
                type: 'v2',
                state: 'primary',
                message: 'Memuat Data Kecamatan...'
            });
			$.ajax({
				type: "GET", // Method pengiriman data bisa dengan GET atau POST
				url: "{{ route('testajax.list_kecamatan') }}", // Isi dengan url/path file php yang dituju
				data: {
					idKabupaten : $("#kabupaten").val()
				}, // data yang akan dikirim ke file yang dituju
				dataType: "json",
				beforeSend: function(e) {
					if(e && e.overrideMimeType) {
						e.overrideMimeType("application/json;charset=UTF-8");
					}
				},
				success: function(response){ 
					KTApp.unblock('.kecamatan');
					$("#kecamatan").html(response.list_kecamatan).show();
				},
				error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
					alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
				}
			});
		});
	</script>
@endpush