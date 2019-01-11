@extends('layouts.layout')




@section('content')

<!-- Jurnal Umum -->
<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="card">
              <!-- <div class="card-header">
                
              </div> -->
              <div class="card-body">
                <h4 class="card-title">Transaksi terhapus</h4>
                <p class="card-description">
                  Semua transaksi yang pernah dihapus 
                </p>
                <div class="table-responsive">
                  @if ($transaksis->isEmpty())
                  <br>
                  <div class="text-center small ">
                    Oops! Transaksi Terhapus Kosong..
                  </div>

                  @else
                  <table class="table table-bordered table-striped" >
                    <thead >
                      <tr>
                          <!-- <th>
                            #
                          </th> -->
                          <th style="width: 5px;">
                            Tanggal
                          </th>
                          <th >
                            Keterangan
                          </th>
                          <th class=" text-center" style="width: 3px;">
                            No Ref
                          </th>
                          <th class=" text-center">
                            Debet
                          </th>
                          <th class=" text-center">
                            Kredit
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                        <tr>


                          @php $initanggal=NULL; @endphp  
                          @foreach($transaksis as $transs)
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
                              <a href="{{ url('trashed/transaksi/'.$transs->tanggal.'/restore') }}" class="btn btn-secondary btn-sm m-0">Restore #{{ $transs->tanggal }}</a>
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
                          <td class="text-center text-success">
                            {{-- Debit --}}
                            Rp. {{number_format($transs->nominal)}}
                            

                          </td>
                          <td class="text-center text-danger">
                            {{-- Kredit --}}
                            -
                          </td>
                          @elseif($transs->jenis=='Kredit')
                          <td class="text-center text-success">
                            {{-- Debit --}}
                            -
                          </td>
                          <td class="text-center text-danger">
                            {{-- Kredit --}}
                            Rp. {{number_format($transs->nominal)}}
                            
                          </td>
                          @endif
                          <!-- Debit -->
                          {{-- <td class=" p-0 text-success">
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
                          {{-- <td class=" p-0 text-danger">
                            <div class="row no-gutters">
                              <div class="col-12 p-2 pl-4 pr-auto border-top ">
                                -
                              </div>
                              <div class="col-12 p-2 pl-4 pr-auto border-top ">
                                Rp.80.000.000
                              </div>
                            </div>
                          </td> --}}
                          
                        </tr>

                        @endforeach


                      </tbody>
                    </table>
                    <br><br>
                    <a href="{{ url('trashed/transaksi/restore') }}" class="btn btn-secondary btn-sm ">Restore ALL</a> 
                    @endif




                  </div>
                </div>
              </div>
            </div>
          </div>




          {{-- AKUN --}}
<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="card">
    <!-- <div class="card-header">
      
    </div> -->
    <div class="card-body">
      <h4 class="card-title">Akun terhapus</h4>
      <p class="card-description">
        Semua akun yang pernah dihapus 
      </p>
      <div class="table-responsive">
        @if ($akuns->isEmpty())
        <br>
        <div class="text-center small ">
          Oops! Akun Terhapus Kosong..
        </div>

        @else
        <table class="table table-bordered table-striped" >
          <thead >
            <tr>
                <!-- <th>
                  #
                </th> -->
                <th style="width: 5px;">
                  No Ref
                </th>
                <th>
                  Nama
                </th>
                <th>
                  Golongan
                </th>
              </tr>
            </thead>
            <tbody>

              <tr>
                @php $initanggal=NULL; @endphp  
                @foreach($akuns as $akunss)
                {{-- Tanggal --}}
                <td>
                  <a href="{{ url('trashed/akun/'.$akunss->no_ref.'/restore') }}" 
                    class="btn btn-secondary btn-sm m-0 font-weight-bold text-success">Restore</a> 
                  <a href="{{ url('trashed/akun/'.$akunss->no_ref.'/delete') }}" 
                    class="btn btn-secondary btn-sm m-0 font-weight-bold text-danger">Delete</a> 
                  #{{ $akunss->no_ref }}
                </td>

                {{-- password --}}
                {{-- <td class=" ">{{$akunss->password}}</td> --}}

                {{-- kategori --}}
                <td class=" ">{{$akunss->nama}}</td>

                {{-- nip --}}
                <td class=" ">{{$akunss->gol}}</td>

                
              </tr>

              @endforeach


            </tbody>
          </table>
          <br><br>
          <a href="{{ url('trashed/akun/restore') }}" 
          class="btn btn-secondary btn-sm font-weight-bold text-success">Restore ALL</a> 
          <a href="{{ url('trashed/akun/delete') }}" 
          class="btn btn-secondary btn-sm font-weight-bold text-danger">Delete ALL</a> 
          
          @endif




        </div>
      </div>
    </div>
  </div>
</div>

          @endsection