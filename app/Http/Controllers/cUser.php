<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Html\HtmlServiceProvider;
// use Illuminate\Html\FormFacade;
// use Illuminate\Html\HtmlFacade;


//define terlebih dahulu model eloquent yang digunkan
use App\User;

class cUser extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $users=User::all()->sortBy('kategori');

        
        // dd($tanggal);
        // dd($transaksi);
        return view('admin.users', compact('users'));
    }

    


    public function create()
    {
        return view('admin.tambah-user');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:users',
            'email' => 'required|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required',
            'kategori' => 'required',
        ]);

        // dd($request);


        //so tida pake, so beken di acessor dan mutator di model User
        // $encryptedPassword = Crypt::encryptString($request->password);
        // $decrypted = Crypt::decryptString($encrypted);

        try {
            // insert mass asigment
            $hasil=User::create([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'email' => $request->email,
                'username' => $request->username,
                'password' => $request->password,
                'kategori' => $request->kategori,
            ]);

        } catch(\Illuminate\Database\QueryException $e){
            dd($errorCode = $e->errorInfo[1]);
            // if($errorCode == '1062'){
            //     dd('Duplicate Entry');
            // }
        }


        return redirect('user');

    }





    public function showProfil($id)
    {
        $user=Auth::user();
        return view('profil',compact('user'));
    }

    







    public function edit($id)
    {
        $user=User::find($id);
        // if (!$blog) abort(404);

        return view('edit-user', compact('user'));
    }

    public function update(Request $request, $id)
    {


        $request->validate([
            'nama' => 'required',
            'nip' => ['required',Rule::unique('users')->ignore($id),],
            'email' => ['required',Rule::unique('users')->ignore($id),],
            'username' => ['required',Rule::unique('users')->ignore($id),],
            // 'oldPassword' => 'required',
            // 'password' => 'required',
            'kategori' => 'required',
        ]);



        $user=User::find($id);                
        // if ($user->password == bcrypt($request->oldPassword)) {
        //     $request->session()->flash('error', 'Password does not match');
        // }

        //jika ada yang diubah..
        if ($user->nama != $request->nama)                  $user->nama = $request->nama;
        if ($user->nip != $request->nip)                    $user->nip = $request->nip;
        if ($user->email != $request->email)                $user->email = $request->email;
        if ($user->username != $request->username)          $user->username = $request->username;
        // if ($request->password!=$request->oldPassword)      $user->password = $request->password;
        if ($user->kategori != $request->kategori)          $user->kategori = $request->kategori;

        $user->save();
        
        return redirect('user/');
    }

    




    public function destroy($id)
    {

        //pake Soft Delete
        //Delete biasa
        User::find($id)->delete();
        return redirect('user/');
        
        //Delete Destroy,
        //Blog::destroy(4);
        //Blog::destroy([2, 1]);

        //Soft Delete
        // Blog::find(2)->delete();
        //$blogs = Blog::withTrashed()->get(); menampilkan semua data
        //$blogs = Blog::onlyTrashed()->get(); menampilkan data di trash
        //forceDelete(); untuk menghapus, 
            //post::onlyTrashed()->forceDelete()
            //post::onlyTrashed()->where('',10)->forceDelete()
            //post::find(13)->forceDelete()

        //Restore Soft Delete
        //Blog::withTrashed()->find(2)->restore();  property withTrashed, mengambil termasuk yang memilki deleted_at
    }
}
