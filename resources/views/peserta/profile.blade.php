@extends('peserta.layouts.main')
@section('content')
    <style>
        .main-profile{
            margin: 0 100px;
        }

        .main-profile .col-md-3 img{
            width: 100%;
        }

    </style>
    <div class="main-profile border rounded row p-3">
    
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>    
        @endif

        <h2 class="text-center">Profile: {{ auth()->user()->nama_lengkap }}</h2>
        <hr>
        <div class="col-md-3">
            @if (auth()->user()->photo === 'nopp.png')
                <img src="{{ asset('images/' . auth()->user()->photo) }}" alt="" class="rounded">            
            @else
                <img src="{{ asset('storage/profile/' .auth()->user()->photo) }}" alt="" class="rounded">
            @endif
        </div>
        <div class="col-md-9">
            <form action="">
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="name" class="form-control" id="nama_lengkap" aria-describedby="nama_lengkap" value="{{ auth()->user()->nama_lengkap }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="name" class="form-control" id="email" aria-describedby="email" value="{{ auth()->user()->email }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="no_telpon" class="form-label">No Telephone</label>
                    <input type="name" class="form-control" id="no_telpon" aria-describedby="no_telpon" value="{{ auth()->user()->no_telpon }}" disabled>
                </div>
            </form>
            <div class="row">
                <div class="col-md-9"></div>
                <div class="col-md-3">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#editModal" class="btn btn-primary w-100">Change Profile</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('peserta.updateProfile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="name" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" aria-describedby="nama_lengkap" value="{{ old('nama_lengkap', auth()->user()->nama_lengkap) }}" name="nama_lengkap">
                            @error('nama_lengkap')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" value="{{ old('email', auth()->user()->email) }}" name="email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="no_telpon" class="form-label">No Telephone</label>
                            <input type="name" class="form-control @error('no_telpon') is-invalid @enderror" id="no_telpon" aria-describedby="no_telpon" value="{{ old('no_telpon', auth()->user()->no_telpon) }}" name="no_telpon">
                            @error('no_telpon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="photo" class="form-label">Photo</label>

                            @if (auth()->user()->photo === 'nopp.png')
                            <p>Previous File: <a
                                    href="{{ asset('/images/' . auth()->user()->photo) }}"
                                    target="_blank">{{ auth()->user()->photo }}</a></p>
                            @elseif ( isset(auth()->user()->photo) )
                            <p>Previous File: <a
                                    href="{{ asset('/storage/profile/' . auth()->user()->photo) }}"
                                    target="_blank">{{ auth()->user()->photo }}</a></p>
                            @endif

                            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" aria-describedby="photo" value="{{ old('nama_lengkap', auth()->user()->photo) }}" name="photo">

                            @error('photo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary w-100">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection