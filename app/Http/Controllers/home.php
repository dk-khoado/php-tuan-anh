<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Support\Facades\View as FacadesView;

class home extends Controller
{
    public function index(Request $request)
    {
        $books = DB::table('books')->where("is_delete", "=", "0")->simplePaginate(6);
        $book_type = DB::select('select * from book_type');
        return view('item', ["books" => $books, "book_type" => $book_type]);
    }
    public function findBooks(Request $request)
    {
        $name = $request->query("name", "");
        $books = DB::table('books')->whereRaw("is_delete=0 and title LIKE ?", array('%' . $name . '%', '%' . $name . '%'))->simplePaginate(6);
        return FacadesResponse::json(FacadesView::make('bookFind', ['books' => $books])->render());
    }


    public function addToCart(Request $request,$id)
    {
        $exist = DB::selectOne('select * from cart Where user_id =? and book_id=?',[Auth::id(), $id]);
        if($exist){
            $res["is_success"] = false;
            return FacadesResponse::json($res);
        }
        $books = DB::insert("INSERT INTO cart (user_id, book_id) VALUES(?,?)", [Auth::id(), $id]);
        $res["is_success"] = $books;
        return FacadesResponse::json($res);
    }
    public function remoteToCart(Request $request, $id)
    {
        $books = DB::delete("DELETE FROM cart WHERE id=?;", [$id]);
        $res["is_success"] = $books;
        return FacadesResponse::json($res);
    }

    public function loadCart(Request $reques)
    {        
        $books = DB::select("SELECT books.*,cart.id as cart_id  FROM cart INNER JOIN books ON cart.book_id = books.id WHERE cart.user_id=? ",[Auth::id()]);
        return FacadesResponse::json(FacadesView::make('ajax/itemCart', ['carts' => $books])->render()); 
    }
}
