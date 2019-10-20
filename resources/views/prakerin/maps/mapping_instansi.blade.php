@extends('crudbooster::admin_template')
@section('content')
<style>
       /* Set the size of the div element that contains the map */
      	#map-canvas {
	        height: 400px;  /* The height is 400 pixels */
	        width: 100%;  /* The width is the width of the web page */
	   	}
    </style>
	<div class="row">
		<div class="col-md-5">
			<!--begin::Portlet-->
			<div class="data-instansi kt-portlet kt-portlet--height-fluid">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon"><i class="flaticon2-maps kt-font-brand"></i></span>
						<h3 class="kt-portlet__head-title kt-font-brand">Perbarui Peta Lokasi</h3> &nbsp; 
					</div>
					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-actions">
							<button type="button" class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air btn-circle btn-icon btn-sm"
								data-toggle="modal" data-target="#informasi_update_lokasi" title="Informasi Pembaruan Lokasi">
								<img src="{{ asset('metronic/media/icons/svg/Code/Info-circle.svg') }}"/>
							</button>
						</div>
					</div>
				</div>
				<div class="kt-portlet__body">
					@if( Session::has('success'))
						<div class="alert alert-solid-success alert-bold" role="alert">
							<div class="alert-text">{{ Session::get('success') }}</div>
						</div>
					@endif
					<div class="form-group">
								<div class="input-group">
									<input type="text" class="form-control" id="alamat" placeholder="Pencarian Alamat . . .">
									<div class="input-group-append">
										<button class="btn btn-info" type="button" onclick="geocodeLokasi()">Cari!</button>
									</div>
								</div>
							</div>
					<form action="{{CRUDBooster::adminPath('prakerin/instansi/mapping/'.$instansi->id.'/update')}}" method="post" 
						class="kt-form kt-form--fit kt-form--label-right">
						@csrf
						@if($instansi->kecamatan_id == NULL || $instansi->kabupaten_id == NULL)
							<div class="alert alert-solid-danger alert-bold" role="alert">
								<div class="alert-text">Mohon Lengkapi Kecamatan & Kabupaten Instansi!!!</div>
							</div>
						@else
							
							<div class="form-group row">
								<label class="col-form-label col-lg-3 col-sm-12">Latitude : </label>
								<div class=" col-lg-9 col-md-12 col-sm-12">
									<input type='text' title="Latitude" class='form-control' 
										name="lat" id="lat" value="{{$instansi->lat}}" readonly />
								</div>
								@if($errors->first('lat'))
									<b class="text-danger">{{ $errors->first('prodi') }}</b>
								@endif
							</div>
							<div class="form-group row">
								<label class="col-form-label col-lg-3 col-sm-12">Longitude : </label>
								<div class=" col-lg-9 col-md-12 col-sm-12">
									<input type='text' title="Latitude" class='form-control' 
										name="lng" id="lng" value="{{$instansi->lng}}" readonly />
								</div>
							</div>
						@endif
						
					{{-- 	<button type="button" class="" id="">
							<i class="flaticon flaticon2-fast-back"></i> Kembali
						</button> --}}
						<a href="{{CRUDBooster::adminPath('prakerin_instansi')}}" class="btn btn-danger btn-elevate-hover btn-sm nav_block">
							<i class="flaticon flaticon2-fast-back"></i> Kembali
						</a>
						<button type="submit" name="submit" class="btn btn-success btn-elevate-hover btn-sm" id="insert_penempatan">
							<i class="la la-save"></i> Simpan
						</button>
						
						<hr>
					</form>
					<table style="border-collapse: collapse; width: 100%; height: 20px;" border="0">
					    <tbody>
					        <tr style="height: 5px;">
					            <td style="width: 33.3333%; height: 5px;">Nama Instansi</td>
					            <td style="width: 1.70844%; height: 5px;">:</td>
					            <td style="width: 64.9583%; height: 5px;"><b>{{$instansi->nama}}</b></td>
					        </tr>
					        <tr style="height: 5px;">
					            <td style="width: 33.3333%; height: 5px;">Bidang Usaha</td>
					            <td style="width: 1.70844%; height: 5px;">:</td>
					            <td style="width: 64.9583%; height: 5px;"><b>{{$instansi->bidang_usaha->nama}}</b></td>
					        </tr>
					        <tr style="height: 5px;">
					            <td style="width: 33.3333%; height: 5px;">Alamat</td>
					            <td style="width: 1.70844%; height: 5px;">:</td>
					            <td style="width: 64.9583%; height: 5px;"><b>{{$instansi->alamat}}</b></td>
					        </tr>
					        <tr style="height: 5px;">
					            <td style="width: 33.3333%; height: 5px;">Kelurahan</td>
					            <td style="width: 1.70844%; height: 5px;">:</td>
					            <td style="width: 64.9583%; height: 5px;"><b>{{kelurahan($instansi->kelurahan_id)}}</b></td>
					        </tr>
					        <tr style="height: 5px;">
					            <td style="width: 33.3333%; height: 5px;">Kecamatan</td>
					            <td style="width: 1.70844%; height: 5px;">:</td>
					            <td style="width: 64.9583%; height: 5px;"><b>{{kecamatan($instansi->kecamatan_id)}}</b></td>
					        </tr>
					        <tr style="height: 5px;">
					            <td style="width: 33.3333%; height: 5px;">Kabupaten</td>
					            <td style="width: 1.70844%; height: 5px;">:</td>
					            <td style="width: 64.9583%; height: 5px;"><b>{{kabupaten($instansi->kabupaten_id)}}</b></td>
					        </tr>
					        <tr style="height: 5px;">
					            <td style="width: 33.3333%; height: 5px;">Provinsi</td>
					            <td style="width: 1.70844%; height: 5px;">:</td>
					            <td style="width: 64.9583%; height: 5px;"><b>{{provinsi($instansi->provinsi_id)}}</b></td>
					        </tr>
					     </tbody>
				    </table>
				</div>
			</div>

			<!--end::Portlet-->
		</div>
		<div class="col-md-7">
			<div class="data-instansi kt-portlet kt-portlet--height-fluid">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon"><i class="flaticon-map-location kt-font-brand"></i></span>
						<h3 class="kt-portlet__head-title kt-font-brand">Google Maps</h3> &nbsp; 
					</div>
					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-actions">
							<button type="button" class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air btn-circle btn-icon btn-sm"
								data-toggle="modal" data-target="#informasi_pilih_lokasi" title="Informasi Pembaruan Lokasi">
								<img src="{{ asset('metronic/media/icons/svg/Code/Info-circle.svg') }}"/>
							</button>
						</div>
					</div>
				</div>
				<div class="kt-portlet__body">
					@if($instansi->kecamatan_id == NULL || $instansi->kabupaten_id == NULL)
						<div class="alert alert-solid-danger alert-bold" role="alert">
							<div class="alert-text">Mohon Lengkapi Kecamatan & Kabupaten Instansi!!!</div>
						</div>
					@else
						<div id="map-canvas"></div>
					@endif
					
				</div>
			</div>
		</div>
	</div>
	@include('prakerin.maps.modal_update_lokasi')
	@include('prakerin.maps.modal_pilih_lokasi')
@endsection

@push('bottom')
	@if($instansi->lat == 0 && $instansi->lng == 0)

	@else
	@endif
	@php
		if($instansi->lat == 0 && $instansi->lng == 0){
			$address = kecamatan($instansi->kecamatan_id);
		}else{
			$address = "";
		}
	@endphp
	<script>
    	var map;
    	var geocoder;
		function initMap() {
			geocoder = new google.maps.Geocoder();
  			map = new google.maps.Map(document.getElementById('map-canvas'),
            	{
            		center: new google.maps.LatLng({!!$instansi->lat!!}, {!!$instansi->lng!!}), 
                    zoom: 15
            	}
            );
  			geocoder.geocode({'address': "{{$address}}"}, function(results, status) {
    			if (status === 'OK') {
      				map.setCenter(results[0].geometry.location);
    			} else {
      				// alert('Geocode was not successful for the following reason: ' + status);
    			}
  			});
            var marker = new google.maps.Marker({
            	position: {
            		lat :{!!$instansi->lat!!},
            		lng: {!!$instansi->lng!!},
            	},
            	map :map,
            	draggable: true,
            	icon: "{{ asset('image/icon-map/industri.png') }}",
            	title: "{{$instansi->nama}}"
            });
            google.maps.event.addListener(marker,'position_changed', function(){
            		var lat = marker.getPosition().lat();
            		var lng = marker.getPosition().lng();

            		$('#lat').val(lat);
            		$('#lng').val(lng);
            	})
		}
		function geocodeLokasi() {
		  var address = document.getElementById('alamat').value;
		  geocoder.geocode( { 'address': address}, function(results, status) {
		    if (status == google.maps.GeocoderStatus.OK) {
		      map.setCenter(results[0].geometry.location);
		      var marker = new google.maps.Marker({
		          map: map,
		          position: results[0].geometry.location  ,
		          draggable: true        
		      });
		      	google.maps.event.addListener(marker,'position_changed', function(){
            		var lat = marker.getPosition().lat();
            		var lng = marker.getPosition().lng();

            		$('#lat').val(lat);
            		$('#lng').val(lng);
            	})
		      	var lat = results[0].geometry.location.lat();
		      	var lng = results[0].geometry.location.lng();
		    } else {
		      alert('Geocode was not successful for the following reason: ' + status);
		    }
		      document.getElementById("lat").value = lat;      
		      document.getElementById('lng').value=lng;    
		  });
		}
		google.maps.event.addListener(marker,'position_changed', function(){
            	var lat = marker.getPosition().lat();
            	var lng = marker.getPosition().lng();

            	$('#lat').val(lat);
            	$('#lng').val(lng);
            })
		google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDW_u3PHV3bRsMPlcR3ikqH9NFRfeccLQ8&callback=initMap&region=ID&libraries=places"
        type="text/javascript"></script> 
@endpush