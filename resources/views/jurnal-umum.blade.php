@extends('layouts.layout')




@section('content')
<!-- Form -->
<div class="row">

  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Buat Transaksi</h4>
        <p class="card-description">
          Pembuatan transaksi per tanggal
        </p>
        <form id="depeForm" class="forms-sample" action="{{ url('jurnal-umum') }}" method="post">
          <div class="form-group row">
            <label class="col-lg-1 col-form-label">Tanggal </label>
            <div class="col-lg-4">
              <input type="date" id="tanggal" class="form-control text-muted" name="tanggal" placeholder="yyyy-mm-dd"/>
            </div>
          </div>

          <div id="tekape">
                      {{-- <div class="form-group row text-center">
                        <div class="col-lg-4">
                          <label>Keterangan</label>
                        </div>
                        <div class="col-lg-2">
                          <label>No Ref</label>
                        </div>
                        <div class="col-lg-3">
                          <label>Nominal</label>
                        </div>
                        <div class="col-lg-2">
                          <label>Jenis</label>
                        </div>
                      </div> --}}


                      <!-- muncul disini form inputan baru -->
{{-- 
                      <div class="form-group row">
                        <div class="col-lg-4">
                          <input type="text" placeholder="Keterangan" name="keterangan[]" class="form-control" >
                        </div>

                        <div class="col-lg-2">
                          <select class="form-control" name="no_ref[]" >
                            <option>reff 1</option>
                            <option>reff 2</option>
                            <option>reff 3</option>
                          </select>
                        </div>
                        <div class="col-lg-3">
                          <input type="text" placeholder="Nominal" name="nominal[]" class="form-control nominal">
                        </div>
                        <div class="col-lg-2">
                          <select class="form-control jenis" name="jenis[]">
                            <option>Debit</option>
                            <option>Kredit</option>
                          </select>
                        </div>
                        <div class="col-lg-1">
                          <button type="button" class="btn btn-danger btn-rounded" 
                          onclick="hapusElemen(containerId);return false;">
                          x 
                        </button>
                      </div>
                    </div> --}}


                  </div>

                  <div class="">
                    <button type="button" onclick="addMoreInput(); return false;" class="btn btn-sm btn-secondary btn-rounded">+</button>
                  </div>
                  <hr>

                  
                  @if($errors->has('tanggal'))
                  <p class="alert alert-danger">{{$errors->first('tanggal')}}</p>
                  @elseif($errors->has('keterangan'))
                  <p class="alert alert-danger">{{$errors->first('keterangan')}}</p>
                  @elseif($errors->has('no_ref'))
                  <p class="alert alert-danger">{{$errors->first('no_ref')}}</p>
                  @elseif($errors->has('nominal'))
                  <p class="alert alert-danger">{{$errors->first('nominal')}}</p>
                  @elseif($errors->has('jenis'))
                  <p class="alert alert-danger">{{$errors->first('jenis')}}</p>
                  @endif
                  


                  <button type="button" onclick="cek();return false;" class="btn btn-primary mr-2">Submit</button>
                  
                  <!-- <div id="tekapeAlert" hidden="true">
                    <br><br>
                    <div class='row purchace-popup'>
                      <div class='col-12'>
                        <span class='d-block d-md-flex align-items-center'>
                          <p class='mr-auto'></p>
                          <i class='mdi mdi-close popup-dismiss d-none d-md-block'></i>
                        </span>
                      </div>
                    </div>
                  </div> -->
                  <!-- <button class="btn btn-light">Cancel</button> -->
                  
                  <!-- input token, aturan form laravel! -->
                  {{ csrf_field() }} 

                </form>
              </div>
            </div>
          </div>
        </div>







        <!-- Jurnal Umum -->
        <div class="row">
          <div class="col-lg-12 grid-margin">
            <div class="card">
              <!-- <div class="card-header">
                
              </div> -->
              <div class="card-body">
                <h4 class="card-title">Jurnal Umum</h4>
                @if ($transaksis->isEmpty())
                <br>
                <div class="text-center small ">
                  Whoops! Jurnal Kosong..
                </div>
                @else

                <p class="card-description">
                  <button type="button" onclick="window.location.href='{{ url('cetak/jurnal-umum') }}'"
                  class="btn btn-icons btn-rounded btn-outline-secondary">
                  <i class="mdi mdi-printer"></i>
                </button> Cetak
              </p>
              <hr>
              <div class="table-responsive">
                <table class="table table-bordered table-striped" >
                  <thead >
                    <tr>
                          <!-- <th>
                            #
                          </th> -->
                          <th >
                            Tanggal
                          </th>
                          <th >
                            Keterangan
                          </th>
                          <th class=" text-center">
                            No Ref
                          </th>
                          <th class=" text-center">
                            Debet
                          </th>
                          <th class=" text-center">
                            Kredit
                          </th>
                          <th class=" text-center">
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                        @php $debit=0;$kredit=0; $initanggal=NULL; @endphp  
                        @foreach($transaksis as $transs)

                        <tr>
                          {{-- Tanggal --}}
                          <td>
                            {{-- 
                              PENJELASAN ALGORITMA TANGGAL
                              $initanggal awalnya null sehingga  $initanggal yang
                              pertama pasti tidak sama, jadi simpan ke initanggal..
                              cek lagi.. kalau sama lewati, tapi kalau beda ya tampilkan..
                              --}}
                              @if ($initanggal!=$transs->tanggal)
                              @php $initanggal=$transs->tanggal; @endphp
                              {{ $transs->tanggal->format('M d') }}
                              @endif
                            </td>

                            {{-- Keterangan --}}
                            <td class=" ">
                              {{$transs->keterangan}}
                            {{-- <div class="row no-gutters">
                              <div class="col-12 p-2 pl-4 pr-auto border-top">
                                kas
                              </div>
                              <div class="col-12 p-2 pl-4 pr-auto border-top">
                                Modal
                              </div>
                            </div> --}}
                          </td>

                          {{-- Nomor Ref --}}
                          <td class="text-center">
                            {{$transs->no_ref}}
                            {{-- <div class="row no-gutters">
                              <div class="col-12 p-2 pl-4 pr-auto border-top">
                                111
                              </div>
                              <div class="col-12 p-2 pl-4 pr-auto border-top">
                                311
                              </div>
                            </div> --}}
                          </td>

                          {{-- Nomor Nominal Debit Kredit --}}
                          @if ($transs->jenis=='Debit')
                          <td class="text-center text-hitam">
                            {{-- Debit --}}
                            Rp. {{number_format($transs->nominal)}}
                            @php
                            $debit= $debit + $transs->nominal;
                            @endphp

                          </td>
                          <td class="text-center text-hitam">
                            {{-- Kredit --}}
                            -
                          </td>
                          @elseif($transs->jenis=='Kredit')
                          <td class="text-center text-hitam">
                            {{-- Debit --}}
                            -
                          </td>
                          <td class="text-center text-hitam">
                            {{-- Kredit --}}
                            Rp. {{number_format($transs->nominal)}}
                            @php
                            $kredit= $kredit + $transs->nominal;
                            @endphp
                          </td>
                          @endif
                          <!-- Debit -->
                          {{-- <td class=" p-0 text-hitam">
                            <div class="row no-gutters">
                              <div class="col-12 p-2 pl-4 pr-auto border-top">
                                Rp.80.000.000
                              </div>
                              <div class="col-12 p-2 pl-4 pr-auto border-top">
                                -
                              </div>
                            </div>
                          </td> --}}


                          <!-- Kredit -->
                          {{-- <td class=" p-0 text-hitam">
                            <div class="row no-gutters">
                              <div class="col-12 p-2 pl-4 pr-auto border-top ">
                                -
                              </div>
                              <div class="col-12 p-2 pl-4 pr-auto border-top ">
                                Rp.80.000.000
                              </div>
                            </div>
                          </td> --}}
                          <td class="text-center">
                            <a href="{{ url('jurnal-umum/'.$transs->id.'/edit') }}" class="btn btn-rounded btn-warning btn-sm "><i class="fa fa-edit"></i></a> 
                            <form class="d-inline" method="post" action="{{ url('jurnal-umum/'.$transs->tanggal) }}">
                              <input type="hidden" name="_method" value="DELETE">
                              {{ csrf_field()}}  
                              <button class="btn btn-rounded btn-danger btn-sm "><i class="fa fa-trash-o"></i></button>
                            </form>
                          </td>
                          
                        </tr>

                        @endforeach



                      </tbody>
                    </table>

                    <br><br>
                    <p class="text-hitam">Total Debit : Rp. {{number_format($debit)}},-</p>
                    <p class="text-hitam">Total Kredit : Rp. {{number_format($kredit)}},-</p>
                  </div>
                  @endif
                </div>
              </div>
            </div>
          </div>


          @endsection






























          @section('script halaman')

          <script>
            var id=1;
  //id ini hanya berpengaruh pada menghapus kontener inputan alias tag P..


  function addMoreInput(){
    var tekape=document.getElementById('tekape');//getElementById ambil form utama sebagai tempat muncul
    
    //KONTENER UNTUK INPUTAN
    var container = document.createElement('div');
    container.className='form-group row';
    container.id='row'+id;
    //#row1..dst
    var containerId='#row'+id;

    //Input-KETERANGAN
    var divKeterangan = document.createElement('div');
    divKeterangan.className="col-lg-4";
    var inputKeterangan = document.createElement('input');
    inputKeterangan.type='text';
    inputKeterangan.placeholder='Keterangan';
    inputKeterangan.name='keterangan[]';
    inputKeterangan.className='form-control';
    divKeterangan.appendChild(inputKeterangan);

    
    //Select-NOREF
    var divNoref = document.createElement('div');
    divNoref.className="col-lg-2";
    var selectNoref = document.createElement('select');
    selectNoref.className='form-control';
    selectNoref.name='no_ref[]';
    
    @foreach ($akuns as $ak)
      var option = document.createElement('option');
      option.value='{{$ak->no_ref}}';
      option.innerHTML="{{$ak->no_ref}}-{{$ak->nama}}";
      selectNoref.appendChild(option);
    @endforeach

    divNoref.appendChild(selectNoref);


    
    //Input-NOMINAL
    var divNominal = document.createElement('div');
    divNominal.className="col-lg-3";
    var inputNominal = document.createElement('input');
    inputNominal.type='text';
    inputNominal.placeholder='masukan nominal';
    inputNominal.name='nominal[]';
    inputNominal.className='form-control nominal';
    divNominal.appendChild(inputNominal);


    //Select-JENIS
    var divJenis = document.createElement('div');
    divJenis.className="col-lg-2";
    var selectJenis = document.createElement('select');
    selectJenis.className='form-control jenis';
    selectJenis.name='jenis[]';
    var debit = document.createElement('option');
    debit.value='Debit';
    debit.innerHTML="Debit";
    var kredit = document.createElement('option');
    kredit.value='Kredit';
    kredit.innerHTML="Kredit";
    selectJenis.appendChild(debit);
    selectJenis.appendChild(kredit);
    divJenis.appendChild(selectJenis);
    

    //BTNHAPUS
    var divHapus = document.createElement('div');
    divHapus.className="col-lg-1";
    var btnHapus = document.createElement('button');
    btnHapus.type='button';
    btnHapus.className='btn btn-danger btn-rounded btn-sm';
    btnHapus.innerHTML='x';
    btnHapus.onclick= function () {
      hapusElemen(containerId);
      return false;
    };
    btnHapus.id='roww'+id;
    divHapus.appendChild(btnHapus);
    
    //Masukan
    container.appendChild(divKeterangan);
    container.appendChild(divNoref);
    container.appendChild(divNominal);
    container.appendChild(divJenis);
    container.appendChild(divHapus);
    tekape.append(container);//jquery


    id = id + 1;


  }
  


  function hapusElemen(containerId) {
   $(containerId).remove();
 } 




 // function cek(){
 //  var nominal=document.getElementsByClassName("nominal");

 //    nominal[0].value;
 // }

 // menambahkan array
 // debit.push(isiaray);

 function cek(){

  var debit = 0;
  var kredit= 0;  
  jenis=document.getElementsByClassName('jenis');
  nominal=document.getElementsByClassName('nominal');

  for (var i = 0; i < jenis.length; i++) {
    if (jenis[i].value=="Debit") {
      debit=parseInt(debit)+parseInt(nominal[i].value);
    } 
    else if (jenis[i].value=="Kredit") {
      kredit=parseInt(kredit)+parseInt(nominal[i].value);  
    }
  }
  // console.log(debit);
  // console.log(kredit);

  if (debit==kredit) {
    // console.log(true);
    // return true;
    document.getElementById('depeForm').submit();
  } else {
    // console.log(false);
    // return false;
    alert("Besar nominal Debit dan Kredit belum sesuai");
    // var alertnya=document.getElementById('tekapeAlert');
  }

}


</script>

@endsection