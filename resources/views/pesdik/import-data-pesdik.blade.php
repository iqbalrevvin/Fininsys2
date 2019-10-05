<div class="kt-portlet kt-portlet--responsive-mobile" id="konten_tambah_peserta">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<span class="kt-portlet__head-icon">
				<i class="flaticon-users kt-font-success"></i>
			</span>
			<span class=" kt-font-warning">
				Data Seluruh Peserta Didik<br>
				<small class="kt-font-dark">Seluruh Peserta Didik Berdasarkan Input Terbaru</small>
			</span>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
				<button type="button" class="btn btn-secondary" id="reloadTabelListPesdik">
					<i class="la la-refresh"></i>Muat Ulang
				</button>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">
		<table class="table table-striped- table-bordered table-hover" id="tbl_data_pesdik_import">
            <thead>
                <tr>
                	<th>Nama Pesdik</th>
                    <th>NIK</th>
                    <th>NISN</th>
                    <th>NIPD</th>
                    <th>Jenis Kelamin</th>
                    <th>Angkatan</th>
                    <th>Status</th>
                    <th>Tanggal input</th>
                </tr>
            </thead>
        </table>
	</div>
</div>