<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// use Illuminate\Html\HtmlServiceProvider;
// use Illuminate\Html\FormFacade;
// use Illuminate\Html\HtmlFacade;


//define terlebih dahulu model eloquent yang digunkan
use App\Akun;
use App\Transaksi;

class cNeraca extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(){

		$flTanggal=[
			'first'=>DB::table('transaksis')->first()->tanggal,
			'last'=>DB::table('transaksis')->get()->last()->tanggal,
		];

		$buku=Akun::with('transaksi')->get()->toArray();

    	// dd($buku);

    	// Cek isinya klo tidak kosong
		if (!is_null($buku)) {

    	// PEMBUATAN NERACA SALDO
    	//menghitung saldo
			$debit=0;$kredit=0;$i=0;$saldo=0;
			foreach ($buku as $bu) {

				if($bu['transaksi']!=NULL){

					foreach ($bu['transaksi'] as $transs) {
						if ($transs['jenis']=='Debit') {
						// $debit= $debit + $transs['']nominal;  
							$saldo= $saldo + $transs['nominal'];  
						}elseif ($transs['jenis']=='Kredit') {
						// $kredit= $kredit + $transs['']nominal; 
							$saldo= $saldo - $transs['nominal']; 
						}
	
					}
	
					if ($saldo>0){
						$debit=$saldo;
					}
					else{
						$debit=0;
					}
	
					if ($saldo<=0){
						$kredit=abs($saldo);
					}
					else{
						$kredit=0;
					}
	
				// $bulan=substr($transs[$i]['']tanggal, 5, 2);
	
					$akun[]=[
					// 'bulan'=>$bulan,
						'no_ref'=>$bu['no_ref'],
						'keterangan'=>$bu['nama'],
						'saldo_debit'=>$debit,
						'saldo_kredit'=>$kredit,
					];
				// Reset nilai debit dan kredit
					$debit=0;$kredit=0;$saldo=0;
					
				}
				
			}
			$i++;

		}

		else $akun=null;

		return view('admin.neraca', compact('akun', 'flTanggal'));
	}
}
