@extends('peserta.layouts.main')
@section('content')
<style>
    @import url("https://fonts.googleapis.com/css2?family=Inspiration&family=Source+Sans+Pro:ital,wght@0,400;0,700;1,400&family=Viga&display=swap");

* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: "Viga";
}

body a {
    text-decoration: none;
}

body .base-parent {
    min-height: 100vh;
    background-color: #f5f5f7;
    margin-top: -16px;
    padding-top: 16px;
}

html body .base {
    display: flex;
    flex-direction: column;
    height: 85vh;
    justify-content: center;
    align-items: center;
}

.mylink {
    margin-top: -30px;
}

.my-big-card {
    cursor: pointer;
    background-color: #fff;
    overflow: hidden;
    border-radius: 20px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
}

.my-big-card .left {
    padding: 20px 60px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: justify;
}

.my-big-card .right img {
    border-top-right-radius: 20px;
    border-bottom-right-radius: 20px;
    width: 100%;
}

.my-card-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
}

.my-card-container .card {
    border: none;
    border-radius: 20px;
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
}

.my-card-container .card img {
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}

.blog-content {
    margin: 0 20%;
}

.blog-content img {
    width: 100%;
    margin: 30px 0;
}

.card-content {
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.3);
}

.categories .card-category {
    border: none;
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
}

@media (max-width: 912px) {
    .my-big-card {
        display: grid;
        grid-template-columns: 1fr;
    }

    .my-big-card .left {
        padding: 20px;
    }

    .my-big-card .right {
        grid-row: 1;
    }

    .my-big-card .right img {
        border-bottom-right-radius: 0px;
    }
}

@media (max-width: 768px) {
    .blog-content {
        margin: 0;
    }

    .blog-content img {
        margin: 10px 0;
    }
}

.blog-content .main img{
    height: 100%;
    width: 100%;
    object-fit: contain;
}

</style>
<div class="container my-5">
    <div class="blog-content">

        <h6 style="color:#696969">Create at {{ $skema->created_at }}</h6>
        <h1>{{ $skema->nama }}</h1>
        <a href="{{ route('peserta.daftarSkema', $skema->id_skema) }}" class="btn btn-outline-secondary">Daftar Skema</a>
        @if ($skema->photo == 'noskema.png')
        <img src="{{ asset('/images/' . $skema->photo) }}" alt="">
        @else
        <img src="{{ asset('/storage/skema/' . $skema->photo) }}" alt="">
        @endif
        <div class="main">
            {!! $skema->persyaratan !!}
        </div>
        <br>
    </div>
</div>
@endsection
