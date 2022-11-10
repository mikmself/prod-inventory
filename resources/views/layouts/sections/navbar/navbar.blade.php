@php
$containerNav = $containerNav ?? 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');

@endphp

<!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">
  @endif
  @if(isset($navbarDetached) && $navbarDetached == '')
  <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="{{$containerNav}}">
      @endif

      <!--  Brand demo (display only for navbar-full and hide on below xl) -->
      @if(isset($navbarFull))
      <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
        <a href="{{url('/')}}" class="app-brand-link gap-2">
          <span class="app-brand-logo demo">
            @include('_partials.macros',["width"=>25,"withbg"=>'#696cff'])
          </span>
          <span class="app-brand-text demo menu-text fw-bolder">{{config('variables.templateName')}}</span>
        </a>
      </div>
      @endif

      <!-- ! Not required for layout-without-menu -->
      @if(!isset($navbarHideToggle))
      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
          <i class="bx bx-menu bx-sm"></i>
        </a>
      </div>
      @endif

      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        @php
            $indexbarang = request()->routeIs('indexbarang');
            $previouspagebarang = request()->routeIs('previouspagebarang');
            $gotopagebarang = request()->routeIs('gotopagebarang');
            $nextpagebarang = request()->routeIs('nextpagebarang');
            $searchbarang = request()->routeIs('searchbarang');

            $indexkategori = request()->routeIs('indexkategori');
            $previouspagekategori = request()->routeIs('previouspagekategori');
            $gotopagekategori = request()->routeIs('gotopagekategori');
            $nextpagekategori = request()->routeIs('nextpagekategori');
            $searchkategori = request()->routeIs('searchkategori');

            $indexunitkerja = request()->routeIs('indexunitkerja');
            $previouspageunitkerja = request()->routeIs('previouspageunitkerja');
            $gotopageunitkerja = request()->routeIs('gotopageunitkerja');
            $nextpageunitkerja = request()->routeIs('nextpageunitkerja');
            $searchunitkerja = request()->routeIs('searchunitkerja');
            
            $indexruang = request()->routeIs('indexruang');
            $previouspageruang = request()->routeIs('previouspageruang');
            $gotopageruang = request()->routeIs('gotopageruang');
            $nextpageruang = request()->routeIs('nextpageruang');
            $searchruang = request()->routeIs('searchruang');

            $indexpengaturan = request()->routeIs('indexpengaturan');
            $previouspagepengaturan = request()->routeIs('previouspagepengaturan');
            $gotopagepengaturan = request()->routeIs('gotopagepengaturan');
            $nextpagepengaturan = request()->routeIs('nextpagepengaturan');
            $searchpengaturan = request()->routeIs('searchpengaturan');

            $indexsuplayer = request()->routeIs('indexsuplayer');
            $previouspagesuplayer = request()->routeIs('previouspagesuplayer');
            $gotopagesuplayer = request()->routeIs('gotopagesuplayer');
            $nextpagesuplayer = request()->routeIs('nextpagesuplayer');
            $searchsuplayer = request()->routeIs('searchsuplayer');

            $indexuser = request()->routeIs('indexuser');
            $previouspageuser = request()->routeIs('previouspageuser');
            $gotopageuser = request()->routeIs('gotopageuser');
            $nextpageuser = request()->routeIs('nextpageuser');
            $searchuser = request()->routeIs('searchuser');
        @endphp
        @if (
            $indexbarang || $previouspagebarang || $gotopagebarang || $nextpagebarang || $searchbarang || 
            $indexkategori || $previouspagekategori || $gotopagekategori || $nextpagekategori || $searchkategori || 
            $indexruang || $previouspageruang || $gotopageruang || $nextpageruang || $searchruang || 
            $indexpengaturan || $previouspagepengaturan || $gotopagepengaturan || $nextpagepengaturan || $searchpengaturan || 
            $indexsuplayer || $previouspagesuplayer || $gotopagesuplayer || $nextpagesuplayer || $searchsuplayer || 
            $indexunitkerja || $previouspageunitkerja || $gotopageunitkerja || $nextpageunitkerja || $searchunitkerja || 
            $indexuser || $previouspageuser || $gotopageuser || $nextpageuser || $searchuser
        )
          @if ($indexbarang || $previouspagebarang || $gotopagebarang || $nextpagebarang || $searchbarang)
          <div class="navbar-nav align-items-center">
            <form action="{{route('searchbarang')}}" method="post">
              <div class="nav-item d-flex align-items-center">
                  @csrf
                  <input type="text" class="form-control border-0 shadow-none" name="key" placeholder="Search..." aria-label="Search...">
                  <button type="submit" class="btn btn-secondary"><i class="bx bx-search fs-4 lh-0"></i></button>
              </div>
            </form>
          </div>
          @endif

          @if ($indexkategori || $previouspagekategori || $gotopagekategori || $nextpagekategori || $searchkategori)
          <div class="navbar-nav align-items-center">
            <form action="{{route('searchkategori')}}" method="post">
              <div class="nav-item d-flex align-items-center">
                  @csrf
                  <input type="text" class="form-control border-0 shadow-none" name="key" placeholder="Search..." aria-label="Search...">
                  <button type="submit" class="btn btn-secondary"><i class="bx bx-search fs-4 lh-0"></i></button>
              </div>
            </form>
          </div>
          @endif

          @if ($indexruang || $previouspageruang || $gotopageruang || $nextpageruang || $searchruang)
          <div class="navbar-nav align-items-center">
            <form action="{{route('searchruang')}}" method="post">
              <div class="nav-item d-flex align-items-center">
                  @csrf
                  <input type="text" class="form-control border-0 shadow-none" name="key" placeholder="Search..." aria-label="Search...">
                  <button type="submit" class="btn btn-secondary"><i class="bx bx-search fs-4 lh-0"></i></button>
              </div>
            </form>
          </div>
          @endif

          @if ($indexpengaturan || $previouspagepengaturan || $gotopagepengaturan || $nextpagepengaturan || $searchpengaturan)
          <div class="navbar-nav align-items-center">
            <form action="{{route('searchpengaturan')}}" method="post">
              <div class="nav-item d-flex align-items-center">
                  @csrf
                  <input type="text" class="form-control border-0 shadow-none" name="key" placeholder="Search..." aria-label="Search...">
                  <button type="submit" class="btn btn-secondary"><i class="bx bx-search fs-4 lh-0"></i></button>
              </div>
            </form>
          </div>
          @endif

          @if ($indexsuplayer || $previouspagesuplayer || $gotopagesuplayer || $nextpagesuplayer || $searchsuplayer)
          <div class="navbar-nav align-items-center">
            <form action="{{route('searchsuplayer')}}" method="post">
              <div class="nav-item d-flex align-items-center">
                  @csrf
                  <input type="text" class="form-control border-0 shadow-none" name="key" placeholder="Search..." aria-label="Search...">
                  <button type="submit" class="btn btn-secondary"><i class="bx bx-search fs-4 lh-0"></i></button>
              </div>
            </form>
          </div>
          @endif

          @if ($indexunitkerja || $previouspageunitkerja || $gotopageunitkerja || $nextpageunitkerja || $searchunitkerja)
          <div class="navbar-nav align-items-center">
            <form action="{{route('searchunitkerja')}}" method="post">
              <div class="nav-item d-flex align-items-center">
                  @csrf
                  <input type="text" class="form-control border-0 shadow-none" name="key" placeholder="Search..." aria-label="Search...">
                  <button type="submit" class="btn btn-secondary"><i class="bx bx-search fs-4 lh-0"></i></button>
              </div>
            </form>
          </div>
          @endif

          @if ($indexuser || $previouspageuser || $gotopageuser || $nextpageuser || $searchuser)
          <div class="navbar-nav align-items-center">
            <form action="{{route('searchuser')}}" method="post">
              <div class="nav-item d-flex align-items-center">
                  @csrf
                  <input type="text" class="form-control border-0 shadow-none" name="key" placeholder="Search..." aria-label="Search...">
                  <button type="submit" class="btn btn-secondary"><i class="bx bx-search fs-4 lh-0"></i></button>
              </div>
            </form>
          </div>
          @endif
        @endif
        <ul class="navbar-nav flex-row align-items-center ms-auto">
          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle">
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="javascript:void(0);">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar avatar-online">
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle">
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <span class="fw-semibold d-block">{{session()->get('firstname')}}</span>
                      <small class="text-muted">{{session()->get('unitkerja')}}</small>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);">
                  <i class='bx bx-cog me-2'></i>
                  <span class="align-middle">Settings</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="{{route('logout')}}">
                  <i class='bx bx-power-off me-2'></i>
                  <span class="align-middle">Log Out</span>
                </a>
              </li>
            </ul>
          </li>
          <!--/ User -->
        </ul>
      </div>

      @if(!isset($navbarDetached))
    </div>
    @endif
  </nav>
  <!-- / Navbar -->
