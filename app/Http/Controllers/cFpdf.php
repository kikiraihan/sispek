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

use \Carbon\Carbon;
use Fpdf;

class cFpdf extends Controller
{


    public function __construct()
    {
        // $this->middleware('auth');
    }








    public function jurnalUmum(){

        // Abaikan cuma tanggal
        //mengambil tanggal pertama dan terakhir
        $flTanggal=[
            'first'=>DB::table('transaksis')->first()->tanggal,
            'last'=>DB::table('transaksis')->get()->last()->tanggal,
        ];
        
        $transaksis=Transaksi::all()->sortBy('tanggal');



        ob_end_clean();

        Fpdf::SetMargins(2,1,1);
        Fpdf::AliasNbPages();
        Fpdf::AddPage();
        Fpdf::SetFont('Arial','',9);
        Fpdf::Cell(6,0.7,"Printed On : ".Carbon::now(),0,0,'L');
        Fpdf::Cell(5,0.7,"By : ".Auth::user()->nama,0,1,'L');
        Fpdf::ln(1);
        Fpdf::SetFont('Arial','UB',18);
        Fpdf::Cell(0, 0.8, 'Jurnal Umum', 0, 1, 'L');
        Fpdf::ln(0.5);//ini jarak

        Fpdf::SetFont('arial','B',10);
        Fpdf::Cell(1.7, 1, 'Periode :', 0, 0, 'R');
        Fpdf::SetFont('arial','',10);
        Fpdf::Cell(9, 1,$flTanggal['first'].' sampai '.$flTanggal['last'], 0, 1, 'L');

        //Header
        Fpdf::SetFont('Arial','B',10);
        Fpdf::Cell(4.65, 0.8, 'Tanggal', 1, 0, 'C');
        Fpdf::Cell(9, 0.8, 'Keterangan', 1, 0, 'C');
        Fpdf::Cell(2, 0.8, 'Ref.', 1, 0, 'C');
        Fpdf::Cell(5, 0.8, 'Debit', 1, 0, 'C');
        Fpdf::Cell(5, 0.8, 'Kredit', 1, 1, 'C');

        
        Fpdf::SetFont('arial','',10);

        $debit=0;$kredit=0; $initanggal=NULL; 

        foreach($transaksis as $transs){

            if ($initanggal!=$transs->tanggal){
                $initanggal=$transs->tanggal; 
                Fpdf::Cell(4.65, 0.8,$transs->tanggal->format('M d'), 1, 0, 'C');
            }
            else Fpdf::Cell(4.65, 0.8,"", 1, 0, 'C');   
            

            Fpdf::Cell(9, 0.8,"     ".$transs->keterangan, 1, 0, 'L');
            Fpdf::Cell(2, 0.8,$transs->no_ref, 1, 0, 'C');
            
            if ($transs->jenis=='Debit'){
                // Debit
                Fpdf::Cell(5, 0.8,'Rp.'.number_format($transs->nominal), 1, 0, 'C');
                // Kredit
                Fpdf::Cell(5, 0.8,"-", 1, 1, 'C');

                $debit= $debit + $transs->nominal;
            }
            elseif ($transs->jenis=='Kredit'){
                // Debit
                Fpdf::Cell(5, 0.8,"-", 1, 0, 'C');
                // Kredit
                Fpdf::Cell(5, 0.8,'Rp.'.number_format($transs->nominal), 1, 1, 'C');
                $kredit= $kredit + $transs->nominal;
            }


        }

        Fpdf::SetFont('arial','b',10);

        Fpdf::Cell(15.65,0.8,"total",1,0,'C');
        Fpdf::Cell(5,0.8,"Rp.".number_format($debit),1,0,'C');
        Fpdf::Cell(5,0.8,"Rp.".number_format($kredit),1,0,'C');


        Fpdf::Output("Laporan Jurnal Umum.pdf",'I');
        
    }


































