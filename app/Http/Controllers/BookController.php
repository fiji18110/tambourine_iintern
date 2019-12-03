<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        $books = Book::get();
        return view('home', ['books' => $books]);
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

    public function deleteBook($isbn){
        Book::destroy($isbn);
    }

}
