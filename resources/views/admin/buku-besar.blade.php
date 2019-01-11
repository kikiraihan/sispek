@extends('layouts.layout')




@section('content')
{{-- <div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 >Buku Besar</h4>
      </div>
    </div>
  </div>
</div> --}}

<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="card">
              <!-- <div class="card-header">
                
              </div> -->
              <div class="card-body">
                <h4 class="card-title">Buku Besar</h4>
                <p class="card-description">
                  Berisi semua transaksi per nomor referensi.
                  @if (!is_null($buku))
                  <button type="button" onclick="window.location.href='{{ url('cetak/buku-besar') }}'"
                  class="btn  btn-rounded btn-outline-secondary float-right">
                  <i class="mdi mdi-printer"></i> Print
                </button>
                @endif
              </p>


              <div class="table-responsive">
                @if (is_null($buku))
                <br>
                <div class="text-center small ">
                  Oops! Kosong..
                </div>

                @else
                <hr>

                @php $debit=0;$kredit=0; $initanggal=NULL; $saldo=0; @endphp  
                {{-- PERULANGAN PERTAMA UNTUK PER NO REF --}}
                @foreach($buku as $bu)
                @if ($bu['transaksi']!=NULL)
                <div>
                  <h4 class="card-title d-inline">{{$bu['nama']}}</h4>
                  <p class="card-description float-right">{{$bu['no_ref']}}</p>
                </div>

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
                            Ref
                          </th>
                          <th class=" text-center">
                            Debet
                          </th>
                          <th class=" text-center">
                            Kredit
                          </th>
                          <th class=" text-center">
                            Saldo Debet
                          </th>
                          <th class=" text-center">
                            Saldo Kredit
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        

                        @foreach ($bu['transaksi'] as $transs)
                        <tr>
                          {{-- Tanggal --}}
                          <td>{{ $transs['tanggal'] }}</td>
                          
                          {{-- Keterangan --}}
                          <td class=" ">{{$transs['keterangan']}}</td>

                          {{-- Ref --}}
                          <td class="text-center">JU</td>

                          {{-- Nomor Nominal Debit Kredit --}}
                          @if ($transs['jenis']=='Debit')
                          <td class="text-center text-hitam">
                            {{-- Debit --}}
                            Rp. {{number_format($transs['nominal'])}}
                            @php $debit= $debit + $transs['nominal']; @endphp
                            @php $saldo= $saldo + $transs['nominal']; @endphp
                          </td>
                          <td class="text-center text-hitam">
                            {{-- Kredit --}}
                            -
                          </td>
                          @elseif($transs['jenis']=='Kredit')
                          <td class="text-center text-hitam">
                            {{-- Debit --}}
                            -
                          </td>
                          <td class="text-center text-hitam">
                            {{-- Kredit --}}
                            Rp. {{number_format($transs['nominal'])}}
                            @php $kredit= $kredit + $transs['nominal']; @endphp
                            @php $saldo= $saldo - $transs['nominal']; @endphp
                          </td>
                          @endif

                          @if ($saldo>=0)
                          {{-- expr --}}

                          <td class="text-center text-hitam">
                            {{-- Saldo Debit --}}
                            {{number_format($saldo)}}
                          </td>
                          <td class="text-center text-hitam">
                            {{-- Saldo Kredit --}}
                            -
                          </td>
                          @elseif($saldo < 0)
                          <td class="text-center text-hitam">
                            {{-- Saldo Debit --}}
                            -
                          </td>
                          <td class="text-center text-hitam">
                            {{-- Saldo Kredit --}}
                            {{number_format(abs($saldo))}}
                          </td>
                          @endif

                          
                        </tr>
                        @endforeach


                        

                      </tbody>
                    </table>
                    <br>
                    <div class="">
                      @if ($saldo>0)
                      <p class="text-hitam">Saldo Debit : Rp. {{number_format($saldo)}},-</p>
                      @else
                      <p class="text-hitam">Saldo Debit : Rp. 0,-</p>
                      @endif
                      @if ($saldo<=0)
                      <p class="text-hitam">Saldo Kredit : Rp. {{number_format(abs($saldo))}},-</p>
                      @else
                      <p class="text-hitam">Saldo Kredit : Rp. 0,-</p>
                      @endif
                    </div>

                    {{-- Reset nilai debit dan kredit --}}
                    @php $debit=0;$kredit=0; $saldo=0;@endphp  

                    @endif
                    <br><br>
                    @endforeach

                    @endif

                    {{-- <br><br>
                    <p class="text-hitam">Total Debit : Rp. {{number_format($debit)}},-</p>
                    <p class="text-hitam">Total Kredit : Rp. {{number_format($kredit)}},-</p> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endsection