    public function bukuBesar(){

        // Abaikan cuma tanggal
        $flTanggal=[
            'first'=>DB::table('transaksis')->first()->tanggal,
            'last'=>DB::table('transaksis')->get()->last()->tanggal,
        ];

        //mengambil semua no-ref yang ada
        $buku=Akun::with('transaksi')->get()->toArray();
        


        if (is_null($buku)){
            echo "Oops! Kosong..";
        }
        else{


            ob_end_clean();
            Fpdf::SetMargins(2,1,1);
            Fpdf::AliasNbPages();
            Fpdf::AddPage();
            Fpdf::SetFont('Arial','',9);
            Fpdf::Cell(6,0.7,"Printed On : ".Carbon::now(),0,0,'L');
            Fpdf::Cell(5,0.7,"By : ".Auth::user()->nama,0,1,'L');
            Fpdf::ln(1);
            Fpdf::SetFont('Arial','UB',18);
            Fpdf::Cell(0, 0.8, 'Buku Besar', 0, 1, 'L');
            Fpdf::ln(0.5);//ini jarak

            Fpdf::SetFont('arial','B',10);
            Fpdf::Cell(1.7, 1, 'Periode :', 0, 0, 'R');
            Fpdf::SetFont('arial','',10);
            Fpdf::Cell(9, 1,$flTanggal['first'].' sampai '.$flTanggal['last'], 0, 1, 'L');



            $debit=0;$kredit=0; $initanggal=NULL; $saldo=0; 
        //  PERULANGAN PERTAMA UNTUK PER NO REF 
            foreach($buku as $bu){
                if ($bu['transaksi']!=NULL){
                

                // Header Akun
                Fpdf::SetFont('Arial','BU',10);
                Fpdf::Cell(10.65, 0.8, $bu['nama'], 0, 0,'L');
                Fpdf::Cell(15, 0.8,$bu['no_ref'], 0, 1,'R');


                // Header table
                Fpdf::SetFont('Arial','B',10);
                Fpdf::Cell(3.65, 0.8, 'Tanggal', 1, 0, 'C');
                Fpdf::Cell(5, 0.8, 'Keterangan', 1, 0, 'C');
                Fpdf::Cell(1, 0.8, 'Ref.', 1, 0, 'C');
                Fpdf::Cell(4, 0.8, 'Debit', 1, 0, 'C');
                Fpdf::Cell(4, 0.8, 'Kredit', 1, 0, 'C');
                Fpdf::Cell(4, 0.8, 'Saldo Debit', 1, 0, 'C');
                Fpdf::Cell(4, 0.8, 'Saldo Kredit', 1, 1, 'C');
                Fpdf::SetFont('arial','',10);

                foreach($bu['transaksi'] as $transs){


                    Fpdf::Cell(3.65, 0.8, $transs['tanggal'] , 1, 0, 'C');
                    Fpdf::Cell(5, 0.8, '     '.$transs['keterangan'], 1, 0, 'L');
                    Fpdf::Cell(1, 0.8, 'JU', 1, 0, 'C');

                    if ($transs['jenis']=='Debit'){
                    // debit
                        Fpdf::Cell(4, 0.8, 'Rp.'.number_format($transs['nominal']), 1, 0, 'C');
                    // Kredit 
                        Fpdf::Cell(4, 0.8, '-', 1, 0, 'C');
                        $debit= $debit + $transs['nominal']; 
                        $saldo= $saldo + $transs['nominal']; 
                    }
                    elseif($transs['jenis']=='Kredit'){
                     // Debit 
                        Fpdf::Cell(4, 0.8, '-', 1, 0, 'C');
                    // Kredit 
                        Fpdf::Cell(4, 0.8, 'Rp.'.number_format($transs['nominal']), 1, 0, 'C');
                        $kredit= $kredit + $transs['nominal']; 
                        $saldo= $saldo - $transs['nominal']; 
                    }

                // SALDO
                    if ($saldo>=0){

                    // Saldo Debit 
                        Fpdf::Cell(4, 0.8, 'Rp.'.number_format($saldo), 1, 0, 'C');
                    // Saldo Kredit 
                        Fpdf::Cell(4, 0.8, '-', 1, 1, 'C');

                    }
                    elseif($saldo < 0){

                    // Saldo Debit 
                        Fpdf::Cell(4, 0.8, '-', 1, 0, 'C');
                    // Saldo Kredit 
                        Fpdf::Cell(4, 0.8, 'Rp.'.number_format(abs($saldo)), 1, 1, 'C');

                    }


                }


                Fpdf::SetFont('Arial','B',10);
                Fpdf::Cell(17.65,0.8,"total",1,0,'C');

                if ($saldo>0){
                    Fpdf::Cell(4,0.8,"Rp.".number_format($saldo),1,0,'C');
                }
                else{
                    Fpdf::Cell(4,0.8,"-",1,0,'C');
                }

                if ($saldo<=0){
                    Fpdf::Cell(4,0.8,"Rp.".number_format(abs($saldo)),1,1,'C');
                }
                else{
                    Fpdf::Cell(4,0.8,"-",1,1,'C');
                }

        // Reset nilai debit dan kredit
                $debit=0;$kredit=0; $saldo=0;
                Fpdf::ln(1);
            }
            }

            Fpdf::output('Laporan Buku Besar.pdf','I');
        }
    }

























