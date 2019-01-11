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
    return redirect('jurnal-umum');
});





// AKUN
Route::group(['prefix' => 'akun'], function() {
	//index dan form simpan
	Route::get('/', 'cAkun@index');
	//Simpan
	Route::get('/create', 'cAkun@create');
	Route::post('/', 'cAkun@store');
	//edit
	Route::get('/{idnya}/edit', 'cAkun@edit');
	Route::patch('/{idnya}', 'cAkun@update');
	//delete
	//delete ini perlu form, kalau mau yang simple boleh juga pke get
	Route::delete('/{tanggal}', 'cAkun@destroy');    
});


// JURNAL UMUM
Route::group(['prefix' => 'jurnal-umum'], function() {
	//index dan form simpan
	Route::get('/', 'cJurnalUmum@index');
	//Simpan
	Route::post('/', 'cJurnalUmum@store');
	//edit
	Route::get('/{idnya}/edit', 'cJurnalUmum@edit');
	Route::patch('/{idnya}', 'cJurnalUmum@update');
	//delete
	//delete ini perlu form, kalau mau yang simple boleh juga pke get
	Route::delete('/{tanggal}', 'cJurnalUmum@destroy');    
});




//USER
Route::get('/profil/{id}', 'cUser@showProfil');
Route::get('/user', 'cUser@index');
//Simpan
Route::get('/user/create', 'cUser@create');
Route::post('/user', 'cUser@store');
//edit
Route::get('/user/{idnya}/edit', 'cUser@edit');
Route::patch('/user/{idnya}', 'cUser@update');
//delete
//delete ini perlu form, kalau mau yang simple boleh juga pke get
Route::delete('/user/{id}', 'cUser@destroy');




// TRASH
Route::get('/trashed', 'cTrash@trashIndex');

// Restore
Route::get('/trashed/transaksi/{tanggal}/restore', 'cTrash@restoreTransaksi');
Route::get('/trashed/transaksi/restore', 'cTrash@restoreAllTransaksi');

Route::get('/trashed/user/{id}/restore', 'cTrash@restoreUser');
Route::get('/trashed/user/restore', 'cTrash@restoreAllUser');

Route::get('/trashed/akun/{id}/restore', 'cTrash@restoreAkun');
Route::get('/trashed/akun/restore', 'cTrash@restoreAllAkun');


// Delete
Route::get('/trashed/transaksi/{tanggal}/delete', 'cTrash@deleteTransaksi');
Route::get('/trashed/transaksi/delete', 'cTrash@deleteAllTransaksi');

Route::get('/trashed/user/{id}/delete', 'cTrash@deleteUser');
Route::get('/trashed/user/delete', 'cTrash@deleteAllUser');

Route::get('/trashed/akun/{id}/delete', 'cTrash@deleteAkun');
Route::get('/trashed/akun/delete', 'cTrash@deleteAllAkun');




//BUKU BESAR
Route::get('/buku-besar', 'cBukuBesar@index');

//NERACA
Route::get('/neraca', 'cNeraca@index');









// Route::get('/coba', function (Codedge\Fpdf\Fpdf\Fpdf $fpdf) {
// 	ob_end_clean();
//     $fpdf->AddPage();
//     $fpdf->SetFont('Courier', 'B', 18);
//     $fpdf->Cell(50, 25, 'Hello World!');
//     $fpdf->Output();
// });


// PRINT FPDF
Route::get('cetak/all', 'cFpdf@cetakAll');
Route::get('cetak/jurnal-umum', 'cFpdf@jurnalUmum');
Route::get('cetak/buku-besar', 'cFpdf@bukuBesar');
Route::get('cetak/neraca', 'cFpdf@neraca');














// Auth::routes();

// Login
Route::get('login', 'cLogin@getLogin')->name('login');
Route::post('post-login', 'cLogin@postLogin');

//logout
Route::get('logout', function(){
	Auth::logout();
	echo 'sukses logout';
	return redirect('login');
});