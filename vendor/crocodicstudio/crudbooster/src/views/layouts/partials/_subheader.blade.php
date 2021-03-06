@php
	$module = CRUDBooster::getCurrentModule();
@endphp
<div class="kt-subheader kt-grid__item" id="kt_subheader">
	@if($module)
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				{{($page_title)?:$module->name}}

			</h3>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home">
					<i class="{{$module->icon}}"></i>
				</a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="{{CRUDBooster::adminPath()}}" class="kt-subheader__breadcrumbs-link nav_block">
					{{ trans('crudbooster.home') }} 
				</a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="#" class="kt-subheader__breadcrumbs-link">
					{{$module->name}}
				</a>
			</div>
		</div>
		<div class="kt-subheader__toolbar">
			<div class="kt-subheader__wrapper">
			{{-- START:ADD-ACTION --}}
				@if(!empty($index_button))
					 @foreach($index_button as $ib)
					 	<a href="{{$ib["url"]}}" id="{{str_slug($ib["label"])}}"
					 		@if($ib['onClick']) onClick='return {{$ib["onClick"]}}' @endif
                           	@if($ib['onMouseOver']) onMouseOver='return {{$ib["onMouseOver"]}}' @endif
                           	@if($ib['onMouseOut']) onMouseOut='return {{$ib["onMouseOut"]}}' @endif
                           	@if($ib['onKeyDown']) onKeyDown='return {{$ib["onKeyDown"]}}' @endif
                           	@if($ib['onLoad']) onLoad='return {{$ib["onLoad"]}}' @endif
							class="btn kt-subheader__btn-primary btn-icon nav_block" 
							data-toggle="kt-tooltip" title="{{$ib["label"]}}" data-placement="left">
							<i class="{{$ib["icon"]}}"></i>
						</a>
					 @endforeach
				@endif
			{{-- END:ADD-ACTION --}}

				@if(CRUDBooster::getCurrentMethod() == 'getIndex')
					@if($button_show)
						<a href="{{ CRUDBooster::mainpath().'?'.http_build_query(Request::all()) }}"
							id='btn_show_data' 
							class="btn btn-brand btn-elevate btn-elevate-air kt-subheader__btn-primary btn-icon nav_block" 
							data-toggle="kt-tooltip" title="Muat Ulang Data" data-placement="left">
							<i class="flaticon2-reload"></i>
						</a>
					@endif
					@if($button_add && CRUDBooster::isCreate())
						<a href="{{ CRUDBooster::mainpath('add').'?return_url='.urlencode(Request::fullUrl()).'&parent_id='.g('parent_id').'&parent_field='.$parent_field }}"
							id='btn_add_new_data' 
							class="btn btn-brand btn-elevate btn-elevate-air kt-subheader__btn-primary btn-icon nav_block" 
							data-toggle="kt-tooltip" title="Tambah Data" data-placement="left">
							<i class="flaticon-add"></i>
						</a>
					@endif
				@endif
				@if($button_export && CRUDBooster::getCurrentMethod() == 'getIndex')
					<a href="javascript:void(0)" id='btn_export_data' data-url-parameter='{{$build_query}}'
						class="btn btn-brand btn-elevate btn-elevate-air kt-subheader__btn-primary btn-icon btn-export-data" 
						data-toggle="kt-tooltip" title="Export Data" data-placement="right">
						<i class="fa fa-file-export"></i>
					</a>
				@endif
				@if($button_import && CRUDBooster::getCurrentMethod() == 'getIndex')
					<a href="{{ CRUDBooster::mainpath('import-data') }}" id='btn_import_data' 
						data-url-parameter='{{$build_query}}'
						class="btn btn-brand btn-elevate btn-elevate-air kt-subheader__btn-primary btn-icon btn-import-data" 
						data-toggle="kt-tooltip" title="Import Dari Excel" data-placement="right">
						<i class="fa fa-upload"></i>
					</a>
				@endif
			</div>
		</div>
	@else
		<div class="kt-subheader__main">
			<button class="kt-subheader__mobile-toggle kt-subheader__mobile-toggle--left" id="kt_subheader_mobile_toggle"><span></span></button>
			<h3 class="kt-subheader__title">
				{{-- {{ Session::get('appname') }} --}}
				{{($page_title)?:Session::get('appname')}}
				{{-- @yield('subheader_title') --}}
			</h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="{{ url('/admin') }}" class="kt-subheader__breadcrumbs-home">
					<i class="flaticon2-shelter"></i>
				</a>
				{{-- <span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Crud 
				</a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Datatables.net 
				</a>
				<a href="#" class="btn btn-label-primary btn-bold btn-icon-h kt-margin-l-10">
					Add New
				</a> --}}
			</div>
		</div>
	@endif
</div>