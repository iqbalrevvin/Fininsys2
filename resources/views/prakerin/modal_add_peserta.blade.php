<div class="modal fade" id="add_peserta_prakerin" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Data Rombel {{ $master_prakerin->rombel->kelas->nama }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="kt-portlet" id="konten_tambah_peserta">
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