    public function neraca(){

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


        // return view('admin.neraca', compact('akun', 'flTanggal'));

        if (is_null($akun)) {
            echo "Oops! Kosong..";
        }
        else{



            ob_end_clean();


            Fpdf::SetMargins(1,1,1);
            Fpdf::AliasNbPages();
            Fpdf::AddPage();
            Fpdf::SetFont('Arial','',9);
            Fpdf::Cell(6,0.7,"Printed On : ".Carbon::now(),0,0,'L');
            Fpdf::Cell(5,0.7,"By : ".Auth::user()->nama,0,1,'L');
            Fpdf::ln(1);
            Fpdf::SetFont('Arial','UB',18);
            Fpdf::Cell(0, 0.8, 'Neraca Saldo', 0, 1, 'L');
            Fpdf::ln(0.5);//ini jarak

            Fpdf::SetFont('arial','B',10);
            Fpdf::Cell(1.7, 1, 'Periode :', 0, 0, 'R');
            Fpdf::SetFont('arial','',10);
            Fpdf::Cell(9, 1,$flTanggal['first'].' sampai '.$flTanggal['last'], 0, 1, 'L');

            // Header Table
            Fpdf::SetFont('Arial','B',10);
            Fpdf::Cell(1.5,0.8, 'No',1,0,'C');
            Fpdf::Cell(4.65, 0.8, 'No Akun', 1, 0, 'C');
            Fpdf::Cell(9, 0.8, 'Nama Akun', 1, 0, 'C');
            Fpdf::Cell(6, 0.8, 'Debit', 1, 0, 'C');
            Fpdf::Cell(6, 0.8, 'Kredit', 1, 1, 'C');




            $debit=0;$kredit=0; $no=1; 
            Fpdf::SetFont('arial','',10);

            foreach ($akun as $ak){
                Fpdf::Cell(1.5,0.8, $no++,1,0,'C');
                Fpdf::Cell(4.65, 0.8, $ak['no_ref'], 1, 0, 'C');
                Fpdf::Cell(9, 0.8, $ak['keterangan'], 1, 0, 'C');

                if ($ak['saldo_debit'] != 0){
                    // Debit 
                    Fpdf::Cell(6, 0.8, 'Rp.'.number_format($ak['saldo_debit']), 1, 0, 'C');
                    // Kredit
                    Fpdf::Cell(6, 0.8, '-', 1, 1, 'C');
                    $debit= $debit + $ak['saldo_debit']; 
                }
                elseif($ak['saldo_kredit'] != 0){
                    // Debit
                    Fpdf::Cell(6, 0.8, '-', 1, 0, 'C');
                    // Kredit
                    Fpdf::Cell(6, 0.8, 'Rp.'.number_format($ak['saldo_kredit']), 1, 1, 'C');
                    $kredit= $kredit + $ak['saldo_kredit']; 
                }
            }

            Fpdf::SetFont('arial','b',10);
            Fpdf::Cell(15.15, 0.8, "Total",1,0,'C');
            Fpdf::Cell(6, 0.8, "Rp.".number_format($debit).",-" ,1,0,'C');
            Fpdf::Cell(6, 0.8, "Rp.".number_format($kredit).",-" ,1,1,'C');
            // 27,15

            // Reset nilai debit dan kredit 
            $debit=0;$kredit=0;
            Fpdf::SetFont('arial','',10);

            Fpdf::output('laporan neraca saldo.pdf','I');

        }

        

    }






















    // public function cetakAll(){

    //     ob_end_clean();

