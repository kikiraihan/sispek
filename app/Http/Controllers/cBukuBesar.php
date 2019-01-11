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

class cBukuBesar extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

        
		$buku=Akun::with('transaksi')->get()->toArray();
    	// dd($buku);
    	
    	return view('admin.buku-besar', compact('buku'));
    }
}
