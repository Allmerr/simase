<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        {{-- <link rel="stylesheet" href="{{ asset('style/style.css') }}"> --}}
        <style>
            header{
                background: #f6f6fe;
            }

            header h4{
                margin-bottom: -0.23px;
            }
        </style>
    </head>
    <body>
        <header class="p-3 mb-3 border-bottom">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="/" class="d-flex align-items-center mb-lg-0 link-body-emphasis text-decoration-none">
                        <h4>SI-MASE</h3>
                    </a>

                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ms-auto">
                        <li><a href="{{ route('peserta.showSkema') }}" class="nav-link px-2 link-secondary">Skema</a></li>
                    </ul>

                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (auth()->user()->photo === 'nopp.png')
                                <img src="{{ asset('images/' . auth()->user()->photo) }}" alt="mdo" width="32" height="32" class="rounded-circle">
                            @else
                                <img src="{{ asset('storage/profile/' . auth()->user()->photo) }}" alt="mdo" width="32" height="32" class="rounded-circle">
                            @endif
                        </a>
                        <ul class="dropdown-menu text-small">
                            @if (auth()->user()->notifikasi()->where('is_dibaca', 'tidak_dibaca')->count() > 0)
                            <li><a class="dropdown-item" href="{{ route('peserta.notifikasi') }}">Notifikasi <span class="badge rounded-pill badge-notification bg-secondary">{{ auth()->user()->notifikasi()->where('is_dibaca', 'tidak_dibaca')->count() }}</span></a></li>
                            @else
                            <li><a class="dropdown-item" href="{{ route('peserta.notifikasi') }}">Notifikasi</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('peserta.profile') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('peserta.changePassword') }}">Change Password</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button class="dropdown-item" type="submit"><span data-feather="log-out"></span></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
