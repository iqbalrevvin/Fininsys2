
<div class="kt-portlet">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
					width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
				    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
				        <rect id="bound" x="0" y="0" width="24" height="24"/>
				        <circle id="Oval-5" fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
				        <rect id="Rectangle-9" fill="#000000" x="11" y="10" width="2" height="7" rx="1"/>
				        <rect id="Rectangle-9-Copy" fill="#000000" x="11" y="7" width="2" height="2" rx="1"/>
				    </g>
				</svg>&nbsp;
				Informasi Import Data Peserta Didik
			</h3>
		</div>
	</div>

	<!--begin::Form-->
	<form class="kt-form">
		<div class="kt-portlet__body">
			{!! CRUDBooster::getSetting('deskripsi_informasi_import_pesdik') !!}
		</div>

	</form>

	<!--end::Form-->
</div>
