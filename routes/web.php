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


Route::group([
    'middleware' => ['web', '\crocodicstudio\crudbooster\middlewares\CBBackend'],
], function () {
    Route::get('admin', 'DasborController@index');
    /*STAR::MANAJEMEN ROMBEL*/
        Route::get('admin/rombel/kelola/{rombel}', 'Rombel\RombelController@index');
        Route::get('admin/rombel/get_content', 'Rombel\RombelController@get_konten_peserta')->name('rombel.get_konten_peserta');
        Route::get('admin/rombel/get_list_pesdik', 'Rombel\RombelController@get_list_pesdik')->name('rombel.get_list_pesdik');
        Route::get('admin/rombel/insert_pd', 'Rombel\RombelController@insert_siswa_kelas')->name('rombel.insert_siswa_kelas');
        Route::get('admin/rombel/delete_pd', 'Rombel\RombelController@delete_siswa_kelas')->name('rombel.delete_siswa_kelas');
        Route::get('admin/rombel/set_wali_kelas', 'Rombel\RombelController@set_wali_kelas')->name('rombel.set_wali_kelas');
    /*END::MANAJEMEN ROMBEL*/
    /*STAR::PESERTA DIDIK*/
        Route::get('admin/peserta-didik/list', 'PesertaDidik\PesertaDidikController@index')->name('pesdik.list');
        Route::get('admin/peserta-didik/profil/{pesdik}','PesertaDidik\PesertaDidikController@profil');
    /*END::PESERTA DIDIK*/
    /*STAR::TENAGA PENDDIDIK*/
        Route::get('admin/tenaga-pendidik/jabatan', 'TenagaPendidik\TenagaPendidikController@jabatan')->name('tenpen.jabatan');
    /*END::TENAGA PENDDIDIK*/
    /*STAR::PRAKERIN*/
        Route::get('admin/prakerin/count-instansi/{id}','Prakerin\PrakerinController@count_instansi')
                ->name('prakerin.count');
        Route::get('admin/prakerin/kelola/peserta/{id}', 'Prakerin\PrakerinController@peserta');
        Route::post('admin/prakerin/kelola/insert-penempatan', 'Prakerin\PrakerinController@insert_penempatan')
                ->name('prakerin.insert_penempatan');
        
        Route::get('admin/prakerin/get-instansi', 'Prakerin\PrakerinController@get_list_instansi')
            ->name('prakerin.list_instansi');
        Route::get('admin/prakerin/edit-penempatan', 'Prakerin\PrakerinController@edit_penempatan')
            ->name('prakerin.edit_penempatan');
        Route::get('admin/prakerin/simpan-edit-penempatan', 'Prakerin\PrakerinController@simpan_edit_penempatan')
                ->name('prakerin.simpan_edit_penempatan');   

        Route::get('admin/prakerin/count-peserta/{id}','Prakerin\PrakerinController@count_peserta')
                ->name('prakerin.count_peserta');
        Route::get('admin/prakerin/get-peserta', 'Prakerin\PrakerinController@get_list_peserta')->name('prakerin.list_peserta');
        Route::get('admin/prakerin/delete-instansi', 'Prakerin\PrakerinController@delete_instansi')->name('prakerin.hapus_instansi');
        Route::get('admin/prakerin/get-list-pilih-peserta', 'Prakerin\PrakerinController@get_list_pilih_peserta')
                ->name('prakerin.get_list_pilih_peserta');
        Route::get('admin/prakerin/insert-peserta', 'Prakerin\PrakerinController@insert_peserta')->name('prakerin.insert_peserta');
        Route::get('admin/prakerin/delete-peserta', 'Prakerin\PrakerinController@delete_peserta')->name('prakerin.delete_peserta');;
    /*END::PRAKERIN*/
});


/**
 * Start::RouteTestAjax
 */
Route::get('admin/testajax','TestAjaxController@index');
Route::get('admin/testajax/respone', 'TestAjaxController@responeajax')->name('testajax.respone');
Route::get('admin/testajax/kabupaten','TestAjaxController@list_kabupaten')->name('testajax.list_kabupaten');
Route::get('admin/testajax/kecamatan','TestAjaxController@list_kecamatan')->name('testajax.list_kecamatan');