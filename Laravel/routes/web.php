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


    use	App\Books;
    use	Illuminate\Http\Request;


/**
*本のダッシュボード表示
*/
Route::get('/', function () {
	$books = Books::orderBy('created_at', 'asc')->get();
	return view('books', [
		'books' => $books
	]);
});

/**
*新「本」を追加
*/

Route::post('/books','BooksController@store');

//更新画面
Route::post('/booksedit/{books}', function(Books $books) {
	//{books}id 値を取得 => Books $books id 値の1レコード取得
	return view('booksedit', ['book' => $books]);	
});
Route::post('/books/update','BooksController@update');

/**
*	本を削除
*/

Route::delete('/book/{book}', function (Books $book) {
	$book->delete();
	return redirect('/');
});

//本ダッシュボード表示
Route::get('/','BooksController@index');

//更新画面
Route::post('/booksedit/{books}','BooksController@edit');

//更新画面
Route::post('/booksedit/{books}','BooksController@edit');



Route::get('/welcome' , function () {
    return view('welcome');
});
