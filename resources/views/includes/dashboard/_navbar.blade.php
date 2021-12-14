<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>

        {{-- Select language --}}
        <li>
            <div class="dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-flag"></i>
                </a>

                <div class="dropdown-menu">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </li>

    </ul>


    <!-- Right navbar links -->
    <ul class="ml-auto navbar-nav">

        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="btn nav-link">Logout</button>
            </form>
        </li>

    </ul>
</nav>
<!-- /.navbar -->
