<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        return view('home');
    }
    // 保存
    public function addBook(Request $request,$isbn) {
        $book = new Book();
        $book->title = $request->title;
        $book->subtitle = $request->subtitle;
        $book->imageUrl=$request->imageUrl;
        $book->isbn=$isbn;
        $book->save();
    }
    public function getBookInfo(){
        $book_info=Book::select('title','subTitle','imageUrl','isbn')->get();
        return response()->json($book_info);
    }

    public function deleteBook($isbn){
        Book::destroy($isbn);
    }

}
