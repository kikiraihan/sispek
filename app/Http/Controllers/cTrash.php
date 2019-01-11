<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Html\HtmlServiceProvider;
// use Illuminate\Html\FormFacade;
// use Illuminate\Html\HtmlFacade;


//define terlebih dahulu model eloquent yang digunkan
use App\Transaksi;
use App\User;
use App\Akun;

class cTrash extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function trashIndex(){

        //UNTUK ADMIN
        if (Auth::user()->kategori=='Admin') {
            //$blogs = Blog::withTrashed()->get(); menampilkan semua data
            $users = User::onlyTrashed()->get();//menampilkan data di trash
            $transaksis = Transaksi::onlyTrashed()->get();//menampilkan data di trash
            $akuns = Akun::onlyTrashed()->get();//menampilkan data di trash
            return view('trash.admin-trash-index', compact('transaksis','users','akuns'));
        }

        //UNTUK Operator Biasa
        elseif (Auth::user()->kategori=='Operator') {
            $transaksis = Transaksi::onlyTrashed()->get();//menampilkan data di trash
            $akuns = Akun::onlyTrashed()->get();//menampilkan data di trash
            return view('trash.operator-trash-index', compact('transaksis','akuns'));
        }
        


    }



    //RESTORE
    public function restoreTransaksi($tanggal){

        //Restore Soft Delete
        Transaksi::onlyTrashed()->where('tanggal',$tanggal)->restore();
        return redirect('trashed');

    }

    public function restoreAllTransaksi(){

        //Restore Soft Delete
        Transaksi::onlyTrashed()->restore();
        return redirect('trashed');

    }


    public function restoreUser($id){

        //Restore Soft Delete
        User::onlyTrashed()->where('id',$id)->restore();
        return redirect('trashed');

    }

    public function restoreAllUser(){

        //Restore Soft Delete
        User::onlyTrashed()->restore();
        return redirect('trashed');

    }

    public function restoreAkun($no_ref){

        //Restore Soft Delete
        Akun::onlyTrashed()->where('no_ref',$no_ref)->restore();
        return redirect('trashed');

    }

    public function restoreAllAkun(){

        //Restore Soft Delete
        Akun::onlyTrashed()->restore();
        return redirect('trashed');

    }


    // FORCE DELETE
    public function deleteTransaksi($tanggal)
    {
        Transaksi::onlyTrashed()->where('tanggal',$tanggal)->forceDelete();
        return redirect('trashed');
    }

    public function deleteAllTransaksi()
    {
        Transaksi::onlyTrashed()->forceDelete();
        return redirect('trashed');
    }


    public function deleteUser($id)
    {
        User::onlyTrashed()->where('id',$id)->forceDelete();
        return redirect('trashed');
    }

    public function deleteAllUser()
    {
        User::onlyTrashed()->forceDelete();
        return redirect('trashed');
    }


    public function deleteAkun($no_ref)
    {
        Akun::onlyTrashed()->where('no_ref',$no_ref)->forceDelete();
        return redirect('trashed');
    }

    public function deleteAllAkun()
    {
        Akun::onlyTrashed()->forceDelete();
        return redirect('trashed');
    }

}