    //     // $pdf = new fpdf("L","cm","A4"); ada di app/config/fpdf.php
    //     Fpdf::SetMargins(2,1,1);
    //     Fpdf::AliasNbPages();
    //     Fpdf::AddPage();
    //     Fpdf::SetFont('times','B',11);
    //     Fpdf::ln(1);
    //     Fpdf::SetFont('Arial','B',10);
    //     Fpdf::Cell(5,0.7,"Printed On : ".Carbon::now(),0,0,'C');
    //     Fpdf::ln(1);
    //     Fpdf::SetFont('Arial','UB',18);
    //     Fpdf::ln(1);
    //     Fpdf::Cell(0, 0.8, 'Jurnal Umum', 0, 1, 'L');
    //     Fpdf::ln(0.5);//ini jarak


    // //bagian jurnal umum
    //     Fpdf::SetFont('Arial','B',10);
    //     Fpdf::Cell(4.65, 0.8, 'Tanggal', 1, 0, 'C');
    //     Fpdf::Cell(9, 0.8, 'Keterangan', 1, 0, 'C');
    //     Fpdf::Cell(2, 0.8, 'Ref.', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, 'Debit', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, 'Kredit', 1, 1, 'C');
    //     Fpdf::SetFont('arial','',10);

    //     Fpdf::Cell(4.65, 0.8,"Nov 01", 1, 0, 'C');
    //     Fpdf::Cell(9, 0.8,"     Kas", 1, 0, 'L');
    //     Fpdf::Cell(2, 0.8,"111", 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8,"10.000.000,-", 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8,"-", 1, 1, 'C');

    //     Fpdf::Cell(4.65, 0.8,"", 1, 0, 'C');
    //     Fpdf::Cell(9, 0.8,"     Modal", 1, 0, 'L');
    //     Fpdf::Cell(2, 0.8,"311", 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8,"-", 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8,"10.000.000,-", 1, 1, 'C');

    //     Fpdf::Cell(4.65, 0.8,"Nov 02", 1, 0, 'C');
    //     Fpdf::Cell(9, 0.8,"     Peralatan", 1, 0, 'L');
    //     Fpdf::Cell(2, 0.8,"112", 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8,"200.000,-", 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8,"-", 1, 1, 'C');

    //     Fpdf::Cell(4.65, 0.8,"", 1, 0, 'C');
    //     Fpdf::Cell(9, 0.8,"     Kas", 1, 0, 'L');
    //     Fpdf::Cell(2, 0.8,"111", 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8,"-", 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8,"200.000,-", 1, 1, 'C');

    //     Fpdf::Cell(4.65, 0.8,"Nov 03", 1, 0, 'C');
    //     Fpdf::Cell(9, 0.8,"     Kas", 1, 0, 'L');
    //     Fpdf::Cell(2, 0.8,"111", 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8,"1.000.000,-", 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8,"-", 1, 1, 'C');

    //     Fpdf::Cell(4.65, 0.8,"", 1, 0, 'C');
    //     Fpdf::Cell(9, 0.8,"     Modal", 1, 0, 'L');
    //     Fpdf::Cell(2, 0.8,"311", 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8,"-", 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8,"1.000.000,-", 1, 1, 'C');

    //     Fpdf::Cell(15.65,0.8,"total",1,0,'C');
    //     Fpdf::Cell(5,0.8,"11.200.000,-",1,0,'C');
    //     Fpdf::Cell(5,0.8,"11.200.000,-",1,0,'C');


    // // bagian Buku besar
    //     Fpdf::AddPage();
    //     Fpdf::SetMargins(1,1,1);
    //     Fpdf::AliasNbPages();
    //     Fpdf::SetFont('times','B',11);
    //     Fpdf::ln(1);
    //     Fpdf::SetFont('Arial','B',10);
    //     Fpdf::Cell(5,0.7,"Printed On : ".Carbon::now(),0,0,'C');
    //     Fpdf::ln(1);
    //     Fpdf::SetFont('Arial','UB',18);
    //     Fpdf::ln(1);
    //     Fpdf::Cell(0, 0.8, 'Buku Besar', 0, 1, 'L');
    //     Fpdf::ln(0.5);//ini jarak

