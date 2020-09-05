<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Environment\Console;

class admin extends Controller
{
    public function index(Request $request)
    {
        $book_type = DB::select('select * from book_type');
        return view('admin', ["book_type" => $book_type]);
    }

    public function updateBookView(Request $request, $id)
    {
        $book_type = DB::select('select * from book_type');
        $book = DB::selectOne('select * from books where id=?', [$id]);
        return view('bookEdit', ["book_type" => $book_type, "book"=>$book]);
    }
    public function managerBooks(Request $request)
    {
        $books = DB::select('select books.*,book_type.name as loai_sach from books INNER JOIN book_type ON book_type.id=books.loai_sach;');
        return view('admin/managerBooks', ["books" => $books]);
    }

    public function book(Request $request)
    {
        try {
            $path = $request->file('image_book')->storePublicly('avatars');

            $book_type = DB::insert(
                "INSERT INTO books (title, price, description, tac_gia, loai_sach, image_book) VALUES (?, ?, ?,?, ?, ?)",
               [ $request->title,
                $request->price,
                $request->description,
                $request->tac_gia,
                $request->loai_sach,$path ]
            );
            if ($book_type) {
                Session::flash('message', 'thêm thành công');
                return redirect('/admin');
            }
            Session::flash('message', 'thêm Lỗi');
            return redirect('/admin');
        } catch (\Throwable $th) {
            Session::flash('message', 'lỗi ' . $th);
            return redirect('/admin');
        }
    }

    public function updateBook(Request $request, $id)
    {
        try {
            $path = $request->file('image_book')->storePublicly('avatars',"public");
            $book_type = DB::update(
                "UPDATE books SET title=?, price=?, description=?, tac_gia=?, loai_sach=?, image_book=? WHERE id=?",
               [ $request->title,
                $request->price,
                $request->description,
                $request->tac_gia,
                $request->loai_sach,
                $path,
                $id]
            );
            if ($book_type) {
                Session::flash('message', 'chỉnh sửa thành công');
                return redirect('/manager-book');
            }
            Session::flash('message', 'sửa Lỗi');
            return redirect('/manager-book');
        } catch (\Throwable $th) {
            Session::flash('message', 'lỗi ' . $th);
            return redirect('/manager-book');
        }
    }

    public function deleteBook(Request $request, $id)
    {
        try {
            $book_type = DB::update(
                "UPDATE books SET is_delete=1 WHERE id=?",
               [$id]
            );
            if ($book_type) {
                Session::flash('message', 'xóa thành công');
                return redirect('/manager-book');
            }
            Session::flash('message', 'sửa Lỗi');
            return redirect('/manager-book');
        } catch (\Throwable $th) {
            Session::flash('message', 'lỗi ' . $th);
            return redirect('/manager-book');
        }
    }
    public function restoreBook(Request $request, $id)
    {
        try {
            $book_type = DB::update(
                "UPDATE books SET is_delete=0 WHERE id=?",
               [$id]
            );
            if ($book_type) {
                Session::flash('message', 'xóa thành công');
                return redirect('/manager-book');
            }
            Session::flash('message', 'sửa Lỗi');
            return redirect('/manager-book');
        } catch (\Throwable $th) {
            Session::flash('message', 'lỗi ' . $th);
            return redirect('/manager-book');
        }
    }

    public function login_form(Request $request)
    {
        return view('admin/login');
    }
    public function register_form(Request $request)
    {
        return view('admin/register');
    }

    public function login_form_post(Request $request)
    {
        $username = $request->input("username");
        $password = $request->input("password");
        $user = DB::selectOne("select * from users where username=?", [$username]);

        if ($user != null && Hash::check($password, $user->password)) {

            Auth::loginUsingId($user->id, false);
            return redirect('/admin');
        } else {
            Session::flash('message', 'Tên đăng nhập hoặc mật khẩu không trùng');
            return redirect('/login');
        }
    }
    public function register_form_post(Request $request)
    {
        $username = $request->input("username");
        $password = Hash::make($request->input("password"));
        DB::insert('insert into users (username, password) values (?, ?)', [$username, $password]);
        Session::flash('message', 'Đăng ký thành công!');
        return redirect('/register');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
