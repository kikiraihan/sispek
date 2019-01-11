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

                <form class="forms-sample col-10" action="{{ url('user/'.$user->id) }}" method="post">
                  <input type="hidden" name="_method" value="PATCH">
                  {{ csrf_field()}} 
                  {{-- <input type="hidden" name="tanggal" value="{{$user->tanggal}}" > --}}

                  {{-- <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control disabled" placeholder="{{$user->tanggal}}" disabled="true">
                    </div>
                  </div> --}}

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" placeholder="Masukan nama" value="{{$user->nama}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">nip</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nip" placeholder="Masukan nip" value="{{$user->nip}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">email</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="email" placeholder="Masukan email" value="{{$user->email}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="username" placeholder="Masukan username" 
                      value="{{$user->username}}">
                    </div>
                  </div>

                    {{-- <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Old password</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="oldPassword" placeholder="Masukan password lama">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">New password</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="password" placeholder="Masukan password baru">
                      </div>
                    </div>
                     --}}

                     
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                      <select class="form-control form-control-sm" name="kategori">
                        <option value="Operator" @if ($user->kategori=='Operator') {{'Selected'}} @endif>
                          Operator
                        </option>
                        <option value="Admin" @if ($user->kategori=='Admin') {{'Selected'}} @endif>
                          Admin
                        </option>
                      </select>
                    </div>
                  </div>
                  



                  <a href="{{ url('user') }}" class="btn btn-light" ><i class="fa fa-fw fa-arrow-circle-left"></i>Cancel</a>
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