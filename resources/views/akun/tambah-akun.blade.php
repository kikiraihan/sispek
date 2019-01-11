@extends('layouts.layout')




@section('content')

<div class="row">
  <div class="col-lg-8 grid-margin">
    <div class="card">
              <!-- <div class="card-header">
                
              </div> -->
              <div class="card-body">
                <h4 class="card-title">Tambah Akun</h4>
                <p class="card-description">
                  Menambahkan akun baru
                </p>
                
                <form class="forms-sample " action="{{ url('akun/') }}" method="post">
                  <hr>
                  <input type="hidden" name="_method" value="post">
                  {{ csrf_field()}} 
                  {{-- <input type="hidden" name="tanggal" value="{{$transaksi->tanggal}}" > --}}

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">No Ref</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="no_ref" placeholder="no_ref">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Nama Akun</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" placeholder="nama">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Golongan</label>
                    <div class="col-sm-10">
                      <select class="form-control form-control-sm" name="gol">
                        <option value="Aktiva">1. Aktiva</option>
                        <option value="Kewajiban">2. Kewajiban</option>
                        <option value="Modal">3. Modal</option>
                        <option value="Pendapatan">4. Pendapatan</option>
                        <option value="Beban">5. Beban</option>
                      </select>
                    </div>
                  </div>
                  
                  <hr>
                  <a href="{{ url('akun') }}" class="btn btn-light" ><i class="fa fa-fw fa-arrow-circle-left"></i>Cancel</a>
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



                
              </div>
            </div>
          </div>
        </div>
        @endsection