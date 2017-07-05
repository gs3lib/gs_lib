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

    Route::post('/books ', function (Request $request) {
	//バリデーション
	$validator = Validator::make($request->all(), [
		'item_name' => 'required|max:255',
		'item_number' => 'required | min:1 | max:3',
		'item_amount' => 'required | max:6',
		'published'  => 'required',
	]);
	//バリデーション：エラー
	if ($validator->fails()) {
		return redirect('/')
		->withInput()
		->withErrors($validator);
	}
// Eloquent モデル
	$books = new Books;
	$books->item_name = $request->item_name;
	$books->item_number = $request->item_number;
	$books->item_amount = $request->item_amount;
	$books->published  = $request->published;
	$books->save(); //「/」ルートにリダイレクト
	return redirect('/');        
	//
    });
//更新画面
	Route::post('/booksedit/{books}', function(Books $books) {
	//{books}id 値を取得 => Books $books id 値の1レコード取得
	return view('booksedit', ['book' => $books]);	
	});
	Route::post('/books/update', function(Request $request){
//バリデーション
$validator = Validator::make($request->all(), [
'id' => 'required',
'item_name' => 'required|min:3|max:255',
'item_number' => 'required|min:1|max:3',
'item_amount' => 'required|max:6',
'published' => 'required',
]);
//バリデーション：エラー
if ($validator->fails()) {
return redirect('/')
->withInput()
->withErrors($validator);
}
//データ更新
$books = Books::find($request->id);
$books->item_name  = $request->item_name;
$books->item_number = $request->item_number;
$books->item_amount = $request->item_amount;
$books->published  = $request->published;
$books->save();
return redirect('/');
});
    /**
*	本を削除
*/
 Route::delete('/book/{book}', function (Books $book) {
	$book->delete();
	return redirect('/');
});

Route::get('/welcome' , function () {
    return view('welcome');
});
