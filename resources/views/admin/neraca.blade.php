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
                <h4 class="card-title">Neraca Saldo</h4>
                <p class="card-description">
                  <i class="menu-icon fa fa-refresh fa-spin"></i> Periode {{$flTanggal['first']}} sampai {{$flTanggal['last']}} 
                  @if (!is_null($akun))
                  <button type="button" onclick="window.location.href='{{ url('cetak/neraca') }}'"
                  class="btn btn-rounded btn-outline-secondary float-right ">
                    <i class="mdi mdi-printer"></i> <span class=" small">Print</span>
                  </button>
                  @endif
                </p>
                <div class="table-responsive">
                  @if (is_null($akun))
                  <br>
                  <div class="text-center small ">
                    Oops! Sampah Kosong..
                  </div>

                  @else
                  <hr>                  

                  <table class="table table-bordered table-striped" >
                    <thead >
                      <tr>
                        <th style="width: 5px;">
                          #
                        </th>
                        <th >
                          No Akun
                        </th>
                        <th >
                          Nama Akun
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
                      @php $debit=0;$kredit=0; $no=1; @endphp
                      @foreach ($akun as $ak)
                      <tr>
                        <td>
                          {{$no++}}
                        </td>

                        {{-- No Akun --}}
                        <td>{{ $ak['no_ref'] }}</td>

                        {{-- Keterangan --}}
                        <td class=" ">{{$ak['keterangan']}}</td>

                        {{-- Nomor Nominal Debit Kredit --}}
                        @if ($ak['saldo_debit'] != 0)
                        <td class="text-center text-success">
                          {{-- Debit --}}
                          Rp. {{number_format($ak['saldo_debit'])}}
                          @php $debit= $debit + $ak['saldo_debit']; @endphp
                        </td>
                        <td class="text-center text-danger">
                          {{-- Kredit --}}
                          -
                        </td>
                        @elseif($ak['saldo_kredit'] != 0)
                        <td class="text-center text-success">
                          {{-- Debit --}}
                          -
                        </td>
                        <td class="text-center text-danger">
                          {{-- Kredit --}}
                          Rp. {{number_format($ak['saldo_kredit'])}}
                          @php $kredit= $kredit + $ak['saldo_kredit']; @endphp
                        </td>
                        @endif

                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                  <br>
                  <div class="">
                    <p class="text-success">Saldo Debit : Rp. {{number_format($debit)}},-</p>
                    <p class="text-danger">Saldo Kredit : Rp. {{number_format($kredit)}},-</p>
                  </div>

                  {{-- Reset nilai debit dan kredit --}}
                  @php $debit=0;$kredit=0;@endphp  

                  <br><br>
                  

                  @endif

                    {{-- <br><br>
                    <p class="text-success">Total Debit : Rp. {{number_format($debit)}},-</p>
                    <p class="text-danger">Total Kredit : Rp. {{number_format($kredit)}},-</p> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endsection