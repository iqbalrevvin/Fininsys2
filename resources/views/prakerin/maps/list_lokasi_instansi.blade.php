@extends('crudbooster::admin_template')
@section('content')
	<style>
      	#map {
	        height: 450px;  /* The height is 400 pixels */
	        width: 100%;  /* The width is the width of the web page */
	   	}
    </style>
	<div class="alert alert-light alert-elevate" role="alert">
			@if($master_prakerin->rombel->kelas->prodi->logo_prodi == NULL)
				<div class="kt-userpic kt-userpic--lg kt-userpic--danger">
					<span>{{ $master_prakerin->rombel->kelas->prodi->singkatan }}</span>
				</div>
			@else
				<img class="kt-widget__img " src="{{ asset($master_prakerin->rombel->kelas->prodi->logo_prodi) }}" alt="image" style="height: 50px;">
			@endif	
			&nbsp;
		<div class="alert-text">
			Daftar Lokasi Tempat Kerja <i class="flaticon2-maps"></i><br>
			<small>Rombel <b>{{ $master_prakerin->rombel->kelas->nama }}</b> Tahun Ajaran <b>{{ $master_prakerin->TahunAjaran->nama }}</b></small>
			<hr>
			<a href="{{ CRUDBooster::adminPath('prakerin_master') }}" title="Kembali Ke Daftar Master Prakerin" 
				class="btn btn-outline-danger btn-elevate btn-pill btn-elevate-air btn-circle btn-sm nav_block">
                <i class="la la-arrow-left"></i>
                    <span class="kt-hidden-mobile">
                        Kembali
                    </span>
            </a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<!--begin::Portlet-->
			<div class="data-instansi kt-portlet kt-portlet--height-fluid">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon"><i class="flaticon2-maps kt-font-brand"></i></span>
						<h3 class="kt-portlet__head-title kt-font-brand">Lokasi</h3> &nbsp; 
						<span>(<span id="count_instansi">{{ $list_instansi->count() }}</span> Instansi)</span>
					</div>
					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-actions">
						<button type="button" 
							class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air btn-circle btn-icon btn-sm"
							data-toggle="modal" data-target="#informasi_lokasi" title="Informasi Lokasi">
							<img src="{{ asset('metronic/media/icons/svg/Code/Info-circle.svg') }}"/>
						</button>
						</div>
					</div>
				</div>
				<div class="kt-portlet__body">
					@if($list_instansi->count() == 0)
						<b>Data Penempatan Belum Ditentukan</b> 
					@else
						<div id="map"></div>
					@endif
				</div>
			</div>
			<!--end::Portlet-->
		</div>
	</div>
	@include('prakerin.maps.modal_info_lokasi')
@endsection
<script>
    var map;
    var geocoder;
	function initMap() {

		geocoder = new google.maps.Geocoder();
			map = new google.maps.Map(document.getElementById('map'),
        	{
        		center: new google.maps.LatLng(-6.4873575, 109.566385), 
                zoom: 9
        	}
        );
  		geocoder.geocode({'address': "{{$sekolah->provinsi}}"}, function(results, status) {
    		if (status === 'OK') {
      			map.setCenter(results[0].geometry.location);
    		} else {
      			// alert('Geocode was not successful for the following reason: ' + status);
    		}
  		});
  		var iconBase =
           'https://developers.google.com/maps/documentation/javascript/examples/full/images/';
        var mark = '{{ asset('image/icon-map') }}';

        var icons = {
          point: {
            icon: mark + '/industri2.png'
          },
        };
        var features = [
        	@foreach($list_instansi as $loc)
        		{
        			position		: new google.maps.LatLng('{{ $loc->instansi->lat }}', '{{ $loc->instansi->lng }}'),
        			type			: 'point',
        			judul			: '{{$loc->instansi->nama}}',
        			kecamatan		: '{{kecamatan($loc->instansi->kecamatan_id)}}',
        			kabupaten		: '{{kabupaten($loc->instansi->kabupaten_id)}}',
        			feedback_count	: "test",
        		},
        	@endforeach
        ];

        var infowindow = new google.maps.InfoWindow();
        function placeMarker(loc) {
        	var marker = new google.maps.Marker({
            	position: loc.position,
            	icon: icons[loc.type].icon,
            	map: map,
            	title: loc.judul,
          	});
          	marker.addListener('click', function(){
          		var judul = loc.judul;
          		var kecamatan = loc.kecamatan;
          		var kabupaten = loc.kabupaten;
	        	infowindow.close(); // Close previously opened infowindow
	        	infowindow.setContent("<b>"+ judul +"</b><br>Kecamatan : "+kecamatan+"<br> Kabupaten : "+kabupaten+"<br>");
	        	infowindow.open(map, marker);
		    });
        }
        for (var i = 0; i < features.length; i++) {
        	placeMarker(features[i]);
        }
        google.maps.event.addDomListener(window, 'load', initGoogleMap);
            
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDW_u3PHV3bRsMPlcR3ikqH9NFRfeccLQ8&callback=initMap"
        type="text/javascript"></script> 