    //     Fpdf::SetFont('Arial','BU',10);
    //     Fpdf::Cell(3.65, 0.8,"Kas", 0, 1,'L');
    //     Fpdf::SetFont('Arial','B',10);
    //     Fpdf::Cell(3.65, 0.8, 'Tanggal', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, 'Keterangan', 1, 0, 'C');
    //     Fpdf::Cell(1, 0.8, 'Ref.', 1, 0, 'C');
    //     Fpdf::Cell(4, 0.8, 'Debit', 1, 0, 'C');
    //     Fpdf::Cell(4, 0.8, 'Kredit', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, 'Saldo Debit', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, 'Saldo Kredit', 1, 1, 'C');
    //     Fpdf::SetFont('arial','',10);

    //     Fpdf::Cell(3.65, 0.8, 'Nov 01', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, '     Kas', 1, 0, 'L');
    //     Fpdf::Cell(1, 0.8, 'JU', 1, 0, 'C');
    //     Fpdf::Cell(4, 0.8, '10.000.000,-', 1, 0, 'C');
    //     Fpdf::Cell(4, 0.8, '-', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, '10.000.000', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, '-', 1, 1, 'C');

    //     Fpdf::Cell(3.65, 0.8, 'Nov 02', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, '     Kas', 1, 0, 'L');
    //     Fpdf::Cell(1, 0.8, 'JU', 1, 0, 'C');
    //     Fpdf::Cell(4, 0.8, '-', 1, 0, 'C');
    //     Fpdf::Cell(4, 0.8, '200.000,-', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, '9.800.000,-', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, '-', 1, 1, 'C');

    //     Fpdf::Cell(3.65, 0.8, 'Nov 03', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, '     Kas', 1, 0, 'L');
    //     Fpdf::Cell(1, 0.8, 'JU', 1, 0, 'C');
    //     Fpdf::Cell(4, 0.8, '1.000.000,-', 1, 0, 'C');
    //     Fpdf::Cell(4, 0.8, '-', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, '10.800.000,-', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, '-', 1, 1, 'C');

    //     Fpdf::Cell(17.65,0.8,"total",1,0,'C');
    //     Fpdf::Cell(5,0.8,"10.800.000,-",1,0,'C');
    //     Fpdf::Cell(5,0.8,"-",1,1,'C');

    //     Fpdf::ln(1);

    //     Fpdf::SetFont('Arial','BU',10);
    //     Fpdf::Cell(3.65, 0.8,"Peralatan", 0, 1,'L');
    //     Fpdf::SetFont('Arial','B',10);
    //     Fpdf::Cell(3.65, 0.8, 'Tanggal', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, 'Keterangan', 1, 0, 'C');
    //     Fpdf::Cell(1, 0.8, 'Ref.', 1, 0, 'C');
    //     Fpdf::Cell(4, 0.8, 'Debit', 1, 0, 'C');
    //     Fpdf::Cell(4, 0.8, 'Kredit', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, 'Saldo Debit', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, 'Saldo Kredit', 1, 1, 'C');
    //     Fpdf::SetFont('arial','',10);

    //     Fpdf::Cell(3.65, 0.8, 'Nov 02', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, '     Peralatan', 1, 0, 'L');
    //     Fpdf::Cell(1, 0.8, 'JU', 1, 0, 'C');
    //     Fpdf::Cell(4, 0.8, '200.000,-', 1, 0, 'C');
    //     Fpdf::Cell(4, 0.8, '-', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, '200.000,-', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, '-', 1, 1, 'C');

    //     Fpdf::Cell(17.65,0.8,"total",1,0,'C');
    //     Fpdf::Cell(5,0.8,"200.000,-",1,0,'C');
    //     Fpdf::Cell(5,0.8,"-",1,1,'C');



    //     Fpdf::AddPage();

    //     Fpdf::SetFont('Arial','BU',10);
    //     Fpdf::Cell(3.65, 0.8,"Modal", 0, 1,'L');
    //     Fpdf::SetFont('Arial','B',10);
    //     Fpdf::Cell(3.65, 0.8, 'Tanggal', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, 'Keterangan', 1, 0, 'C');
    //     Fpdf::Cell(1, 0.8, 'Ref.', 1, 0, 'C');
    //     Fpdf::Cell(4, 0.8, 'Debit', 1, 0, 'C');
    //     Fpdf::Cell(4, 0.8, 'Kredit', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, 'Saldo Debit', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, 'Saldo Kredit', 1, 1, 'C');
    //     Fpdf::SetFont('arial','',10);

