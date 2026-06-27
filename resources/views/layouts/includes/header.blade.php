<header class="header header-sticky mb-4">
    <div class="container-fluid d-flex align-items-center">
        <button class="header-toggler px-md-0 me-md-3" type="button"
            onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-menu') }}"></use>
            </svg>
        </button>
        <a class="header-brand d-md-none" href="#">
            @if (session()->has('Logo'))
                <img style="height:35px"
                    src="{{ url('uploads/Logo/' . session('Logo')) }}"
                    alt="{{ config('app.name') }}"
                    srcset="">
            @endif
        </a>
        @auth
            <ul class="header-nav ms-auto d-flex align-items-center gap-2 mb-0">
                <li class="nav-item d-flex align-items-center">
                    <div class="header-date">
                        {{ date('d-m-Y') }}
                    </div>
                </li>
                @role('super|Manager')
                    <li class="nav-item d-flex align-items-center">
                        <a class="btn btn-primary rounded-pill text-decoration-none text-white"
                            href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                @endrole
                <li class="nav-item d-flex align-items-center">
                    @include('layouts.includes.theme-toggle')
                </li>
                <li class="nav-item dropdown d-flex align-items-center">
                    <a class="nav-link header-user-trigger py-0" data-coreui-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <div class="avatar">
                            <img class="avatar-img" src="{{ asset('img/default-avatar.jpg') }}" alt="Avatar">
                        </div>
                        <span class="header-user-name">{{ Auth::user()->name }}</span>
                    </a>
                    <div style="z-index: 5" class="dropdown-menu dropdown-menu-end pt-0">
                        <a class="dropdown-item" href="{{ route('whattodo') }}">
                            <svg class="icon me-2">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-airplay') }}"></use>
                            </svg> What To Do
                        </a>

                        <a class="dropdown-item" href="{{ route('profile.cuti', Auth::user()->id) }}">
                            <svg class="icon me-2">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                            </svg>
                            {{ __('Cuti') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('profile.gaji', Auth::user()->id) }}">
                            <svg class="icon me-2">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                            </svg>
                            {{ __('Gaji') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('profile.lembur', Auth::user()->id) }}">
                            <svg class="icon me-2">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                            </svg>
                            {{ __('Lembur') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('profile.show', Auth::user()->id) }}">
                            <svg class="icon me-2">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                            </svg>
                            {{ __('Ganti Password') }}
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <svg class="icon me-2">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-account-logout') }}"></use>
                                </svg>
                                {{ __('Logout') }}
                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        @endauth
    </div>
</header>
