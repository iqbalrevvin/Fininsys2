<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group([ 'middleware' => ['web', '\crocodicstudio\crudbooster\middlewares\CBBackend'],], function () {
    Route::get('admin', 'DasborController@index');
    Route::prefix('admin')->group(function () {

        Route::group(['prefix' => 'rombel', 'namespace' => 'Rombel'], function () { // Group Rombel
            Route::get('kelola/{rombel}', 'RombelController@index');
            Route::get('get_content', 'RombelController@get_konten_peserta')->name('rombel.get_konten_peserta');
            Route::get('get_list_pesdik', 'RombelController@get_list_pesdik')->name('rombel.get_list_pesdik');
            Route::get('insert_pd', 'RombelController@insert_siswa_kelas')->name('rombel.insert_siswa_kelas');
            Route::get('delete_pd', 'RombelController@delete_siswa_kelas')->name('rombel.delete_siswa_kelas');
            Route::get('set_wali_kelas', 'RombelController@set_wali_kelas')->name('rombel.set_wali_kelas');
        });

        Route::group(['prefix' => 'peserta-didik', 'namespace' => 'PesertaDidik'], function () { // Group Pesdik
            Route::get('list', 'PesertaDidikController@index')->name('pesdik.list');
            Route::get('profil/{pesdik}','PesertaDidikController@profil')->name('pesdik.profil');
            Route::get('import','PesertaDidikController@import')->name('pesdik.import');
            Route::get('list_pesdik/import', 'PesertaDidikController@get_data_pesdik_import')
                    ->name('pesdik.data_pesdik_import');
            Route::post('proses_import', 'PesertaDidikController@proses_import')->name('pesdik.proses_import');
        });

        Route::group(['prefix' => 'tenaga-pendidik', 'namespace' => 'TenagaPendidik'], function () { // Group Tenpen
            Route::get('jabatan', 'TenagaPendidikController@jabatan')->name('tenpen.jabatan');
        });

        Route::group(['prefix' => 'prakerin', 'namespace' => 'Prakerin'], function () { // GROUP PRAKERIN
            // START::INSTANSI
            Route::get('instansi/mapping/{id}', 'PrakerinController@MappingInstansi')->name('instansi.mapping');
            Route::post('instansi/mapping/{id}/update', 'PrakerinController@UpdateMappingInstansi');
            Route::get('list-lokasi/{id}', 'PrakerinController@ListLokasi');
            // END::INSTANSI
            Route::get('count-instansi/{id}','PrakerinController@count_instansi')->name('prakerin.count');
            Route::get('kelola/peserta/{id}', 'PrakerinController@peserta');
            Route::post('kelola/insert-penempatan', 'PrakerinController@insert_penempatan')->name('prakerin.insert_penempatan');
            Route::get('get-instansi', 'PrakerinController@get_list_instansi')->name('prakerin.list_instansi');
            Route::get('edit-penempatan', 'PrakerinController@edit_penempatan')->name('prakerin.edit_penempatan');
            Route::get('simpan-edit-penempatan', 'PrakerinController@simpan_edit_penempatan')->name('prakerin.simpan_edit_penempatan'); 
            Route::get('count-peserta/{id}','PrakerinController@count_peserta')->name('prakerin.count_peserta');
            Route::get('get-peserta', 'PrakerinController@get_list_peserta')->name('prakerin.list_peserta');
            Route::get('delete-instansi', 'PrakerinController@delete_instansi')->name('prakerin.hapus_instansi');
            Route::get('get-list-pilih-peserta', 'PrakerinController@get_list_pilih_peserta')->name('prakerin.get_list_pilih_peserta');
            Route::get('insert-peserta', 'PrakerinController@insert_peserta')->name('prakerin.insert_peserta');
            Route::get('delete-peserta', 'PrakerinController@delete_peserta')->name('prakerin.delete_peserta');
            Route::get('cetak/surat-pengantar', 'PrakerinController@cetak_surat_pengantar')->name('prakerin.cetak_surat_pengantar');
            Route::get('cetak/daftar-instansi', 'PrakerinController@CetakDaftarInstansi')->name('prakerin.cetak_daftar_instansi');
            Route::get('cetak-daftar-peserta', 'PrakerinController@CetakDaftarPeserta')->name('prakerin.cetak_daftar_peserta');
        });

        Route::group(['prefix' => 'admin/surat', 'namespace' => 'Surat'], function () { // GROUP SURAT
            Route::get('cetak/{id}', 'SuratController@CetakSurat')->name('surat.cetak');
        });
    });
});


/**
 * Start::RouteTestAjax
 */
Route::get('admin/testajax','TestAjaxController@index');
Route::get('admin/testajax/respone', 'TestAjaxController@responeajax')->name('testajax.respone');
Route::get('admin/testajax/kabupaten','TestAjaxController@list_kabupaten')->name('testajax.list_kabupaten');
Route::get('admin/testajax/kecamatan','TestAjaxController@list_kecamatan')->name('testajax.list_kecamatan');
Route::get('admin/test-maps', 'TestMapsController@index')->name('maps.index');
Route::post('admin/maps-add', 'TestMapsController@add')->name('maps.add');