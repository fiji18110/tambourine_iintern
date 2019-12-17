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
    public function addBook(Request $request) {
        $isbn=$request->input('isbn');
        $exist_isbn=array_column(Book::select('isbn')->get()->toArray(),'isbn');
            if(in_array($isbn,$exist_isbn)){
                return 'exist';
            }else{
                $before_url='https://app.rakuten.co.jp/services/api/BooksBook/Search/20170404?format=json&size=0&isbn=';
                $jan=$isbn;
                $after_url=env('RAKUTEN_API_KEI');            
                    
                $url=$before_url.$jan.$after_url;
                $ch = curl_init(); // 1. 初期化
                curl_setopt( $ch, CURLOPT_URL, $url ); // 2. オプションを設定
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                $book_data = curl_exec( $ch ); // 3. 実行してデータを得る
                $book_data = json_decode($book_data , true );
                curl_close($ch); // 4. 終了

                if($book_data['count']==0){
                    return 'notExist';
                }else{
                    try{
                        $book = new Book();
                        $book->title = $book_data['Items'][0]['Item']['title'];
                        $book->subtitle = $book_data['Items'][0]['Item']['subTitle'];
                        $book->imageUrl=$book_data['Items'][0]['Item']['largeImageUrl'];
                        $book->isbn=$jan;
                        $book->save();
                    }catch(\Exception $e){
                        var_dump($e);
                    }
                    return 'OK';
                }
            }
    }
    public function getBookInfo(){
        $book_info=Book::select('title','subTitle','imageUrl','isbn')->get();
        return response()->json($book_info);
    }
    public function reader(){
        return view('/barcode_reader');
    }

    public function deleteBook(Request $request){
        $isbn=$request->input('isbn');
        return Book::where('isbn', $isbn)->delete();
    }


}
