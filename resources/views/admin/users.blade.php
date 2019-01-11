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
                <h4 class="card-title">Daftar User</h4>
                <p class="card-description">
                  Daftar pengguna aplikasi
                </p>
                <div class="table-responsive">
                  @if ($users->isEmpty())
                  <br>
                  <div class="text-center small ">
                    Oops! User Kosong..
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
                          Nama
                        </th>
                        <th >
                          NIP
                        </th>
                        <th >
                          Username
                        </th>
                        <th >
                          Kategori
                        </th>
                        <th class=" text-center">
                          Action
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $no=1; @endphp
                      @foreach ($users as $us)
                      <tr>
                        <td>
                          {{$no++}}
                        </td>

                        {{-- No Akun --}}
                        <td>{{ $us->nama }}</td>

                        {{-- Keterangan --}}
                        <td class=" ">{{$us->nip}}</td>

                        {{-- Keterangan --}}
                        <td class=" ">{{$us->username}}</td>

                        {{-- Keterangan --}}
                        {{-- <td class=" ">{{ str_limit($us->password, 2, '***') }}</td> --}}

                        {{-- Keterangan --}}
                        <td class=" ">{{$us->kategori}}</td>

                        <td class="text-center">
                          <a href="{{ url('user/'.$us->id.'/edit') }}" class="btn btn-rounded btn-warning btn-sm "><i class="fa fa-edit"></i></a> 
                          <form class="d-inline" method="post" action="{{ url('user/'.$us->id) }}">
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
                  

                  @endif

                  <div>
                    <a href="{{ url('user/create') }}" class="btn btn-sm btn-secondary btn-rounded">+</a>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        @endsection