    //     Fpdf::Cell(3.65, 0.8, 'Nov 01', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, '     Modal', 1, 0, 'L');
    //     Fpdf::Cell(1, 0.8, 'JU', 1, 0, 'C');
    //     Fpdf::Cell(4, 0.8, '-', 1, 0, 'C');
    //     Fpdf::Cell(4, 0.8, '200.000,-', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, '-', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, '200.000,-', 1, 1, 'C');

    //     Fpdf::Cell(3.65, 0.8, 'Nov 03', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, '     Modal', 1, 0, 'L');
    //     Fpdf::Cell(1, 0.8, 'JU', 1, 0, 'C');
    //     Fpdf::Cell(4, 0.8, '-', 1, 0, 'C');
    //     Fpdf::Cell(4, 0.8, '1.000.000,-', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, '-', 1, 0, 'C');
    //     Fpdf::Cell(5, 0.8, '1.000.000,-', 1, 1, 'C');

    //     Fpdf::Cell(17.65,0.8,"total",1,0,'C');
    //     Fpdf::Cell(5,0.8,"-",1,0,'C');
    //     Fpdf::Cell(5,0.8,"1.200.000,-",1,1,'C');


    // //bagian neraca saldo
    //     Fpdf::ln(1);
    //     Fpdf::AddPage();
    //     Fpdf::SetMargins(1,1,1);
    //     Fpdf::AliasNbPages();
    //     Fpdf::SetFont('times','B',11);
    //     Fpdf::ln(1);
    //     Fpdf::SetFont('Arial','B',10);
    //     Fpdf::Cell(5,0.7,"Printed On : ".Carbon::now(),0,0,'C');
    //     Fpdf::ln(1);
    //     Fpdf::SetFont('Arial','UB',18);
    //     Fpdf::ln(1);
    //     Fpdf::Cell(0, 0.8, 'Neraca Saldo', 0, 1, 'L');
    //     Fpdf::ln(0.5);//ini jarak

    //     Fpdf::SetFont('Arial','B',10);
    //     Fpdf::Cell(1.5,0.8, 'No',1,0,'C');
    //     Fpdf::Cell(4.65, 0.8, 'No Akun', 1, 0, 'C');
    //     Fpdf::Cell(9, 0.8, 'Nama Akun', 1, 0, 'C');
    //     Fpdf::Cell(6, 0.8, 'Debit', 1, 0, 'C');
    //     Fpdf::Cell(6, 0.8, 'Kredit', 1, 1, 'C');
    //     Fpdf::SetFont('arial','',10);

    //     Fpdf::Cell(1.5,0.8, '1',1,0,'C');
    //     Fpdf::Cell(4.65, 0.8, '111', 1, 0, 'C');
    //     Fpdf::Cell(9, 0.8, 'Kas', 1, 0, 'C');
    //     Fpdf::Cell(6, 0.8, '11.000.000,-', 1, 0, 'C');
    //     Fpdf::Cell(6, 0.8, '-', 1, 1, 'C');
    //     Fpdf::SetFont('arial','',10);

    //     Fpdf::Cell(1.5,0.8, '2',1,0,'C');
    //     Fpdf::Cell(4.65, 0.8, '112', 1, 0, 'C');
    //     Fpdf::Cell(9, 0.8, 'Peralatan', 1, 0, 'C');
    //     Fpdf::Cell(6, 0.8, '200.000,-', 1, 0, 'C');
    //     Fpdf::Cell(6, 0.8, '-', 1, 1, 'C');
    //     Fpdf::SetFont('arial','',10);

    //     Fpdf::Cell(1.5,0.8, '3',1,0,'C');
    //     Fpdf::Cell(4.65, 0.8, '311', 1, 0, 'C');
    //     Fpdf::Cell(9, 0.8, 'Modal', 1, 0, 'C');
    //     Fpdf::Cell(6, 0.8, '-', 1, 0, 'C');
    //     Fpdf::Cell(6, 0.8, '11.200.000', 1, 1, 'C');
    //     Fpdf::SetFont('arial','',10);

    //     Fpdf::Output("laporan Akuntansi.pdf",'I');


    // }















}

