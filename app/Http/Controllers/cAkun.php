<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Akun;
class cAkun extends Controller
{
    
    public function index()
    {
        $akuns=Akun::all();
        return view('akun.index', compact('akuns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('akun.tambah-akun');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_ref' => 'required|unique:akuns',
            'nama' => 'required',
            'gol' => 'required',
        ]);

        // dd($request);

        try {
            // insert mass asigment
            $hasil=Akun::create([
            	'no_ref' => $request->no_ref,
	            'nama' => $request->nama,
	            'gol' => $request->gol,     
            ]);

        } catch(\Illuminate\Database\QueryException $e){
            dd($errorCode = $e->errorInfo[1]);
            // if($errorCode == '1062'){
            //     dd('Duplicate Entry');
            // }
        }


        return redirect('akun');
    }



    public function edit($no_ref)
    {
        $akun=Akun::where('no_ref',$no_ref)->first();
        // if (!$blog) abort(404);

        return view('akun.edit-akun', compact('akun'));
    }

    public function update(Request $request, $no_ref)
    {
        

        $request->validate([
            'no_ref' => ['required',Rule::unique('akuns')->ignore($no_ref,'no_ref'),],
            'nama' => ['required',Rule::unique('akuns')->ignore($no_ref,'no_ref'),],
            'gol' => 'required',
        ]);


        DB::table('akuns')
            ->where('no_ref', $no_ref)
            ->update([
                'no_ref' => $request->no_ref,
                'nama' => $request->nama,
                'gol' => $request->gol,
            ]);


        return redirect('akun');


        //tda jadi klo pake elloquent
        // $akun=Akun::where('no_ref',$no_ref)->first();
        // dd($akun);

        //jika ada yang diubah..
        // if ($akun->no_ref != $request->no_ref)   $akun->no_ref = $request->no_ref;
        // if ($akun->nama != $request->nama)       $akun->nama = $request->nama;
        // if ($akun->gol != $request->gol)         $akun->gol = $request->gol;

        // $akun->save();
        
    }

    public function destroy($no_ref)
    {
        Akun::where('no_ref', $no_ref )->delete();
        return redirect('akun/');
    }
}
