<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Books;
use Validator;

class BooksController extends Controller
{
	//更新
	public function update(Request $request)
	{
	//バリデーション
	$validator = Validator::make($request->all(), [
		'id' => 'required',
		'item_name' => 'required|min:3|max:255',
		'item_number' => 'required|min:1|max:3',
		'item_amount' => 'required|max:6',
		'published' => 'required',
	]);
	//バリデーション:エラー
	if ($validator->fails()) {
		return redirect('/')
			->withInput()
			->withErrors($validator);
	}
	$books = Books::find($request->id);
	$books->item_name = $request->item_name;
	$books->item_number = $request->item_number;
	$books->item_amount = $request->item_amount;
	$books->published = $request->published;
	$books->save();
	return redirect('/');
	//
	}
}
