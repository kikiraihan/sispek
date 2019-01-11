{{-- @php
use Illuminate\Support\Facades\Auth;
@endphp --}}

<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">


    
    <!-- admin -->
    @if (Auth::user()->kategori=='Admin')

    <li class="nav-item">
      <a class="nav-link" href="{{ url('profil/'.Auth::user()->id) }}">
        <i class="menu-icon fa fa-vcard"></i>
        <span class="menu-title">Home</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ url('akun') }}">
        <i class="menu-icon fa fa-list-alt"></i>
        <span class="menu-title">Akun</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ url('jurnal-umum') }}">
        <i class="menu-icon fa fa-table"></i>
        <span class="menu-title">Jurnal Umum</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="menu-icon mdi mdi-content-copy"></i>
        <span class="menu-title">Laporan</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('buku-besar') }}">
              <i class="menu-icon fa fa-book"></i>
              <span class="menu-title">Buku Besar</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('neraca') }}">
              <i class="menu-icon fa fa-bar-chart-o"></i>
              <span class="menu-title">Neraca</span>
            </a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ url('user') }}">
        <i class="menu-icon fa fa-address-book"></i>
        <span class="menu-title">Users</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ url('trashed') }}">
        <i class="menu-icon fa fa-trash-o"></i>
        <span class="menu-title">Trashed</span>
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="{{ url('logout') }}">
        <!-- <i class="menu-icon fa fa-sign-out"></i> -->
        <i class="menu-icon fa fa-circle-o-notch"></i>
        <span class="menu-title">Logout</span>
      </a>
    </li>







    {{-- bukan admin --}}
    @elseif(Auth::user()->kategori="Operator")

    <li class="nav-item">
      <a class="nav-link" href="{{ url('profil/'.Auth::user()->id) }}">
        <i class="menu-icon fa fa-vcard"></i>
        <span class="menu-title">Home</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ url('akun') }}">
        <i class="menu-icon fa fa-list-alt"></i>
        <span class="menu-title">Akun</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ url('jurnal-umum') }}">
        <i class="menu-icon fa fa-table"></i>
        <span class="menu-title">Jurnal Umum</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ url('trashed') }}">
        <i class="menu-icon fa fa-trash-o"></i>
        <span class="menu-title">Trashed</span>
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="{{ url('logout') }}">
        <!-- <i class="menu-icon fa fa-sign-out"></i> -->
        <i class="menu-icon fa fa-circle-o-notch"></i>
        <span class="menu-title">Logout</span>
      </a>
    </li>


    @endif



    


  </ul>
</nav>