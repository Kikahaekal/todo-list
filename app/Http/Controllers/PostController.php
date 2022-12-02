<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        return view('login', [
            'title' => 'login',
            'content' => 'Selamat Datang',
            'bg' => 'background-image: url(https://static.vecteezy.com/system/resources/previews/000/273/920/original/deep-ocean-background-vector.jpg);',
            'css' => 'style.css'
        ]);
    }

    public function register()
    {
        return view('register', [
            'title' => 'Register',
            'content' => 'Silahkan daftar',
            'bg' => 'background-image: url(https://static.vecteezy.com/system/resources/previews/000/273/920/original/deep-ocean-background-vector.jpg);'
        ]);
    }

    public function create()
    {
        return view('create', [
            'title' => 'To-do | Create',
            'bg' => 'background-image: url(https://static.vecteezy.com/system/resources/previews/000/273/920/original/deep-ocean-background-vector.jpg);'
        ],);
    }


    public function todo()
    {
        //mengambil data dari database
        //all() = untuk mengambil semua isi table
        //where() = memfilter data di database
        //parameter where('column', 'perbandingan', 'value')
        $todo = Todo::where('user_id', Auth::user()->id)->get(); 

        //kirim data yang sudah di ambil ke file blade / ke file yang menampilkan halaman
        //kirim melalui compact()
        //isi compact sesuaikan dengan nama variabel
        return view('todo', [
            'title' => 'To do | List',
            'bg' => 'background-image: url(https://static.vecteezy.com/system/resources/previews/000/273/920/original/deep-ocean-background-vector.jpg);'
        ], compact('todo'));
    }

    public function registerAccount(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email:dns',
            'username' => 'required|min:4|max:8',
            'password' => 'required|min:4',
            'name' => 'required|min:3'
        ]);

        //memasukkan data ke database user
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //redirect ke page yang sudah di tentukan setelah berhasil tambah data + dikirim pemberitahuan
        return redirect('/')->with('succes', 'Berhasil Menambahkan akun! Silahkan login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ],
        [
            //custom message
            'username.exists' => 'username ini belum tersedia',
            'username.required' => 'username harus diisi',
            'password.required' => 'password harus diisi',
        ]
    );

        $user = $request->only('username', 'password');
        if(Auth::attempt($user)){
            return redirect()->route('todo.index');
        }else{
            return redirect()->back()->with('error', 'Gagal Login, silahkan cek dengan benar');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect("/");
    }

    public function store(Request $request)
    {
        // @dd($request->all());

        $request->validate([
            "title" => "required|min:3",
            "date" => "required",
            "description" => "required|min:5"
        ]);

        //mengirim data ke database table todos dengan model Todo
        //nama column db
        //$request-> = value atribute name pada input
        //kenapa yang dikirim 5 data padahal cuman butuh 3? karena table pada db todos membutuhkan 6 column input
        //salah satunya column 'done_time' yang tipenya nullable. karena nullable jadi ga perlu kirim nilai
        //'user_id' untuk memberitahu data todo ini milik siapa, diambil melalui fitur auth
        //'status' tipenya boolean, 0 = belum dikerjakan, 1 sudah dikerjakan (todonya)
        Todo::create([
            "title" => $request->title,
            "description" => $request->description,
            "date" => $request->date,
            "status" => 0,
            "user_id" => Auth::user()->id,
        ]);
        return redirect()->route('todo.index')->with('succes', 'Berhasil');
    }

    public function edit($id)
    {
        //menampilkan halaman input form edit
        //mengambil data satu baris ketika column/kolom id pada baris tersebut sama dengan id dari parameter route
        $todo = Todo::where('id', $id)->first();

        //kirim data yang diambil ke file blade dengan compact()
        return view('edit',[
            'title' => "To do | Edit",
            'bg' => "background-image: url(https://static.vecteezy.com/system/resources/previews/000/273/920/original/deep-ocean-background-vector.jpg);"
        ], compact('todo'));
    }

    public function update(Request $request, $id)
    {
        //validasi
        $request->validate([
            "title" => "required|min:3",
            "date" => "required",
            "description" => "required|min:5"
        ]);

        //cari baris data yang mempunyai id yang sama dengan data id yang dikirim dari parameter route
        //setelah ketemu, update column-column datanya
        Todo::where('id', $id)->update([
            "title" => $request->title,
            "description" => $request->description,
            "date" => $request->date,
            "status" => 0,
            "user_id" => Auth::user()->id,
        ]);

        return redirect()->route('todo.index')->with('sucessAdd', 'Berhasil di update');
    }

    public function destroy($id)
    {
        $todo = Todo::find($id)->delete();

        return redirect()->route('todo.index')->with('delete', 'Berhasil menghapus');
    }

    public function updateCompleted($id)
    {
        $todo = Todo::where('id', '=', $id)->update([
            'status' => 1,
            'done_time' => \Carbon\Carbon::now(),
        ]);

        return redirect()->back()->with('done', 'todo berhasil di update');
    }

    // public function completed($id)
    // {
    //     $todo = Todo::where('id', $id)->update([
    //         "status" => 1,
    //         "done_time" => now(),
    //     ]);

    //     return redirect()->route('todo.index')->with("complete", "Status di update");
    // }


}
