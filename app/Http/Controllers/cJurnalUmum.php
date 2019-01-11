<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// use Illuminate\Html\HtmlServiceProvider;
// use Illuminate\Html\FormFacade;
// use Illuminate\Html\HtmlFacade;


//define terlebih dahulu model eloquent yang digunkan
use App\Transaksi;
use App\Akun;

class cJurnalUmum extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // tampil semua dan form add data
    public function index(){


        $akuns=Akun::all();
    	
    	$transaksis=Transaksi::all()->sortBy('tanggal');
    	
    	// dd($tanggal);
    	// dd($transaksi);
    	return view('jurnal-umum', compact('transaksis','akuns'));
    }


    //simpan baru
    public function store(Request $request)
    {

        $this->validate($request, [
        	'tanggal' => 'required',
            'keterangan' => 'required',
            'no_ref' => 'required|max:3',
            'nominal' => 'required',
            'jenis' => 'required',
        ]);

    	// ambil keterangan, mpke akan perulangan
    	$row=$request->keterangan;

        $i=0;
    	foreach ($row as $row) {
    		$Transaksi=new Transaksi;
	        $Transaksi->tanggal     = $request->tanggal;
	        $Transaksi->keterangan  = $request->keterangan[$i];
	        $Transaksi->no_ref 		= $request->no_ref[$i];
	        $Transaksi->nominal 	= $request->nominal[$i];
	        $Transaksi->jenis 		= $request->jenis[$i];
	        $Transaksi->save();
	        $i++;
    	}

            // insert mass asigment
            // Blog::create(
            //     [
            //         'title'=>"cucok2",
            //         'description'=>"isi dari cucok2....",
            //         'created_at'=>'2018-02-01 06:03:45'
            //     ]
            // );

        return redirect('jurnal-umum');
    }

    public function edit($id){
    	$transaksi=Transaksi::find($id);
    	// if (!$blog) abort(404);

    	return view('edit-jurnal-umum', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {

    	$this->validate($request, [
            'keterangan' => 'required',
            'no_ref' => 'required|max:3',
            'nominal' => 'required',
            'jenis' => 'required',
        ]);
        
        $transaksi=Transaksi::find($id);
        $transaksi->keterangan       = $request->keterangan;
        $transaksi->no_ref = $request->no_ref;
        $transaksi->nominal = $request->nominal;
        $transaksi->jenis = $request->jenis;
        $transaksi->save();
        
        return redirect('jurnal-umum/');


        //UPDATE biasa
            // $blog=Blog::where('title', 'cucok')->first();
            // $blog->title = 'halo sukabume';
            // $blog->save();

        //UPDATE mass asigmen
            //Blog::find(5)->update()
            //find digunakan klo hanya by id. klo by nama mesti where..

            // $blog=Blog::find(5);
            // $blog->update(
            //     [
            //         'title'=>"halo cuscok",
            //         'description'=>"halo cucok isi nya kentut..."
            //     ]
            // );
    }

    public function destroy($tanggal){
        //pake Soft Delete
        Transaksi::where('tanggal',$tanggal)->delete();
        return redirect('jurnal-umum');

        //Delete biasa
        // Blog::find(5)->delete();
        
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
