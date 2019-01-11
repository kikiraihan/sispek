@extends('layouts.layout')



@section('content')

<!-- Jurnal Umum -->
<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="card">
              <!-- <div class="card-header">
                
              </div> -->

              <div class="card-body">
                <h4 class="card-title">PROFIL SAYA</h4>
                <p class="card-description">
                  Halaman biodata user
                </p>
                <hr>
                <div class="container">
                  <div class="row ">
                    <p class="col-sm-3 col-md-2">ID</p>
                    <p class="col-sm-8">: {{$user->id}} </p>
                  </div>
                  <div class="row ">
                    <p class="col-sm-3 col-md-2">Nama</p>
                    <p class="col-sm-8">: {{$user->nama}}</p>
                  </div>
                  <div class="row ">
                    <p class="col-sm-3 col-md-2">NIP</p>
                    <p class="col-sm-8">: {{$user->nip}}</p>
                  </div>
                  <div class="row tex">
                    <p class="col-sm-3 col-md-2">Kategori</p>
                    <p class="col-sm-8">: {{$user->kategori}}</p>
                  </div>
                  <div class="row tex">
                    <p class="col-sm-3 col-md-2 text-success">Email</p>
                    <p class="col-sm-8">: {{$user->email}}</p>
                  </div>
                  <div class="row tex">
                    <p class="col-sm-3 col-md-2 text-success">Username</p>
                    <p class="col-sm-8">: {{$user->username}}</p>
                  </div>
                  <div class="row tex">
                    <p class="col-sm-3 col-md-2 text-success">Password</p>
                    <p class="col-sm-8">: ***</p>
                  </div>
                </div>
                <hr>  

                {{-- <a href="{{ url('jurnal-umum') }}" class="btn btn-light btn-sm" ><i class="fa fa-fw fa-arrow-circle-left"></i>Cancel</a> --}}
                {{-- <button type="submit" class="btn btn-warning  mr-2 btn-sm"><i class="fa fa-edit"></i>Ubah</button> --}}
                <p class="float-right  small">
                  <b class="text-success">warna hijau</b> berarti dapat diubah..
                </p>
              </div>
            </div>
          </div>
        </div>

        @endsection