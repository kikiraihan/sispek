@extends('layouts.layout')




@section('content')

<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="card">
              <!-- <div class="card-header">
                
              </div> -->
              <div class="card-body">
                <h4 class="card-title">Tambah User</h4>
                <p class="card-description">
                  Menambahkan user baru
                </p>
                
                

                <hr>
                <form class="forms-sample col-10" action="{{ url('user/') }}" method="post">
                  <input type="hidden" name="_method" value="post">
                  {{ csrf_field()}} 
                  {{-- <input type="hidden" name="tanggal" value="{{$transaksi->tanggal}}" > --}}

                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" placeholder="nama">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">NIP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nip" placeholder="nip">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="email" placeholder="email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="username" placeholder="username">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                      <select class="form-control form-control-sm" name="kategori">
                        <option value="Operator">Operator</option>
                        <option value="Admin">Admin</option>
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
                
                {{-- @if ($errors->any())
                <br><br>  
                <div class="text-center small ">
                  @if($errors->has('nama'))
                  <p class="alert alert-danger">{{$errors->first('nama')}}</p>
                  @elseif($errors->has('nip'))
                  <p class="alert alert-danger">{{$errors->first('nip')}}</p>
                  @elseif($errors->has('username'))
                  <p class="alert alert-danger">{{$errors->first('username')}}</p>
                  @elseif($errors->has('password'))
                  <p class="alert alert-danger">{{$errors->first('password')}}</p>
                  @elseif($errors->has('kategori'))
                  <p class="alert alert-danger">{{$errors->first('kategori')}}</p>
                  @endif
                </div>
                @endif --}}



                
              </div>
            </div>
          </div>
        </div>
        @endsection