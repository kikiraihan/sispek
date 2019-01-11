@extends('layouts.layout')


@section('content')

<!-- Jurnal Umum -->
<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="card">
              <!-- <div class="card-header">
                
              </div> -->
              <div class="card-body">
                <h4 class="card-title">Edit Transaksi Jurnal Umum</h4>
                <p class="card-description">
                  Masukan pembaruan data transaksi
                </p>

                <hr>
                

                
                <form class="forms-sample col-10" action="{{ url('jurnal-umum/'.$transaksi->id) }}" method="post">
                  <input type="hidden" name="_method" value="PATCH">
                  {{ csrf_field()}} 
                  {{-- <input type="hidden" name="tanggal" value="{{$transaksi->tanggal}}" > --}}

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control disabled" placeholder="{{$transaksi->tanggal->format('Y-m-d')}}" disabled="true">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="keterangan" placeholder="Masukan Keterangan" value="{{$transaksi->keterangan}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nomor Ref</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="no_ref" placeholder="Masukan Nomor Ref" value="{{$transaksi->no_ref}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nominal (Rp.)</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nominal" placeholder="Masukan Nominal" 
                      value="{{$transaksi->nominal}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jenis</label>
                    <div class="col-sm-10">
                      <select class="form-control jenis" name="jenis" >
                        <option value="Debit" @if ($transaksi->jenis=='Debit') {{'Selected'}} @endif >
                          Debit
                        </option>
                        <option value="Kredit" @if ($transaksi->jenis=='Kredit') {{'Selected'}} @endif>
                          Kredit
                        </option>
                      </select>
                    </div>
                  </div>


                  <a href="{{ url('jurnal-umum') }}" class="btn btn-light" ><i class="fa fa-fw fa-arrow-circle-left"></i>Cancel</a>
                  <button type="submit" class="btn btn-success mr-2">Submit</button>
                </form>

                @if ($errors->any())
                <br><br>
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif
                {{-- @if ($errors->any())
                <br><br>
                <div class="text-center small ">
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
                </div>
                @endif --}}




              </div>
            </div>
          </div>
        </div>

        @endsection