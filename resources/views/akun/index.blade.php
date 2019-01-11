@extends('layouts.layout')




@section('content')


        <!-- Jurnal Umum -->
        <div class="row">
          <div class="col-lg-8 grid-margin">
            <div class="card">
              <!-- <div class="card-header">
                
              </div> -->
              <div class="card-body">
                <h4 class="card-title">Akun</h4>
                @if ($akuns->isEmpty())
                <br>
                <div class="text-center small ">
                  Whoops! Akun Kosong.. silahkan dibuat
                </div>
                @else

                <p class="card-description">
                Daftar akun
              </p>
              <hr>
              <div class="table-responsive">
                <table class="table table-bordered table-striped" >
                    <thead >
                      <tr>
                        
                        <th >
                          No Ref
                        </th>
                        <th >
                          Nama
                        </th>
                        <th >
                          Golongan
                        </th>
                        <th class="text-center" style="width: 5px;" >
                          Action
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $no=1; @endphp
                      @foreach ($akuns as $ak)
                      <tr>
                        

                        {{-- No Akun --}}
                        <td>{{ $ak->no_ref }}</td>
                        <td>{{ $ak->nama }}</td>
                        <td>{{ $ak->gol }}</td>

                        <td class="text-center">
                          <a href="{{ url('akun/'.$ak->no_ref.'/edit') }}" class="btn btn-rounded btn-warning btn-sm "><i class="fa fa-edit"></i></a> 
                          <form class="d-inline" method="post" action="{{ url('akun/'.$ak->no_ref) }}">
                            <input type="hidden" name="_method" value="DELETE">
                            {{ csrf_field()}}  
                            <button class="btn btn-rounded btn-danger btn-sm "><i class="fa fa-trash-o"></i></button>
                          </form>
                        </td>

                      </tr>
                      @endforeach

                    </tbody>
                  </table>


                  </div>
                  @endif
                  <br>
                  <div>
                    <a href="{{ url('akun/create') }}" class="btn btn-sm btn-secondary btn-rounded">+</a>
                  </div>
                </div>
              </div>
            </div>
          </div>


          @endsection



